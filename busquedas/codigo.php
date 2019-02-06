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

													if (empty($row['bookingOwnerFee'])) {
														$row['bookingOwnerFee'] = 0 ;
													}

													if (empty($row['bookingCharges'])) {
														$row['bookingCharges'] = 0 ;
													}
													if (empty($row['bookingFeeType'])) {
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

											<?php echo ($total) - ($row['bookingOwnerFee'] + $row['bookingCharges']+$row['bookingFeeType']) ?> Euros</td>

										<td>
											<div class="uk-grid uk-grid-small">
												<!--<a style='color: black;' onclick="previewModal('<?php// echo $row['ID']?>')" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>-->
												<a style='color: black;' href="<?php echo DIR;?>reservas/editarreserva?idreserva=<?php echo $row['ID']?>"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>
												<a style='color: black;' onclick="deletedata(<?php echo $row['ID']?>)"><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
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



