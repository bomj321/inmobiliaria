<script type="text/javascript" src="../ckeditor/ckeditor.js"> </script>
<?php require('../includes/config_reservas.php');




if(!$user->is_logged_in()){ header('Location: ../login'); exit(); }

$title = 'Villas Planet Inmobiliaria - XCONTROLPRO';
$activo="reservas";
$activo2="";
require('../layout/header.php');
?>

<?php
include('../layout/menu.php');
?>

<!--SECCION PARA AGREGAR EDICION-->
<?php
$id=$_GET['idreserva'];
$stmt = $db->prepare("SELECT * FROM rental_enquiries WHERE ID='$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();
?>
<!--SECCION PARA AGREGAR EDICION-->

<!-----------------------------------------CUERPO DE LA PAGINA-->
<div class="container-fluid" style="background-color: white; margin-top: 50px;">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
			<h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Editar Reserva</h5>
		</div>
	</div>

	<form id="updatereserva" style="margin-top: 30px;">
		<input type="hidden" value='<?php echo $row['ID']?>' name='id_reserva'>
			<div class="form-group">
				    <label for="id_cliente">Cliente</label>
				    <select class="form-control" id="id_cliente" required="true" name="id_cliente">
				      <option value="">Seleccione</option>
				      <?php
				   $clientes = $db->prepare("SELECT clientName,ID FROM clients ORDER BY ID desc");
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



		 	<div class="form-group">
				    <label for="id_propiedad">Propiedad</label>
				    <select class="form-control" id="id_propiedad" required="true" name="id_propiedad">
				      <option value="">Seleccione</option>
				      <?php
				   $propiedades = $db->prepare("SELECT propTown,propType,propAddress,ID FROM rentals ORDER BY ID desc limit 5000");
				   $propiedades->setFetchMode(PDO::FETCH_ASSOC);
						$propiedades->execute();
				while ($propiedades_rows = $propiedades->fetch())
				{
					?>
					   <option <?php echo $row['PropID'] == $propiedades_rows['ID'] ? 'selected' : '' ?> value="<?php echo $propiedades_rows['ID']?>">Tipo: <?php echo $propiedades_rows['propType']?>, Direcci&oacute;n: <?php echo $propiedades_rows['propAddress']?>, Lugar:  <?php echo $propiedades_rows['propTown']?></option>
					<?php
					 }
					 ?>
				    </select>
		 	 </div>


		 	  <div class="form-group">
				    <label for="tipo_reserva">Tipo de Reserva</label>
				    <select class="form-control" id="tipo_reserva" required="true" name="tipo_reserva">
				      <option value="">Seleccione</option>
				      <option <?php echo $row['bookingNotes'] == 'Pre-Reserva' ? 'selected' : '' ?> value="Pre-Reserva">Pre-Reserva</option>
  			          <option <?php echo $row['bookingNotes'] == 'Bajo_Petición' ? 'selected' : '' ?> value="Bajo_Petición">Bajo Petición</option>
  			          <option <?php echo $row['bookingNotes'] == 'De_Propietario' ? 'selected' : '' ?> value="De_Propietario">De Propietario</option>
  			          <option <?php echo $row['bookingNotes'] == 'Confirmada' ? 'selected' : '' ?> value="Confirmada">Confirmada</option>
  			          <option <?php echo $row['bookingNotes'] == 'Pagada' ? 'selected' : '' ?> value="Pagada">Pagada</option>
  			          <option <?php echo $row['bookingNotes'] == 'Pendiente_del_Pago' ? 'selected' : '' ?> value="Pendiente_del_Pago">Pendiente del Pago</option>
  			          <option <?php echo $row['bookingNotes'] == 'Pagado_Deposito' ? 'selected' : '' ?> value="Pagado_Deposito">Pagado Deposito</option>
  			          <option <?php echo $row['bookingNotes'] == 'Pago_Error' ? 'selected' : '' ?> value="Pago_Error">Pago Error</option>
  			          <option <?php echo $row['bookingNotes'] == 'Cierre_de_Ventas' ? 'selected' : '' ?> value="Cierre_de_Ventas">Cierre de Ventas</option>
  			          <option <?php echo $row['bookingNotes'] == 'Bloqueado' ? 'selected' : '' ?> value="Bloqueado">Bloqueado</option>
  			          <option <?php echo $row['bookingNotes'] == 'Cancelada' ? 'selected' : '' ?> value="Cancelada">Cancelada</option>
				    </select>
		 	 </div>




			<div class="form-group">
			    <label for="fecha_entrada">Fecha de Entrada</label>
			    <input value='<?php echo $row['enquiryStart']?>' type="date" class="form-control" id="fecha_entrada" placeholder="Fecha de Entrada" name="fecha_entrada">
 		   </div>

 		   <div class="form-group">
			    <label for="fecha_salida">Fecha de Salida</label>
			    <input value='<?php echo $row['enquiryEnd']?>' type="date" class="form-control" id="fecha_salida" placeholder="Fecha de Salida" name="fecha_salida">
 		   </div>


 		   <div class="form-group">
			    <label for="fecha_reserva">Fecha de la Reserva</label>
			    <input value='<?php echo $row['fecha_reserva']?>' type="date" class="form-control" id="fecha_reserva" placeholder="Fecha de Salida" name="fecha_reserva">
 		   </div>


			<div class="form-group">
			    <label for="precio">Precio</label>
			    <input value='<?php echo $row['precio']?>' type="text" class="form-control" id="precio" placeholder="Precio" name="precio">
 		   </div>


 		   <div class="form-group">
			    <label for="adults">Adultos</label>
			    <input value='<?php echo $row['bookingAdults']?>' type="text" class="form-control" id="adults" placeholder="Adultos" name="adults">
 		   </div>


 		   <div class="form-group">
			    <label for="childrens">Ni&ntilde;os</label>
			    <input value='<?php echo $row['bookingChildren']?>' type="text" class="form-control" id="childrens" placeholder="Ni&ntilde;os" name="childrens">
 		   </div>

 		   <div class="form-group">
			    <label for="age_childrens">Edad de los Niños</label>
			    <input value='<?php echo $row['bookingChildAges']?>' type="text" class="form-control" id="age_childrens" placeholder="Ej: 12,13,14" name="age_childrens">
 		   </div>

 		   <div class="form-group">
 		   	<label for="comentarios">Comentarios Finales</label>
 		    <textarea class="form-control" id="comentarios" name="comentarios" rows="3"><?php echo $row['comentarios']?></textarea>
 		   </div>


 		   <button style="margin-bottom: 30px;" onclick="saveData()" type="button" class="btn btn-primary">Editar Reserva</button>


	</form>

</div>

	<div style="height:30px"></div>



<!-----------------------------------------CUERPO DE LA PAGINA-->


<?php
//include header template
require('../layout/footer.php');
?>


<script type="text/javascript" >
function saveData() {
	UIkit.modal.confirm('¿Confirma que desea editar la Reserva?', { center:true, labels: { ok: 'Ok', cancel: 'Volver a edición de Reservas' } }).then(function() {
   for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
			$.ajax({
                url: '<?php echo DIR;?>reservas/updatereservas', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'text', // data type
                data : $("#updatereserva").serialize(), // post data || get data
                success : function(result) {
                   window.location.replace("<?php echo DIR;?>reservas/index");

                },
                error: function(xhr, resp, text,error) {
                     UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> <strong>Ha habido un error al editar. Inténtelo de nuevo.</strong>', status: 'danger', timeout:2000})
					alert(error);
                }

			});
}, function () {

});

}
 </script>
