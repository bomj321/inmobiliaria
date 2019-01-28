<?php 

$ref = $_GET['idrental'];
    //echo $id;
    /*
    mysqli_set_charset($connection, "utf8");
    $sql="DELETE FROM rentals WHERE ID=?";
    $resultado=mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($resultado, "s",$id);
        mysqli_stmt_execute($resultado); 
          
        mysqli_stmt_close($resultado);
*/

function JSON_get_disponibilidad_precios_by_ref($year1,$mes1,$ref1){
	include('../includes/conexion_nueva.php'); 
	
	$tabla = 'sys_pricerange';
	$tabla1 = 'rental_enquiries';

	if(isset($year1) and !empty($year1)){
		$year = $year1;
	}
	if(isset($mes1) and !empty($mes1)){
		$mes = $mes1;
	}
	/*
	if(isset($ref1) and !empty($ref1)){
		$ref = $ref1;
		$id = str_replace('A','',$ref) - 1000;
	}
	*/
	$id = $ref1;
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
	/*
	$precios = $wpdb->get_results('SELECT fecha,precio,tipo FROM '.$tabla.' WHERE 
		id_propiedad = '.$id.' AND fecha BETWEEN "'.$fecha_inicio.'" AND "'.$fecha_fin.'"
		');
	
	foreach($precios as $res){
		$data[$res->fecha]['precio'] = $res->precio;
		$data[$res->fecha]['tipo'] = $res->tipo;
	}
	*/
	$sql='SELECT fecha_entrada,fecha_salida FROM '.$tabla1.' WHERE
		id_propiedad = '.$id.' AND bookingNotes != "Pago Error" AND bookingNotes != "Cancelada" AND bookingNotes != "Pendiente de Pago" AND
		(("'.$fecha_inicio.'" BETWEEN fecha_entrada AND fecha_salida) OR 
			("'.$fecha_fin.'" BETWEEN fecha_entrada AND fecha_salida) OR
			(fecha_entrada BETWEEN "'.$fecha_inicio.'" AND "'.$fecha_fin.'") OR
			(fecha_salida BETWEEN "'.$fecha_inicio.'" AND "'.$fecha_fin.'"))
		';
	mysqli_set_charset($connection, "utf8");
    
    if (!$reservas = $connection->query($sql)) {
	    // ¡Oh, no! La consulta falló. 
	    echo "Lo sentimos, este sitio web está experimentando problemas.";

	    // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
	    // cómo obtener información del error
	    echo "Error: La ejecución de la consulta falló debido a: \n";
	    echo "Query: " . $sql . "\n";
	    echo "Errno: " . $mysqli->errno . "\n";
	    echo "Error: " . $mysqli->error . "\n";
	    exit;
	}
	//$reservas = $reservas->fetch_assoc();
	while ($res = $reservas->fetch_assoc()) {
		$f1 = $res['fecha_entrada'];
		$f2 = $res['fecha_salida'];
		foreach($data as $key => $res1){
			if($key > $f1 and $key < $f2){
				$data[$key]['ocupado'] = true;
				$data[$key]['tipo'] = '';
			}
		}
	}
	
	/*
	//CALENDARIO DE AVANTIO
	$ref = $id + 1000;
	$ref = $ref.'A';
	$file = get_file_avantio_propiedad($ref);
	if(!empty($file)){
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
	*/
	return $data;
}

function generar_calendario_precios_2($year,$month,$ref,$idioma2){
   
    $a = JSON_get_disponibilidad_precios_by_ref($year,$month,$ref);
   
    # Obtenemos el dia de la semana del primer dia
    # Devuelve 0 para domingo, 6 para sabado
    $diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
    # Obtenemos el ultimo dia del mes
    $ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
    $meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
   
    
    $calendar = '';
    $calendar .= '<table class="calendario" width="250" style="text-align:center">';
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
                    }
					else{
						
                        $nuevafecha = strtotime ( '-1 day' , strtotime ( $fecha_datos ) ) ;
                        $fecha_anterior = date ( 'Y-m-d' , $nuevafecha );
                        $nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha_datos ) ) ;
                        $fecha_siguiente = date ( 'Y-m-d' , $nuevafecha );
                        $color = '#ED3125';
                        if($a[$fecha_anterior]['ocupado'] and !$a[$fecha_datos]['ocupado'] and !$a[$fecha_siguiente]['ocupado']){
                            /*si fecha anterior roja y actual verde*/
                            if($a[$fecha_anterior]['tipo'] == 'AVANTIO'){
                            	$color = '#000000';
                            }
                            $style = "style='background: linear-gradient(135deg, ".$color." 50%,  #75BB7D 50%);cursor:pointer'";
                            $classJS = 'calendarmod';
                        }elseif(!$a[$fecha_anterior]['ocupado'] and !$a[$fecha_datos]['ocupado'] and $a[$fecha_siguiente]['ocupado']){
                            /*si fecha verde y siguiente roja*/
                            if($a[$fecha_siguiente]['tipo'] == 'AVANTIO'){
                            	$color = '#000000';
                            }
                            $style = "style='background: linear-gradient(135deg, #75BB7D 50%, ".$color." 50%);cursor:pointer'";
                            $classJS = 'calendarmod';
                        }elseif($a[$fecha_anterior]['ocupado'] and !$a[$fecha_datos]['ocupado'] and $a[$fecha_siguiente]['ocupado']){
                            $style = "style='background:#ED3125;cursor:not-allowed;'";
                            $classJS = '';
                        }else{
                            $style = "style='background:#75BB7D;cursor:pointer'";
                            $classJS = 'calendarmod';
                        }
                        
                        
                    }
                    $tipo = $a[$fecha_datos]['tipo'];
                    /*
                    if(!empty($a[$fecha_datos]['precio'])){
                        $precio = $a[$fecha_datos]['precio'].' €';
                    }else{
                        $precio = 'N/A';
                    }
                    if(empty($classJS)){
                        $precio = '&nbsp;';
                    }
                    */
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


?>


<div class="uk-modal-dialog">
    <button class="uk-modal-close-default" type="button" uk-close></button>
    <div class="uk-modal-header">
        <h2 class="uk-modal-title">Calendario de reservas</h2>
    </div>
    <div class="uk-modal-body">
    	<?php
    	$hoy = date('Y-n-d');
		$fecha_inicio = strtotime ( '-10 month' , strtotime ( $hoy ) ) ;
		$fecha_inicio = date ( 'Y-n-d' , $fecha_inicio );
		list($year,$month,$d) = explode('-',$fecha_inicio);
		echo '<table>';
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
		    echo '<td '.$id.'>'.generar_calendario_precios_2($ano,$mes,$ref,$idioma2).'</td>';
		    if($i == 5){
		        echo  '</tr>';
		        $i = 0;
		    } 
		}
		echo '</table>';

	    ?>

    </div>
    <div class="uk-modal-footer">Villas Planet</div>
</div>
