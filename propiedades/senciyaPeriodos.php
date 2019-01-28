<?php 

$id = $_GET['idrental'];

function generar_calendario_precios($year,$month,$id){
	// precios de la base de datos
	include('../includes/conexion_nueva.php');
	$tabla = 'sys_pricerange';
	$sql = 'SELECT precio,fecha,tipo FROM '.$tabla.' WHERE id_propiedad = '.$id.' AND fecha >= "'.$year.'-'.$month.'-1" AND fecha<= "'.$year.'-'.$month.'-31"';
	mysqli_set_charset($connection, "utf8");
	$periodos = $connection->query($sql);
	$precios = array();
	while ($res = $periodos->fetch_assoc()) {
		$fe = strtotime($res['fecha']);
		$precios[$fe] = $res['precio'];
		$tipos[$fe] = $res['tipo'];
	}

	# Obtenemos el dia de la semana del primer dia
	# Devuelve 0 para domingo, 6 para sabado
	$diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
	# Obtenemos el ultimo dia del mes
	$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
	$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

	$calendar = '';
	$calendar .= '<table class="calendario" width="250" style="text-align:center;margin:0px 5px 0px 5px">';
	//$calendar .= '<table class="calendario" style="text-align:center;width:300px;display:block; oveflow:hidden; float:left">';
		$calendar .= '<caption>'.$meses[$month]." ".$year.'</caption>';
		$calendar .= '<tr><th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th><th>Vie</th><th>Sab</th><th>Dom</th></tr>';
		$calendar .= '<tr>';
			# definimos los valores iniciales para nuestro calendario
			$last_cell = $diaSemana + $ultimoDiaMes;
			// hacemos un bucle hasta 42, que es el máximo de valores que puede
			// haber... 6 columnas de 7 dias
			for($i=1;$i<=49;$i++){
				if($i==$diaSemana){
					// determinamos en que dia empieza
					$day=1;
				}
				if($i<$diaSemana || $i>=$last_cell){
					// celca vacia
					$calendar .= "<td>&nbsp;</td>";
				}else{
					$precio = '';
					$fe = strtotime($year.'-'.$month.'-'.$day);
					if(isset($precios[$fe])){
						$precio = $precios[$fe];
					}else{
						$precio = '0';
					}
					if(isset($tipos[$fe])){
						$tipo = 'T= '.$tipos[$fe];
					}else{
						$tipo = '--';
					}
					$calendar .= "<td style='background:#75BB7D;'><span>$day</span><br />".$precio."€<br /><span>".$tipo."</span></td>";
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
        <h2 class="uk-modal-title">Periodos de reservas</h2>
    </div>
    <div class="uk-modal-body">
    
    <script>
    	function actualizar_precios_alquilerJS(id){
    		//alert(id);
    		//UIkit.modal("#periodosReservas").hide();
                $("#action").val(1);
                $("#resultado").html('Guardando...');
                $.ajax({
                    url: './senciyaPeriodosGuardar', // url where to submit the request
                    type : "POST", // type of action POST || GET
                    //dataType : 'json', // data type
                    data : $("#form-periodos").serialize(), // post data || get data
                    success:function(resp){
                        $("#resultado").html(resp);
                        //UIkit.modal("#periodosReservas").hide();
                        //alert(resp);
                    }
                });
    	}
    	function actualizar_precios_alquilerJS2(id){
    		//alert(id);
    		//UIkit.modal("#periodosReservas").hide();
                $("#action").val(2);
                $("#resultado").html('Guardando...');
                $.ajax({
                    url: './senciyaPeriodosGuardar', // url where to submit the request
                    type : "POST", // type of action POST || GET
                    //dataType : 'json', // data type
                    data : $("#form-periodos").serialize(), // post data || get data
                    success:function(resp){
                        $("#resultado").html(resp);
                        //UIkit.modal("#periodosReservas").hide();
                        //alert(resp);
                    }
                });
    	}
		jQuery(function() {

		 jQuery("#fecha_inicio1, #fecha_inicio2").datepicker({
		  	dateFormat: "dd-mm-yy",
	        firstDay: 1,
          	minDate:"+0D",
	        changeMonth: true,
	        changeYear: true,
	        yearRange: "-0:+10"
      	});
      	jQuery("#fecha_inicio2").datepicker("option","minDate","+1D");

		// 2 Eventos
		// 2.1 Actualiza fecha de salida
		  jQuery("#fecha_inicio1").datepicker("option","onSelect", function(datesel){
		      //window.alert( parseInt(datesel.substring(3,5)-1));
		      var anio= parseInt(datesel.substring(6));
		      var mes = parseInt(datesel.substring(3,5)-1);
		      var dia = parseInt(datesel.substring(0,2));
		     
		      var date = new Date(anio , mes , dia,12,0,0,0 );
		      var actual=date.getTime();
		      var siguiente=1000*60*60*24;
		      date.setTime(parseInt(actual+siguiente));
		      jQuery("#fecha_inicio2").datepicker("option","minDate",date);
		      
		  });

	  });
	</script>
	<?php
	//echo '<div id="PreciosAlquilerView">';
	
		//echo '<div id="precios_calendario_lista">';
		$month=date("n");
		$year=date("Y");
		echo '<table>';
		$i=0;
		for($x=0;$x<=24;$x++){
			$i++;
		    $month=date("n");
		    $year=date("Y");
		    $ano = $year;
		    $mes = $month + $x;
		    if($mes >= 13 and $mes<=24){
		        $mes = $mes - 12;
		        $ano++;
		    }elseif($mes>=24){
		    	$mes = $mes - 24;
		    	$ano = $ano + 2;
		    }
		    if($i == 1){
		        echo  '<tr>';
		    }
		    echo '<td>'.generar_calendario_precios($ano,$mes,$id).'</td>';
		    if($i == 4){
		        echo  '</tr>';
		        $i = 0;
		    }
		}
                echo '</table>';
	
	$ano = date('Y')+1;
	$anos = '';
	$anos .= '<option value="">---</option>';
	for($a=$ano;$a<=$ano+2;$a++){
		$anos .= '<option value="'.$a.'">'.$a.'</option>';
	}
	$ano = date('Y');
	$anos2 = '';
	$anos2 .= '<option value="">---</option>';
	for($a=$ano;$a<=$ano+2;$a++){
		$anos2 .= '<option value="'.$a.'">'.$a.'</option>';
	}
		//echo '</div>';
        echo '<div id="resultado"></div>';
        echo '<form action="" method="post" id="form-periodos">';
        echo '<input type="hidden" name="idprop" value="'.$id.'"/>';
        echo '<input type="hidden" name="action" id="action" value="1"/>';
	echo '<table style="background:#ddd;">';
	echo '<tr>';
		echo '<td colspan="2"><b>Nuevo rango de precios</b></td>';
		echo '<td>Tipo:</td>';
		echo '<td colspan="4">
				<input type="radio" name="tipo_reserva" id="tipo_reserva" value="ss" onclick="sstiporeserva()">Sábado - Sábado
				<input type="radio" name="tipo_reserva" id="tipo_reserva" class="tipo_reserva_min_val" value="7" onclick="mintiporeserva()" checked="checked">Mínimo de noches permitidas
				<input type="number" name="tipo_reserva_min" id="tipo_reserva_min" onchange="change_val_tipo_reserva()" value="7">
			</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>Precio</td>';
		echo '<td><input type="number" name="precio" id="precio" value="" required/></td>';
		echo '<td>Fecha Inicio</td>';
		echo '<td><input type="text" name="fecha_inicio1" id="fecha_inicio1" value="" readonly="readonly" required/></td>';
		echo '<td>Fecha Fin</td>';
		echo '<td><input type="text" name="fecha_inicio2" id="fecha_inicio2" value="" readonly="readonly" required/></td>';
		echo '<td>&nbsp;</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>Clonar a</td>';
		echo '<td><select name="clonar1" id="clonar1">'.$anos.'</select></td>';
		echo '<td>Y</td>';
		echo '<td><select name="clonar2" id="clonar2">'.$anos.'</select></td>';
		echo '<td>Y</td>';
		echo '<td><select name="clonar3" id="clonar3">'.$anos.'</select></td>';
		echo '<td><input type="button" class="button button-primary" name="nuevo_periodo" value="Guardar" onclick="actualizar_precios_alquilerJS('.$id.')" /></td>';
	echo '</tr>';
	$y = date('Y');
	$y1 = $y+1;
	$y2 = $y+2;
	$y3 = $y+3;
	//$url = URL_SEA.'view/precios_lightbox.php';
	/*
	echo '<tr>';
		echo '<td colspan="2"><a href="'.$url.'?y='.$y1.'&id='.$id.'" class="thickbox">Ver precios del año '.$y1.'</a></td>';
		echo '<td colspan="2"><a href="'.$url.'?y='.$y2.'&id='.$id.'" class="thickbox">Ver precios del año '.$y2.'</a></td>';
		echo '<td colspan="2"><a href="'.$url.'?y='.$y3.'&id='.$id.'" class="thickbox">Ver precios del año '.$y3.'</a></td>';
		echo '<td>&nbsp;</td>';
	echo '</tr>';
	*/
	echo '<tr>';
		echo '<td colspan="2">Clonar año : </td>';
		echo '<td><select name="clonar1completo" id="clonar1completo">'.$anos2.'</select></td>';
		echo '<td colspan="2">Copiar en</td>';
		echo '<td><select name="clonar2completo" id="clonar2completo">'.$anos2.'</select></td>';
		echo '<td><input type="button" class="button button-primary" name="nuevo_periodo" value="Guardar" onclick="actualizar_precios_alquilerJS2('.$id.')" /></td>';
	echo '</tr>';
	echo '</table>';
        echo '</form>';
	echo '</div>';
	?>
    </div>
    <div class="uk-modal-footer">Villas Planet</div>
</div>