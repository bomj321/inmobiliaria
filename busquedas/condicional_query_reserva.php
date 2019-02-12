<?php

	if (empty($row['NameES'])) {
		$nombre_renta = 'No Disponible';
	}else{
		$nombre_renta = $row['NameES'];
	}

 $date_reserva = date_create($row['dateAdded']);
 $date_entrada = date_create($row['enquiryStart']);
 $date_salida = date_create($row['enquiryEnd'])
 ?>

<?php
$tipo_de_reserva=str_replace('_', ' ',$row['bookingNotes']);

if ($row['bookingNotes'] == 'Pre-Reserva') {
	$boton_reserva = '<button style="width: 100%; background-color: #ffebcc;" class="btn">'.trim($tipo_de_reserva).'</button>';


}elseif($row['bookingNotes'] == 'Bajo Petición'){

	$boton_reserva = '<button style="width: 100%; background-color: #f5ccff;" class="btn">'.trim($tipo_de_reserva).'</button>';


}elseif ($row['bookingNotes'] == 'De Propietario') {

	$boton_reserva = '<button style="width: 100%; background-color: #ccccff;" class="btn">'.trim($tipo_de_reserva).'</button>';

}elseif ($row['bookingNotes'] == 'Confirmada') {

		$boton_reserva = '<button style="width: 100%; background-color: #ffffcc;" class="btn">'.trim($tipo_de_reserva).'</button>';

}elseif ($row['bookingNotes'] == 'Pagada') {

		$boton_reserva = '<button style="width: 100%; background-color: #d6f5d6;" class="btn">'.trim($tipo_de_reserva).'</button>';

}elseif ($row['bookingNotes'] == 'Pendiente de Pago') {

		$boton_reserva = '<button style="width: 100%; background-color: #ffccdd;" class="btn">'.trim($tipo_de_reserva).'</button>';

}elseif ($row['bookingNotes'] == 'Pagado Deposito') {

		$boton_reserva = '<button style="width: 100%; background-color: #bf8040;" class="btn">'.trim($tipo_de_reserva).'</button>';

}elseif ($row['bookingNotes'] == 'Pago Error') {

		$boton_reserva = '<button style="width: 100%; background-color: #ff3300;" class="btn">'.trim($tipo_de_reserva).'</button>';

}elseif ($row['bookingNotes'] == 'Cierre de Ventas') {

		$boton_reserva = '<button style="width: 100%; background-color: #cccccc;" class="btn">'.trim($tipo_de_reserva).'</button>';

}elseif ($row['bookingNotes'] == 'Bloqueado') {

		$boton_reserva = '<button style="width: 100%; background-color: #e6e6e6;" class="btn">'.trim($tipo_de_reserva).'</button>';

}elseif ($row['bookingNotes'] == 'Cancelada') {

		$boton_reserva = '<button style="width: 100%; background-color: #ffd9cc;" class="btn">'.trim($tipo_de_reserva).'</button>';

}elseif ($row['bookingNotes'] == 'DESCONOCIDO') {

		$boton_reserva = '<button style="width: 100%; background-color: #ffffcc;" class="btn">'.trim($tipo_de_reserva).'</button>';

}else{
	$boton_reserva = '<button class="btn btn-default">Sin Asignar</button>';
}
?>



<!------------------------CONSULTA PARA EL BOTON---------------------->

