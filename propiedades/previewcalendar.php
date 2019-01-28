<?php
require('../includes/config2.php'); 
/*-------------------------------------------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------------------------------------*/
function generar_calendario_precios_2($year,$month,$ref,$idioma2){
   
    $a = JSON_get_disponibilidad_precios_by_ref($year,$month,$ref);
    
    # Obtenemos el dia de la semana del primer dia
    # Devuelve 0 para domingo, 6 para sabado
    $diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
    # Obtenemos el ultimo dia del mes
    $ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
    $meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
   
    
    $calendar = '';
    $calendar .= '<table class="calendario" width="90%">';
    $calendar .= '<caption><b>'.$meses[$month]." ".$year.'</b></caption>';
	$calendar .= '<tr><th>L</th><th>M</th><th>X</th><th>J</th><th>V</th><th>S</th><th>D</th></tr>';
        
        $calendar .= '<tr>';
            # definimos los valores iniciales para nuestro calendario
            $last_cell = $diaSemana + $ultimoDiaMes;
            
            // hacemos un bucle hasta 42, que es el máximo de valores que puede
            // haber... 6 columnas de 7 dias
            if($month <= '9'){
                $month1 = '0'.$month;
            }else{
                $month1 = $month;
            }

            for($i=1;$i<=49;$i++){

                if($i==$diaSemana){
                    // determinamos en que dia empieza
                    $day=1;
                }
                if($i<$diaSemana || $i>=$last_cell){
                    // celca vacia
                    $calendar .= "<td>&nbsp;</td>";
                }else{
                    if($day <= 9){
                        $day1 = '0'.$day;
                    }else{
                        $day1 = $day;
                    }
                    $fecha_datos = $year.'-'.$month1.'-'.$day1;
					
                    $fecha_actual2 = date ('Y-m-d');
                    $fecha_actual2 = strtotime ( '+2 day' , strtotime ( $fecha_actual2 ) ) ;
                    $fecha_actual2 = date ( 'Y-m-d' , $fecha_actual2 );
					$fecha_entrada2 = $fecha_datos;
					
                    if (!$a[$fecha_datos]['ocupado'] and $fecha_actual2 > $fecha_entrada2){
                        //if($a[$fecha_datos]['ocupado']){
                        	//$style = "style='background:#ED3125;cursor:not-allowed;'";
                        //}else{
							$style = "style='background:#ccc !important;cursor: not-allowed; '";
                        	$classJS = '';
                        //}
					}else  if ($a[$fecha_datos]['ocupado']){
						if($a[$fecha_datos]['tipo'] == 'AVANTIO'){
							$style = "style='background:#000000;color:#FFFFFF;cursor:not-allowed;'";
						}else{
							$style = "style='background:#ED3125;cursor:not-allowed;'";
						}
       					 
                         $classJS = '';
                    }else{
						
                        $nuevafecha = strtotime ( '-1 day' , strtotime ( $fecha_datos ) ) ;
                        $fecha_anterior = date ( 'Y-m-d' , $nuevafecha );
                        $nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha_datos ) ) ;
                        $fecha_siguiente = date ( 'Y-m-d' , $nuevafecha );
                        $color = '#ED3125';
                        if(isset($a[$fecha_anterior]['ocupado']) and !isset($a[$fecha_datos]['ocupado']) and !isset($a[$fecha_siguiente]['ocupado'])){
                            /*si fecha anterior roja y actual verde*/
                            if($a[$fecha_anterior]['tipo'] == 'AVANTIO'){
                            	$color = '#000000';
                            }
                            $style = "style='background: linear-gradient(135deg, ".$color." 50%,  #75BB7D 50%);cursor:pointer'";
                            $classJS = 'calendarmod';
                        }elseif(!isset($a[$fecha_anterior]['ocupado']) and !isset($a[$fecha_datos]['ocupado']) and isset($a[$fecha_siguiente]['ocupado'])){
                            /*si fecha verde y siguiente roja*/
                            if($a[$fecha_siguiente]['tipo'] == 'AVANTIO'){
                            	$color = '#000000';
                            }
                            $style = "style='background: linear-gradient(135deg, #75BB7D 50%, ".$color." 50%);cursor:pointer'";
                            $classJS = 'calendarmod';
                        }elseif(isset($a[$fecha_anterior]['ocupado']) and !isset($a[$fecha_datos]['ocupado']) and isset($a[$fecha_siguiente]['ocupado'])){
                            $style = "style='background:#ED3125;cursor:not-allowed;'";
                            $classJS = '';
                        }else{
                            $style = "style='background:#75BB7D;cursor:pointer'";
                            $classJS = 'calendarmod';
                        }
                        
                        
                    }
                    $tipo = $a[$fecha_datos]['tipo'];
                    if(!empty($a[$fecha_datos]['precio'])){
                        $precio = $a[$fecha_datos]['precio'].' €';
                    }else{
                        $precio = 'N/A';
                    }
                    if(empty($classJS)){
                        $precio = '&nbsp;';
                    }
                    //$calendar .= "<td ".$style." onclick=\"fecha_reserva_calendar('".$year."-".$month1."-".$day1."')\"><strong class='uk-text-center'><p class='uk-margin-remove'  style='font-size:11px'>$day1 </p></strong><span class='precio-calendario'>".$precio."</span></td>";
                    $calendar .= "<td ".$style." class='".$classJS."' id='".$day1."-".$month1."-".$year."'>$day1</td>";
                    $day++;
                }
                // cuando llega al final de la semana, iniciamos una columna nueva
                if($i%7==0){
                    $calendar .= "</tr><tr>\n";
                }
            }
	    $calendar .= '</tr>';
	    $calendar .= '</table>';

	    return $calendar;
}
function JSON_get_disponibilidad_precios_by_ref($year1,$mes1,$ref1){
	$db = new PDO("mysql:host=".DBHOST.";charset=utf8mb4;dbname=".DBNAME, DBUSER, DBPASS);
    //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);//Suggested to uncomment on production websites
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Suggested to comment on production websites
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	$tabla = 'sys_pricerange';
	$tabla1 = 'rental_enquiries';

	if(isset($year1) and !empty($year1)){
		$year = $year1;
	}
	if(isset($mes1) and !empty($mes1)){
		$mes = $mes1;
	}
	if(isset($ref1) and !empty($ref1)){
		$ref = $ref1;
		$id = str_replace('A','',$ref) - 1000;
	}
	if($mes <= 9){
		$mes = '0'.$mes;
	}
	$fecha_inicio = $year.'-'.$mes.'-01';
	$d = date("d",(mktime(0,0,0,$mes+1,1,$year)-1));
	$fecha_fin = $year.'-'.$mes.'-'.$d;
	$nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha_fin ) ) ;
	$fecha_fin = date ( 'Y-m-d' , $nuevafecha );

	$data = array();
	for($i=$fecha_inicio;$i<=$fecha_fin;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
		$data[$i]['precio'] = '';
		$data[$i]['tipo'] = '';
		$data[$i]['ocupado'] = false;
	}
	$stmt1 = $db->prepare('SELECT fecha,precio,tipo FROM '.$tabla.' WHERE 
		id_propiedad = '.$id.' AND fecha BETWEEN "'.$fecha_inicio.'" AND "'.$fecha_fin.'"
		');
	$stmt1->setFetchMode(PDO::FETCH_ASSOC);
	$stmt1->execute();

	while ($res = $stmt1->fetch()){
		$data[$res['fecha']]['precio'] = $res['precio'];
		$data[$res['fecha']]['tipo'] = $res['tipo'];
	}
	
	$stmt2 = $db->prepare('SELECT enquiryStart,enquiryEnd FROM '.$tabla1.' WHERE
		PropID = '.$id.' AND bookingNotes != "Pago Error" AND bookingNotes != "Cancelada" AND bookingNotes != "Pendiente de Pago" AND
		(("'.$fecha_inicio.'" BETWEEN enquiryStart AND enquiryEnd) OR 
			("'.$fecha_fin.'" BETWEEN enquiryStart AND enquiryEnd) OR
			(enquiryStart BETWEEN "'.$fecha_inicio.'" AND "'.$fecha_fin.'") OR
			(enquiryEnd BETWEEN "'.$fecha_inicio.'" AND "'.$fecha_fin.'"))
		');
	$stmt2->setFetchMode(PDO::FETCH_ASSOC);
	$stmt2->execute();

	while ($res = $stmt2->fetch()){
		$f1 = $res['enquiryStart'];
		$f2 = $res['enquiryEnd'];
		foreach($data as $key => $res1){
			if($key > $f1 and $key < $f2){
				$data[$key]['ocupado'] = true;
				$data[$key]['tipo'] = '';
			}
		}
	}
	//CALENDARIO DE AVANTIO
	
	$ref = $id + 1000;
	$ref = $ref.'A';
	$tabla = 'rentals';
	$stmt2 = $db->prepare('SELECT avantio FROM '.$tabla.' WHERE yourRef = "'.$ref.'"');
	$stmt2->setFetchMode(PDO::FETCH_ASSOC);
	$stmt2->execute();
	while ($res = $stmt2->fetch()){
		$file = $res['avantio'];
	}
	if(!empty($file)){
		require('icsread.php'); 
		$obj = new icsread();
		$icsEvents = $obj->getIcsEventsAsArray( $file );
		unset( $icsEvents [1] );
		foreach( $icsEvents as $icsEvent){
			$start = isset( $icsEvent ['DTSTART;VALUE=DATE'] ) ? $icsEvent ['DTSTART;VALUE=DATE'] : $icsEvent ['DTSTART'];
			$startDt = new DateTime ( $start );
			$startDate = $startDt->format ( 'Y-m-d' );
			$end = isset( $icsEvent ['DTEND;VALUE=DATE'] ) ? $icsEvent ['DTEND;VALUE=DATE'] : $icsEvent ['DTEND'];
			$endDt = new DateTime ( $end );
			$endDate = $endDt->format ( 'Y-m-d' );
			$eventName = $icsEvent['SUMMARY'];
			$f1 = $startDate;
			$f2 = $endDate;
			foreach($data as $key => $res1){
				if($key > $f1 and $key < $f2){
					$data[$key]['ocupado'] = true;
					$data[$key]['tipo'] = 'AVANTIO';
				}
			}
		}
	}
	
	return $data;
}	

/*-------------------------------------------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------------------------------------*/
	$ref = $_POST["refid"];
	$ref = '4459A';
	
	$id = str_replace('A','',$ref) - 1000;
	
/*
	$tres = 'rental_enquiries';
	$tren = 'rentals';
	$hoy = date('Y-m-d');
	$fecha_inicio = strtotime ( '-3 month' , strtotime ( $hoy ) ) ;
	$fecha_inicio = date ( 'Y-m-d' , $fecha_inicio );

	$stmt = $db->prepare('SELECT * FROM '.$tres.' WHERE enquiryStart >= "'.$fecha_inicio.'" AND PropID = '.$id.'');
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();
	$reservas_calendario = array();

	while ($res = $stmt->fetch()){
		//$propiedad = get_nombre_alquiler_by_id(0,$res->PropID);
		$propiedad = $id.'A';
		$propiedad = addslashes($propiedad);
		$fecha_entrada = $res['enquiryStart'];
		$fecha_salida = $res['enquiryEnd'];
		$id = $res['ID'];
		//$color = get_color_reserva_by_tipo(0,$res->bookingNotes);
		$color = '#378006';
		$reservas_calendario[] = array($fecha_entrada,$fecha_salida,$propiedad,$id,$color);
	}
	*/
	echo '
	<script>
		jQuery(document).ready(function() {
    		jQuery("#actualCalendario").scrollTop(0); 
		});
	</script>
	';
?>

<div class="uk-modal-dialog uk-margin-auto-vertical">
       <span id="modclose2"> <button class="uk-modal-close-default" type="button" uk-close></button></span>
        <div class="uk-modal-header">
			<div class="uk-grid">
				<div class="uk-width-1-1">
			<h5 class="uk-modal-title "><span uk-icon="icon:calendar;ratio:1.2;" class="icon-margin"></span> Propiedad: <strong class="yellow"><?php echo $ref ?></strong></h5>
				</div>
				
			</div>
        </div>

<div class="uk-modal-body">
	<div class="uk-width-1-1 uk-text-center">
	<?php

	$hoy = date('Y-n-d');
	$fecha_inicio = strtotime ( '-10 month' , strtotime ( $hoy ) ) ;
	$fecha_inicio = date ( 'Y-n-d' , $fecha_inicio );
	list($year,$month,$d) = explode('-',$fecha_inicio);
	echo '<table width="100%">';
	$i=0;
	$a=0;
	for($x=0;$x<=24;$x++){
	    $i++;
	    $a++;
	    //$month=date("n");
	    //$year=date("Y");
	    $ano = $year;
	    $mes = $month + $x;
	    

	    if($mes >= 13 and $mes <= 24){
	        $mes = $mes - 12;
	        $ano++;
	    }
	    if($mes >= 25 and $mes <= 36){
	        $mes = $mes - 24;
	        $ano = $ano + 2;
	    }
	    if($mes > 36){
	        $mes = $mes - 36;
	        $ano = $ano + 3;
	    }
		
	    if($i == 1){
	        echo  '<tr>';
	    }
	    if($a<=10){
	    	$id = 'class="antes" style="display:none;"';
	    }else{
	    	$id = '';
	    }
	    if($a==11){
	    	echo '<tr><td colspan="5"><b><span onclick="jQuery(\'.antes\').show();" style="cursor: pointer;">Ver 10 meses anteriores</span></b></td></tr>';
	    }
	    echo '<td '.$id.'>'.generar_calendario_precios_2($ano,$mes,$ref,'es').'</td>';
	    if($i == 5){
	        echo  '</tr>';
	        $i = 0;
	    } 
	}
	echo '</table>';

	?>
	</div>
</div>
    <div class="uk-modal-footer uk-text-right">
			<span id="modclose">
            <button   class="uk-button uk-button-default uk-modal-close" type="button">Cerrar</button></span>
    
    </div>
</div>