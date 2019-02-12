											<?php
												$tipo_de_reserva=str_replace('_', ' ',$row['bookingNotes']);
											 ?>

													<!--<button onclick='cambiarestado(<?php echo $row['ID'] ?>,"<?php echo $row['tipo_reserva'] ?>")' style='width: 100%;' class="btn btn-default"><?php echo $tipo_de_reserva; ?></button>-->

												<!------------------------CONSULTA PARA EL BOTON---------------------->
												 <?php if ($row['bookingNotes'] == 'Pre-Reserva'): ?>

																<button style='width: 100%; background-color: #ffebcc;' class="btn"><?php echo trim($tipo_de_reserva); ?></button>

														<?php elseif($row['bookingNotes'] == 'Bajo Petición'): ?>

																<button style='width: 100%; background-color: #f5ccff;' class="btn"><?php echo trim($tipo_de_reserva); ?></button>

														<?php elseif($row['bookingNotes'] == 'De Propietario'): ?>

																<button style='width: 100%; background-color: #ccccff;' class="btn"><?php echo trim($tipo_de_reserva); ?></button>

														<?php elseif($row['bookingNotes'] == 'Confirmada'): ?>

																<button style='width: 100%; background-color: #ffffcc;' class="btn"><?php echo trim($tipo_de_reserva); ?></button>

														<?php elseif($row['bookingNotes'] == 'Pagada'): ?>

																<button style='width: 100%; background-color: #d6f5d6;' class="btn"><?php echo trim($tipo_de_reserva); ?></button>
														<?php elseif($row['bookingNotes'] == 'Pendiente de Pago'): ?>

																<button style='width: 100%; background-color: #ffccdd;' class="btn"><?php echo trim($tipo_de_reserva); ?></button>

														<?php elseif($row['bookingNotes'] == 'Pagado Deposito'): ?>

																<button style='width: 100%; background-color: #bf8040;' class="btn"><?php echo trim($tipo_de_reserva); ?></button>

														<?php elseif($row['bookingNotes'] == 'Pago Error'): ?>

																<button style='width: 100%; background-color: #ff3300;' class="btn"><?php echo trim($tipo_de_reserva); ?></button>

														<?php elseif($row['bookingNotes'] == 'Cierre de Ventas'): ?>

																<button style='width: 100%; background-color: #cccccc;' class="btn"><?php echo trim($tipo_de_reserva); ?></button>

														<?php elseif($row['bookingNotes'] == 'Bloqueado'): ?>

																<button style='width: 100%; background-color: #e6e6e6;' class="btn"><?php echo trim($tipo_de_reserva); ?></button>

														<?php elseif($row['bookingNotes'] == 'Cancelada'): ?>

															<button style='width: 100%; background-color: #ffd9cc;' class="btn"><?php echo trim($tipo_de_reserva); ?></button>

														<?php elseif($row['bookingNotes'] == 'DESCONOCIDO'): ?>

															<button style='width: 100%; background-color: #ffffcc;' class="btn">RESERVA VP.COM</button>	

														<?php else: ?>
															<button class="btn btn-default">Sin Asignar</button>

													<?php endif ?>






												<!------------------------CONSULTA PARA EL BOTON---------------------->