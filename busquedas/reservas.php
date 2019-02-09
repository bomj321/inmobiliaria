
<!--CONEXION NUEVA-->
<?php 

$host = '91.142.222.126';
$database = 'webstyle_mallorcapanel';
$user = 'miguel_workana';
$pass = 'Hpc4~f25';


try {

	//create PDO connection
	$db_reservas = new PDO("mysql:host=".$host.";charset=utf8mb4;dbname=".$database, $user, $pass);
    //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);//Suggested to uncomment on production websites
    $db_reservas->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Suggested to comment on production websites
    $db_reservas->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch(PDOException $e) {
	//show error
    echo '<p class="uk-alert-danger">'.$e->getMessage().'</p>';
    exit;
}


?>
<!--CONEXION NUEVA-->


	<div class="row"  style="margin-top: 50px; background-color: white;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin-top: 20px;">		

			 	
			 <table id="reservas_busqueda" class="table table-hover bulk_action dt-responsive nowrap"  cellspacing="0" width="100%" style="max-width: 100%;">

                            <thead>
                                <tr>
                                	<th class="all">ID</th>
                                	<th class="all">Fecha de la Reserva</th>
                                	<th class="all">Propiedad</th>
                                    <th class="all">Cliente</th>                                    
                                    <th class="none">Tipo Propiedad</th>
                                    <th class="all">Fecha de Entrada</th>
                                    <th class="all">Fecha de Salida</th>
                                    <th class="all">Tipo de Reserva</th>
                                    <th class="all">Precio</th>
                                    <th class="all">Owner</th>
                                    <th class="all">Charges</th>
                                    <th class="all">Discount</th>
                                    <th class="none">Direcci&oacute;n</th>                                   
                                    <th class="none">Precio</th>
                                    <th class="none">Adultos</th>
                                    <th class="none">Ni&ntilde;os</th>
                                    <th class="none">Edades</th>
                                    <th class="none">Comentarios</th>
                                    <th class="all">Profit</th>
                                    <th class="all">Acciones</th>                                    
                                </tr>
                            </thead>
                            <tbody >
                          <!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->
<?php

/*PRIMERO SE OBTIENE LA CANTIDAD DE COLUMNAS*/

$query = $db_reservas->prepare('show columns from rental_enquiries');
$query->setFetchMode(PDO::FETCH_ASSOC);

$query->execute();
$queryCondition = "";

$i = 0;
while ($row = $query->fetch()){
$i++;     
}

/*PRIMERO SE OBTIENE LA CANTIDAD DE COLUMNAS*/

/*DESPUES DE OBTIENDE LA QUERY A AGREGAR AL SELECT*/
$query_2 = $db_reservas->prepare('show columns from rental_enquiries');
$query_2->setFetchMode(PDO::FETCH_ASSOC);

$query_2->execute();
$a = 0;
while ($row = $query_2->fetch()){

       $queryCondition .= ' rental_enquiries.'. $row['Field'] . " LIKE '%" . $busqueda . "%'";

$a++;    

/*SECCION PARA VERIFICAR SI ES EL ULTIMO REGISTRO Y AGREGAR EL OR*/


if($i!=$a){
              $queryCondition .= " OR ";
          }

/*SECCION PARA VERIFICAR SI ES EL ULTIMO REGISTRO Y AGREGAR EL OR*/

}

/*DESPUES DE OBTIENDE LA QUERY A AGREGAR AL SELECT*/





$stmt = $db_reservas->prepare("SELECT rental_enquiries.*,rentals.propNameES as NameES,rentals.propType as Type,rentals.propAddress as Address,clients.ClientName as nombrecliente FROM rental_enquiries LEFT JOIN rentals ON rental_enquiries.PropID = rentals.ID LEFT JOIN clients ON rental_enquiries.ClientID = clients.ID WHERE" . $queryCondition . " ORDER BY rental_enquiries.ID DESC");




$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

while ($row = $stmt->fetch()){
 ?>
<!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->
<!--CUERPO DE LA PAGINA-->
<!--CONDICIONALES PARA LOS COLORES-->

			<tr>

<!--CONDICIONALES PARA LOS COLORES-->
						                <td>
						                	<?php echo $row['ID'] ?>
						                </td>

						                <td style="max-width: 30px;">
											<?php $date_reserva = date_create($row['dateAdded']); ?>
											<?php echo date_format($date_reserva, 'd-m-Y'); ?>
										</td>

										<td style="max-width: 20px;">
											<?php echo $row['NameES'] ?>
										</td>

										<td style="max-width: 30px;">
											<?php echo $row['nombrecliente'] ?>
										</td>
										

										<td>
											<?php echo $row['Type'] ?>
										</td>

										<td >
											<?php $date_entrada = date_create($row['enquiryStart']); ?>
											<?php echo date_format($date_entrada, 'd-m-Y'); ?>
										</td>

										<td>
											<?php $date_salida = date_create($row['enquiryEnd']); ?>
											<?php echo date_format($date_salida, 'd-m-Y'); ?>
										</td>
										

										<td>
											<?php
												$tipo_de_reserva=str_replace('_', ' ',$row['bookingNotes']);
											 ?>

													<!--<button onclick='cambiarestado(<?php echo $row['ID'] ?>,"<?php echo $row['tipo_reserva'] ?>")' style='width: 100%;' class="btn btn-default"><?php echo $tipo_de_reserva; ?></button>-->

												<!------------------------CONSULTA PARA EL BOTON---------------------->
												 <?php if ($row['bookingNotes'] == 'Pre-Reserva'): ?>

																<button style='width: 100%; background-color: #ffebcc;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'Bajo Petición'): ?>

																<button style='width: 100%; background-color: #f5ccff;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'De Propietario'): ?>

																<button style='width: 100%; background-color: #ccccff;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'Confirmada'): ?>

																<button style='width: 100%; background-color: #ffffcc;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'Pagada'): ?>

																<button style='width: 100%; background-color: #d6f5d6;' class="btn"><?php echo $tipo_de_reserva; ?></button>
														<?php elseif($row['bookingNotes'] == 'Pendiente de Pago'): ?>

																<button style='width: 100%; background-color: #ffccdd;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'Pagado Deposito'): ?>

																<button style='width: 100%; background-color: #bf8040;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'Pago Error'): ?>

																<button style='width: 100%; background-color: #ff3300;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'Cierre de Ventas'): ?>

																<button style='width: 100%; background-color: #cccccc;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'Bloqueado'): ?>

																<button style='width: 100%; background-color: #e6e6e6;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'Cancelada'): ?>

															<button style='width: 100%; background-color: #ffd9cc;' class="btn"><?php echo $tipo_de_reserva; ?></button>

														<?php elseif($row['bookingNotes'] == 'DESCONOCIDO'): ?>

															<button style='width: 100%; background-color: #ffffcc;' class="btn">RESERVA VP.COM</button>	

														<?php else: ?>
															<button class="btn btn-default btn-block">Sin Asignar</button>

													<?php endif ?>






												<!------------------------CONSULTA PARA EL BOTON---------------------->



										</td>

										<td><?php echo $row['bookingComm'] ?></td>
										<td><?php echo $row['bookingOwnerFee'] ?></td>
										<td><?php echo $row['bookingCharges'] ?></td>
										<td><?php echo $row['bookingFeeType'] ?></td>

										<td>
											<?php echo $row['Address'] ?>
										</td>										

										<td>
											<?php echo $row['bookingComm'] ?>
										</td>

										<td>
											<?php echo $row['bookingAdults'] ?>
										</td>

										<td>
											<?php echo $row['bookingChildren'] ?>
										</td>

										<td>
											<?php echo $row['bookingChildAges'] ?>
										</td>

										<td>
											<?php echo $row['bookingNotesPrivate'] ?>
										</td>

										<td>
											<!--FORMATEO DE LOS DATOS-->
											<?php 
													/*if (empty($row['bookingComm'])) {
														$row['bookingComm'] = 0 ;
													}*/

													if (empty($row['bookingOwnerFee']) || !is_numeric($row['bookingOwnerFee'])) {
														$row['bookingOwnerFee'] = 0 ;
													}

													if (empty($row['bookingCharges']) || !is_numeric($row['bookingCharges'])) {
														$row['bookingCharges'] = 0 ;
													}
													if (empty($row['bookingFeeType']) || !is_numeric($row['bookingFeeType'])) {
														$row['bookingFeeType'] = 0 ;
													}

													/*if (empty($row['bookingDeposit'])) {
														$row['bookingDeposit'] = 0 ;
													}*/

													if (!empty($row['bookingComm']) AND $row['bookingComm'] != '0.00') {
														$total = $row['bookingComm'];

													}elseif(!empty($row['bookingDeposit']) AND $row['bookingDeposit'] != '0.00'){
														$total = $row['bookingDeposit'];
													}else{
														$total = 0;
													}
											 ?>

											<!--FORMATEO DE LOS DATOS-->

											<?php echo ($total) - ($row['bookingOwnerFee'] + $row['bookingCharges']+$row['bookingFeeType']) ?> Euros
										</td>

										<td>
											<div class="uk-grid uk-grid-small">
												<!--<a style='color: black;' onclick="previewModal('<?php// echo $row['ID']?>')" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>-->
												<a style='color: black;' onclick="modalEditarReservas(<?php echo $row['ID']?>)"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>												
										</div>
										</td>

</tr>
<!--CUERPO DE LA PAGINA-->
<?php

}// WHILE 1
?>
                            </tbody>
                        </table>
		</div>
	</div>



