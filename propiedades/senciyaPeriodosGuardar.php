<?php

include('../includes/conexion_nueva.php'); 

if(isset($_POST['action']) and $_POST['action'] == 1){
    actualizar_precios_alquileres_action($connection);
}elseif(isset($_POST['action']) and $_POST['action'] == 2){
    actualizar_precios_alquileres_action2($connection);
}else{
    exit();
}

function cambiar_fecha_format_to_bbdd($fecha){
	list($m,$d,$y) = explode('/',$fecha);
	if(!empty($d) and !empty($m) and !empty($y)){
		$fecha_nueva = $y.'-'.$m.'-'.$d;
	}else{
		$fecha_nueva = ''; 
	}
	return $fecha_nueva;
}

function actualizar_precios_alquileres_action($connection){

	$tipo_reserva = $_POST['tipo_reserva'];
	$precio = $_POST['precio'];
	$fecha_inicio1 = cambiar_fecha_format_to_bbdd($_POST['fecha_inicio1']);
	$fecha_inicio2 = cambiar_fecha_format_to_bbdd($_POST['fecha_inicio2']);
	$clonar1 = $_POST['clonar1'];
	$clonar2 = $_POST['clonar2'];
	$clonar3 = $_POST['clonar3'];
	$id = $_POST['idprop'];
	if(empty($id) or empty($fecha_inicio2) or empty($fecha_inicio1) or empty($precio)){
		echo 'Faltan datos, revisa el formulario';
		exit();
	}
	$res = true;
	$res = replace_precios_alquiler($fecha_inicio1,$fecha_inicio2,$precio,$tipo_reserva,$id,$connection);
	if(isset($clonar1) and !empty($clonar1)){
		list($y,$m,$d) = explode('-',$fecha_inicio1);
		$fecha_inicio1_clonar = $clonar1.'-'.$m.'-'.$d;
		list($y,$m,$d) = explode('-',$fecha_inicio2);
		$fecha_inicio2_clonar = $clonar1.'-'.$m.'-'.$d;
		$res = replace_precios_alquiler($fecha_inicio1_clonar,$fecha_inicio2_clonar,$precio,$tipo_reserva,$id,$connection);
	}
	if(isset($clonar2) and !empty($clonar2)){
		list($y,$m,$d) = explode('-',$fecha_inicio1);
		$fecha_inicio1_clonar = $clonar2.'-'.$m.'-'.$d;
		list($y,$m,$d) = explode('-',$fecha_inicio2);
		$fecha_inicio2_clonar = $clonar2.'-'.$m.'-'.$d;
		$res = replace_precios_alquiler($fecha_inicio1_clonar,$fecha_inicio2_clonar,$precio,$tipo_reserva,$id,$connection);
	}
	if(isset($clonar3) and !empty($clonar3)){
		list($y,$m,$d) = explode('-',$fecha_inicio1);
		$fecha_inicio1_clonar = $clonar3.'-'.$m.'-'.$d;
		list($y,$m,$d) = explode('-',$fecha_inicio2);
		$fecha_inicio2_clonar = $clonar3.'-'.$m.'-'.$d;
		$res = replace_precios_alquiler($fecha_inicio1_clonar,$fecha_inicio2_clonar,$precio,$tipo_reserva,$id,$connection);
	}
        if($res){
            echo 'Precios guardados correctamente';
        }else{
            echo 'No se han podido guardar los precios';
        }
}

function actualizar_precios_alquileres_action2($connection){

	$clonar1 = $_POST['clonar1'];
	$clonar2 = $_POST['clonar2'];
	$id = $_POST['idprop'];

	if(empty($id) or empty($clonar1) or empty($clonar2) or $clonar1 == $clonar2){
		echo 'Faltan datos o son erroneos, revisa el formulario';
		exit();
        }
	
	$clonar = replace_precios_alquiler2($clonar1,$clonar2,$id,$connection);
	
        if($clonar){
            echo 'Precios Clonados correctamente!!';
        }else{
            echo 'No se han podido clonar los precios.';
        }
}
function replace_precios_alquiler2($clonar1,$clonar2,$id,$connection){
	
        $a = true;
	$table = 'sys_pricerange';
	$fecha1 = $clonar1.'-01-01';
	$fecha2 = $clonar1.'-12-31';
	$sql = 'SELECT * FROM '.$table.' WHERE id_propiedad = '.$id.' AND fecha BETWEEN "'.$fecha1.'" AND "'.$fecha2.'"';
        mysqli_set_charset($connection, "utf8");
        $reservas = $connection->query($sql);
        while ($res = $reservas->fetch_assoc()) {
		list($y,$m,$d) = explode('-',$res->fecha);
		$fecha = $clonar2.'-'.$m.'-'.$d;
                $precio = $res['precio'];
                $tipo = $res['tipo'];
		/*
                $data = array(
                    'id_propiedad' => $id,
                    'fecha' => $fecha,
                    'precio' => $res->precio,
                    'tipo' => $res->tipo,
                );
	 	$wpdb->replace( $table, $data);
                */
                $sql = 'DELETE FROM '.$table.' WHERE fecha = "'.$fecha.'" AND id_propiedad = '.$id.'';
                $connection->query($sql);
                $sql = 'INSERT INTO '.$table.' (id_propiedad,fecha,precio,tipo) VALUES ("'.$id.'","'.$fecha.'","'.$precio.'","'.$tipo.'")';
                //$sql = 'UPDATE '.$table.' SET fecha = "'.$i.'",precio = "'.$precio.'",tipo = "'.$tipo_reserva.'" WHERE id_propiedad = "'.$id.'"';

                if(!$connection->query($sql)){
                    $a = $connection->error;
                }
                //$sql = 'UPDATE '.$table.' SET fecha = "'.$fecha.'",precio = "'.$precio.'",tipo = "'.$tipo.'" WHERE id = "'.$id.'"';
                //$connection->query($sql);
	}
    return $a;
}
function replace_precios_alquiler($fecha_inicio1,$fecha_inicio2,$precio,$tipo_reserva,$id,$connection){
	
	$table = 'sys_pricerange';
        $a = true;
	for($i=$fecha_inicio1;$i<=$fecha_inicio2;$i = date("Y-m-d", strtotime($i."+ 1 days"))){
	    /*
            $data = array(
	    	'id_propiedad' => $id,
	    	'fecha' => $i,
	    	'precio' => $precio,
	    	'tipo' => $tipo_reserva,
	    );
	    $wpdb->replace( $table, $data);
            */
            $sql = 'DELETE FROM '.$table.' WHERE fecha = "'.$i.'" AND id_propiedad = '.$id.'';
            $connection->query($sql);
            $sql = 'INSERT INTO '.$table.' (id_propiedad,fecha,precio,tipo) VALUES ("'.$id.'","'.$i.'","'.$precio.'","'.$tipo_reserva.'")';
            //$sql = 'UPDATE '.$table.' SET fecha = "'.$i.'",precio = "'.$precio.'",tipo = "'.$tipo_reserva.'" WHERE id_propiedad = "'.$id.'"';
            
            if(!$connection->query($sql)){
                $a = $connection->error;
            }
	}
	return $a;
}

