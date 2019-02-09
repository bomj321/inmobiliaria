<?php
 //require('../includes/config2.php');
 require('../includes/config_reservas.php');

$id=$_POST['id'];
$stmt = $db->prepare("SELECT * FROM rental_enquiries WHERE ID='$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();
?>
<!--SECCION PARA AGREGAR EDICION-->

<!-----------------------------------------CUERPO DE LA PAGINA-->

	<form id="updatereserva">
		<input type="hidden" value='<?php echo $row['ID']?>' name='id_reserva'>
			<!--PRIMERA FILA-->		
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
						    <label for="id_cliente">Cliente</label>
						    <select class="form-control box-gallery" id="id_cliente" required="true" name="id_cliente">
						      <option value="">Seleccione</option>
						      <?php 	
						   $clientes = $db->prepare("SELECT clientName,ID FROM clients ORDER BY ID desc limit 5000");
						   $clientes->setFetchMode(PDO::FETCH_ASSOC);
								$clientes->execute();
						while ($clientes_rows = $clientes->fetch())
						{
							?>
							   <option <?php echo $row['ClientID'] == $clientes_rows['ID'] ? 'selected' : '' ?> value="<?php echo $clientes_rows['ID']?>"><?php echo $clientes_rows['clientName'];?></option>
							<?php 
							 }
							 ?>		    
						    </select>
				 	 </div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
						    <label for="id_propiedad">Propiedades (Short)</label>
						    <select class="form-control box-gallery-propiedad" id="id_propiedad" required="true" name="id_propiedad">
						      <option value="">Seleccione</option>
						      <?php 	
						   $propiedades = $db->prepare("SELECT propTown,yourRef,propNameES,ID FROM rentals WHERE rentalType = 'short' ORDER BY ID desc");
						   $propiedades->setFetchMode(PDO::FETCH_ASSOC);
								$propiedades->execute();
						while ($propiedades_rows = $propiedades->fetch())
						{
							?>
							   <option <?php echo $row['PropID'] == $propiedades_rows['ID'] ? 'selected' : '' ?> value="<?php echo $propiedades_rows['ID']?>">
							   		Ref: <?php echo $propiedades_rows['yourRef']?>, Nombre: <?php echo $propiedades_rows['propNameES']?>
							   		
							   	</option>
							<?php 
							 }
							 ?>		    
						    </select>
				 	 </div>
			</div>
		</div>
			
<!--PRIMERA FILA-->

<!--SEGUNDA FILA-->
<div class="row">
	<div class="col-md-6 col-sm-6">
		 <div class="form-group">
				    <label for="tipo_reserva">Tipo de Reserva</label>
				     <select class="form-control" id="tipo_reserva" required="true" name="tipo_reserva">
				      <option value="">Seleccione</option>	
				       <option <?php echo $row['bookingNotes'] == 'Pre-Reserva' ? 'selected' : '' ?> value="Pre-Reserva">Pre-Reserva</option>
  			          <option <?php echo $row['bookingNotes'] == 'Bajo Petición' ? 'selected' : '' ?> value="Bajo Petición">Bajo Petición</option>
  			          <option <?php echo $row['bookingNotes'] == 'De Propietario' ? 'selected' : '' ?> value="De Propietario">De Propietario</option>
  			          <option <?php echo $row['bookingNotes'] == 'Confirmada' ? 'selected' : '' ?> value="Confirmada">Confirmada</option>
  			          <option <?php echo $row['bookingNotes'] == 'Pagada' ? 'selected' : '' ?> value="Pagada">Pagada</option>
  			          <option <?php echo $row['bookingNotes'] == 'Pendiente de Pago' ? 'selected' : '' ?> value="Pendiente de Pago">Pendiente del Pago</option>
  			          <option <?php echo $row['bookingNotes'] == 'Pagado Deposito' ? 'selected' : '' ?> value="Pagado Deposito">Pagado Deposito</option>
  			          <option <?php echo $row['bookingNotes'] == 'Pago Error' ? 'selected' : '' ?> value="Pago Error">Pago Error</option>
  			          <option <?php echo $row['bookingNotes'] == 'Cierre de Ventas' ? 'selected' : '' ?> value="Cierre de Ventas">Cierre de Ventas</option>
  			          <option <?php echo $row['bookingNotes'] == 'Bloqueado' ? 'selected' : '' ?> value="Bloqueado">Bloqueado</option>
  			          <option <?php echo $row['bookingNotes'] == 'Cancelada' ? 'selected' : '' ?> value="Cancelada">Cancelada</option>		         
				    </select>
		 	 </div>
	</div>
	<div class="col-md-6 col-sm-6">
		<div class="form-group">
				    <label for="touroperador">Tour Operador</label>
				    <select class="form-control" id="touroperador" required="true" name="touroperador">
				      <option value="">Seleccione</option>	
				      <option <?php echo $row['touroperador'] == 'Touroperador 1' ? 'selected' : '' ?> value="Touroperador 1">Touroperador 1</option>
  			          <option <?php echo $row['touroperador'] == 'Touroperador 2' ? 'selected' : '' ?> value="Touroperador 2">Touroperador 2</option>
  			          <option <?php echo $row['touroperador'] == 'Touroperador 3' ? 'selected' : '' ?> value="Touroperador 3">Touroperador 3</option>
  			          <option <?php echo $row['touroperador'] == 'Touroperador 4' ? 'selected' : '' ?> value="Touroperador 4">Touroperador 4</option>
  			          <option <?php echo $row['touroperador'] == 'Touroperador 5' ? 'selected' : '' ?> value="Touroperador 5">Touroperador 5</option>  			         	         
				    </select>
		 	 </div>
	</div>
</div>
<!--SEGUNDA FILA-->

<!--TERCERA FILA-->	
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
			    <label for="fecha_entrada">Fecha de Entrada</label>
			    <input value='<?php echo $row['enquiryStart']?>' type="date" class="form-control" id="fecha_entrada" placeholder="Fecha de Entrada" name="fecha_entrada">
 		   </div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
			    <label for="fecha_salida">Fecha de Salida</label>
			    <input value='<?php echo $row['enquiryEnd']?>' type="date" class="form-control" id="fecha_salida" placeholder="Fecha de Salida" name="fecha_salida">
 		   </div>
	</div>
</div>	 	
<!--TERCERA FILA-->
		 	

<!--CUARTA FILA-->
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<?php 
			$phpdate = strtotime( $row['dateAdded'] );
			$fecha = date( 'Y-m-d', $phpdate );			
			 ?>
			    <label for="fecha_reserva">Fecha de la Reserva</label>
			    <input value='<?php echo $fecha?>' type="date" class="form-control" id="fecha_reserva" placeholder="Fecha de Salida" name="fecha_reserva">
 		   </div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		 <div class="form-group">
			    <label for="adults">Adultos</label>
			    <input value='<?php echo $row['bookingAdults']?>' type="text" class="form-control" id="adults" placeholder="Números de Adultos" name="adults">
 		   </div>
	</div>
</div>
<!--CUARTA FILA-->


<!--QUINTA FILA-->
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-12">
		  <div class="form-group">
			    <label for="childrens">Ni&ntilde;os</label>
			    <input value='<?php echo $row['bookingChildren']?>' type="text" class="form-control" id="childrens" placeholder="Números de Ni&ntilde;os" name="childrens">
 		   </div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		  <div class="form-group">
			    <label for="age_childrens">Edad de los Niños</label>
			    <input value='<?php echo $row['bookingChildAges']?>' type="text" class="form-control" id="age_childrens" placeholder="Ej: 12,13,14" name="age_childrens">
 		   </div>
	</div>
</div>
<!--QUINTA FILA-->

<!--QUINTA FILA-->
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-12">
		  <div class="form-group">
			    <label for="bookingCot">BookingCot</label>
			    <input value='<?php echo $row['bookingCot']?>' type="text" class="form-control" id="bookingCot" placeholder="bookingCot" name="bookingCot">
 		   </div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			    <label for="precio">Precio</label>
			    <input value='<?php echo $row['bookingComm']?>' type="text" class="form-control" id="precio" placeholder="Precio" name="bookingComm" onkeypress="return solonumeros(event)">
 		   </div>	
		 
	</div>
</div>
<!--QUINTA FILA-->


<!--SEXTA FILA-->
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-12">
		 <div class="form-group">
			    <label for="bookingFeeType">Descuento</label>
			    <input value='<?php echo $row['bookingFeeType']?>' type="text" class="form-control" id="bookingFeeType" placeholder="Descuento" onkeypress="return solonumeros(event)" name="bookingFeeType">
 		   </div>
			
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			    <label for="bookingDeposit">Pagado</label>
			    <input value='<?php echo $row['bookingDeposit']?>' type="text" class="form-control" id="bookingDeposit" placeholder="Pagado" name="bookingDeposit" onkeypress="return solonumeros(event)">
 		   </div>	
	</div>
</div>
<!--SEXTA FILA-->	

<!--SEPTIMA FILA-->
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
					 <label for="bookingOutstanding">Pendiente</label>
		 		   <div class="input-group"> 		   		
						  <input value='<?php echo $row['bookingOutstanding']?>' type="text" class="form-control" id="bookingOutstanding" readonly name="bookingOutstanding" aria-describedby="pendiente_calculo">
						   <span onclick='calculo_precio()' style='cursor: pointer;' class="glyphicon glyphicon-euro input-group-addon" id="pendiente_calculo" aria-hidden="true"></span>

					</div>
			</div>			
	</div>

	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			    <label for="bookingOwnerFee">Comisi&oacute;n para el Propietario</label>
			    <input value='<?php echo $row['bookingOwnerFee']?>' type="text" class="form-control" id="bookingOwnerFee" placeholder="Comisi&oacute;n para el Propietario" name="bookingOwnerFee" onkeypress="return solonumeros(event)">
 		   </div>	
	</div>	
</div>
<!--SEPTIMA FILA-->	

<!--OCTAVA FILA-->
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-12">

			<div class="form-group">			
					 <label for="bookingCharges">Comisi&oacute;n para TuOperador</label>
						  <input value='<?php echo $row['bookingCharges']?>' type="text" class="form-control" id="bookingCharges"  name="bookingCharges" placeholder="Comisi&oacute;n para TuOperador" onkeypress="return solonumeros(event)">
						   
			</div>		
	</div>

	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">			
				 	<label for="info_entrada_salida">Informaci&oacute;n Entrada-Salida</label>
 		            <textarea class="form-control" id="info_entrada_salida" name="info_entrada_salida"><?php echo $row['info_entrada_salida']?></textarea>
						   
			</div>	
	</div>	
	
</div>

<!--OCTAVA FILA-->



<!--NOVENA FILA-->
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
	 		   	<label for="enquiryComments">Comentarios Finales</label>
	 		    <textarea class="form-control" id="enquiryComments" name="enquiryComments" rows="3"><?php echo $row['enquiryComments']?></textarea>
 		   </div>

	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
	 		   	<label for="bookingNotesPrivate">Extras</label>
	 		    <textarea class="form-control" id="bookingNotesPrivate" name="bookingNotesPrivate" rows="3"><?php echo $row['bookingNotesPrivate']?></textarea>
 		   </div>
	</div>
</div>
<!--NOVENA FILA-->			
<div class="uk-modal-footer uk-text-right" style="margin-top: 20px;">  
 		    <button type="button" class="uk-button uk-button-default" data-dismiss="modal">Cerrar</button>     
            <button onclick="updatereserva()" class="uk-button uk-button-primary boton_editar" type="button" ><strong>Editar cliente <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button>
 </div>

	</form>




<!-----------------------------------------CUERPO DE LA PAGINA-->


