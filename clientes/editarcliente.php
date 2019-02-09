<script type="text/javascript" src="../ckeditor/ckeditor.js"> </script>
<?php require('../includes/config2.php');




if(!$user->is_logged_in()){ header('Location: ../login'); exit(); }

$title = 'Villas Planet Inmobiliaria - XCONTROLPRO';
$activo="clientes";
$activo2="";
require('../layout/header.php');
?>

<?php
include('../layout/menu.php');
?>

<!--CAPTAR ID DEL CLIENTE-->
<!--SECCION DEL SQL-->
<?php
$id=$_GET['idcliente'];
$stmt = $db->prepare("SELECT * FROM clients WHERE ID='$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();
?>
<!--SECCION DEL SQL-->
<!--CAPTAR ID DEL CLIENTE-->

<?php
if (isset($_GET['tipocliente']) AND !empty($_GET['tipocliente'])) {
	$tipocliente = $_GET['tipocliente'];
}

 ?>


<!-----------------------------------------CUERPO DE LA PAGINA-->
<div class="container-fluid" style="background-color: white; margin-top: 50px;">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
			<h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Edici&oacute;n de Clientes</h5>
		</div>
	</div>

	<form id="addcliente" style="margin-top: 30px;">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
					<!--INOUT ESCONDIDO-->
						<input type="hidden" id="tipocliente_input" value="<?php echo $tipocliente ?>">

					<!--INOUT ESCONDIDO-->
					<!--INPUT CON EL ID A ACTUALIZAR-->
					<input type="hidden" value='<?php echo $row['ID']?>' name='id_cliente'>
					<!--INPUT CON EL ID A ACTUALIZAR-->
					<div class="form-group">
						    <label for="clientType">Tipo de Cliente</label>
						    <select class="form-control" id="clientType" required="true" name="clientType">
						      <option <?php echo $row['clientType'] == 'sale' ? 'selected' : '' ?> value="sale">Venta</option>
						      <option <?php echo $row['clientType'] == 'renta' ? 'selected' : '' ?> value="renta">Renta</option>
						      <option <?php echo $row['clientType'] == 'otros' || $row['clientType'] == 'ALQUILER VACACIONAL' ? 'selected' : '' ?> value="otros">Otros</option>
						    </select>
				 	 </div>

				 	<div class="form-group">
						    <label for="mailerCheck">Checkeo por Email</label>
						    <select class="form-control" id="mailerCheck" required="true" name="mailerCheck">
						      <option <?php echo $row['mailerCheck'] == 'yes' ? 'selected' : '' ?> value="yes">Si</option>
						      <option <?php echo $row['mailerCheck'] == 'no' ? 'selected' : '' ?> value="no">No</option>
						    </select>
				 	 </div>

				 	 <div class="form-group">
						    <label for="source">Desde nos vi&oacute;</label>
						    <select class="form-control" id="source" required="true" name="source">
						      <option <?php echo $row['source'] == 'website' ? 'selected' : '' ?> value="website">Sitio Web</option>
						      <option <?php echo $row['source'] == 'others' ? 'selected' : '' ?> value="others">Otros</option>
						    </select>
				 	 </div>

				 	 <div class="form-group">
						    <label for="foundBy">Como nos encontr&oacute;</label>
						    <select class="form-control" id="foundBy" required="true" name="foundBy">
						      <option <?php echo $row['foundBy'] == 'Ask' ? 'selected' : '' ?> value="Ask">Ask</option>
						      <option <?php echo $row['foundBy'] == 'Google' ? 'selected' : '' ?> value="Google">Google</option>
						      <option <?php echo $row['foundBy'] == 'Periodico' ? 'selected' : '' ?> value="Periodico">Periodico Local</option>
						      <option <?php echo $row['foundBy'] == 'Internet' ? 'selected' : '' ?> value="Internet">Internet</option>
						      <option <?php echo $row['foundBy'] == 'Other' ? 'selected' : '' ?> value="Other">Other</option>
						    </select>
				 	 </div>

				 	  <div class="form-group">
						    <label for="OfficeID">Id de la Oficina</label>
						    <select class="form-control" id="OfficeID" required="true" name="OfficeID">
						      <option <?php echo $row['OfficeID'] == '0' ? 'selected' : '' ?> value="0">0</option>
						      <option <?php echo $row['OfficeID'] == '1' ? 'selected' : '' ?> value="1">1</option>
						    </select>
				 	 </div>

				 	 <div class="form-group">
						    <label for="EmployeeID">Id de los Empleados</label>
						    <select class="form-control" id="EmployeeID" required="true" name="EmployeeID">
						      <option <?php echo $row['EmployeeID'] == '0' ? 'selected' : '' ?> value="0">0</option>
						      <option <?php echo $row['EmployeeID'] == '1' ? 'selected' : '' ?> value="1">1</option>
						    </select>
				 	 </div>

				 	 <div class="form-group">
						    <label for="buyer">¿Es Comprador?</label>
						    <select class="form-control" id="buyer" required="true" name="buyer">
						      <option <?php echo $row['buyer'] == 'yes' ? 'selected' : '' ?> value="yes">SI</option>
						      <option <?php echo $row['buyer'] == 'no' ? 'selected' : '' ?> value="no">No</option>
						    </select>
				 	 </div>

				 	 <div class="form-group">
					    <label for="clientName">Nombre del Cliente</label>
					    <input value='<?php echo $row['clientName']?>' type="text" class="form-control" id="clientName" placeholder="Ingrese nombre del Cliente" name="clientName">
		  			</div>

		  			<div class="form-group">
					    <label for="clientEmail">Direcci&oacute;n de Email</label>
					    <input value='<?php echo $row['clientEmail']?>' type="email" class="form-control" id="clientEmail" placeholder="Ingrese el Correo Electronico"  name="clientEmail">
		 		   </div>

		 		   <div class="form-group">
					    <label for="clientPass">Contraseña de Cliente</label>
					    <input value='<?php echo $row['clientPass']?>' type="text" class="form-control" id="clientPass" placeholder="Ingrese la clave de usuario" name="clientPass">
		 		   </div>




					 <div class="form-group">
					    <label for="pais">Pais del Cliente</label>
					    <input value='<?php echo $row['pais']?>' type="text" class="form-control" id="pais" placeholder="Pais del Cliente" name="pais">
		 		   </div>

		 		    <div class="form-group">
					    <label for="nacimiento">Fecha de Nacimiento</label>
					    <input value='<?php echo $row['nacimiento']?>' type="date" class="form-control" id="nacimiento" placeholder="Fecha de Nacimiento" name="nacimiento">
		 		   </div>




		 		    <div class="form-group">
					    <label for="clientSessionID">ID de la Sesi&oacute;n del Cliente</label>
					    <input value='<?php echo $row['clientSessionID']?>' type="text" class="form-control" id="clientSessionID" placeholder="Ingrese ID de la Sesión" name="clientSessionID">
		 		   </div>

		 		   <div class="form-group">
					    <label for="clientTel1">Telefono #1 de Cliente </label>
					    <input value='<?php echo $row['clientTel1']?>' type="text" class="form-control" id="clientTel1" placeholder="Ingrese un numero telefonico" name="clientTel1">
		 		   </div>

		 		   <div class="form-group">
					    <label for="clientTel2">Telefono #2 de Cliente </label>
					    <input value='<?php echo $row['clientTel2']?>' type="text" class="form-control" id="clientTel2" placeholder="Ingrese un numero telefonico" name="clientTel2">
		 		   </div>

		 		   <div class="form-group">
					    <label for="clientMob">Telefono movil del Cliente </label>
					    <input value='<?php echo $row['clientMob']?>' type="text" class="form-control" id="clientMob" placeholder="Ingrese un numero de movil" name="clientMob">
		 		   </div>

		 		    <div class="form-group">
					    <label for="clientFax">Fax de Cliente</label>
					    <input value='<?php echo $row['clientFax']?>' type="text" class="form-control" id="clientFax" placeholder="Ingrese un numero de Fax" name="clientFax">
		 		   </div>
		</div>

		<div class="col-md-6 col-sm-6 col-xs-12">
		 		   <div class="form-group">
					    <label for="clientAddress">Direcci&oacute;n del Cliente</label>
					    <input value='<?php echo $row['clientAddress']?>' type="text" class="form-control" id="clientAddress" placeholder="Ingrese dirección del Cliente" name="clientAddress">
		 		   </div>

		 		    <div class="form-group">
						    <label for="clientLang">Idioma del Cliente</label>
						    <select class="form-control" id="clientLang" required="true" name="clientLang">
						       <option >-Seleccionar-</option>
						       <option <?php echo $row['clientLang'] == 'es' ? 'selected' : '' ?> value="es">Español</option>
							   <option <?php echo $row['clientLang'] == 'en' ? 'selected' : '' ?> value="en">Ingles</option>
							   <option <?php echo $row['clientLang'] == 'de' ? 'selected' : '' ?> value="de">Aleman</option>
								 <option <?php echo $row['clientLang'] == 'ma' ? 'selected' : '' ?> value="ma">Mallorquin</option>
						    </select>
				 	 </div>

		 		   <div class="form-group">
					    <label for="clientIDNum">Numero de Id del Cliente</label>
					    <input value='<?php echo $row['clientIDNum']?>' type="text" class="form-control" id="clientIDNum" placeholder="Numero de Id del Cliente" name="clientIDNum">
		 		   </div>

		 		 	  <div class="form-group">
						    <label for="propType">Tipo de Propiedades</label>
						    <select class="form-control" id="propType" required="true" name="propType">
						       <option >-Seleccionar-</option>
						       <option <?php echo $row['propType'] == 'all' ? 'selected' : '' ?> value="all">Todos </option>
							   <option <?php echo $row['propType'] == 'Pisos_y_apartamentos' ? 'selected' : '' ?> value="Pisos_y_apartamentos">Pisos y apartamentos</option>
							   <option <?php echo $row['propType'] == 'chalet_villas' ? 'selected' : '' ?> value="chalet_villas">Chalet y villas</option>
							   <option <?php echo $row['propType'] == 'casas_rusticas' ? 'selected' : '' ?> value="casas_rusticas">Casas y fincas rústicas</option>
							   <option <?php echo $row['propType'] == 'casa_pueblo' ? 'selected' : '' ?> value="casa_pueblo">Casas de pueblo</option>
							   <option <?php echo $row['propType'] == 'solares_parcelas' ? 'selected' : '' ?> value="solares_parcelas">Solares y parcelas</option>
						    </select>
				 	 </div>

				 	  <div class="form-group">
					    <label for="propPriceStart">Precio Minimo</label>
					    <input value='<?php echo $row['propPriceStart']?>' type="text" class="form-control" id="propPriceStart" placeholder="Precio Minimo" name="propPriceStart">
		 		   </div>

		 		    <div class="form-group">
					    <label for="propPriceEnd">Precio Maximo</label>
					    <input value='<?php echo $row['propPriceEnd']?>' type="text" class="form-control" id="propPriceEnd" placeholder="Precio Maximo" name="propPriceEnd">
		 		   </div>

		 		    <div class="form-group">
						    <label for="propTowns">Lugar de las Propiedades</label>
						    <select class="form-control" id="propTowns" required="true" name="propTowns">
						       <option >-Seleccionar-</option>
						       <option <?php echo $row['propTowns'] == 'all' ? 'selected' : '' ?> value="all">Todas</option>
								<!--CONSULTA SQL-->
								 <?php
								   $provincias = $db->prepare("SELECT * FROM provincia");
								   $provincias->setFetchMode(PDO::FETCH_ASSOC);
									$provincias->execute();
								while ($provincia = $provincias->fetch()){
									?>
								<!--CONSULTA SQL-->
							   <option <?php echo $provincia['provincia'] == $row['propTowns'] ? 'selected' : '' ?> value="<?php echo $provincia['provincia'] ?>"><?php echo $provincia['provincia'] ?></option>

							<?php  }?>

						    </select>
				 	 </div>


				 	 <div class="form-group">
					    <label for="propBedFrom">Cantidad minima de cuartos</label>
					    <input value='<?php echo $row['propBedFrom']?>' type="text" class="form-control" id="propBedFrom" placeholder="Cantidad minima de cuartos" name="propBedFrom">
		 		   </div>

		 		   <div class="form-group">
					    <label for="propBedTo">Cantidad m&aacute;xima de cuartos</label>
					    <input value='<?php echo $row['propBedTo']?>' type="text" class="form-control" id="propBedTo" placeholder="Cantidad máxima de cuartos" name="propBedTo">
		 		   </div>

		 		   <div class="form-group">
						    <label for="sendMailerMonth">¿Enviar email mensualmente?</label>
						    <select class="form-control" id="sendMailerMonth" required="true" name="sendMailerMonth">
						      <option <?php echo $row['sendMailerMonth'] == 'yes' ? 'selected' : '' ?> value="yes">SI</option>
						      <option <?php echo $row['sendMailerMonth'] == 'no' ? 'selected' : '' ?> value="no">No</option>
						    </select>
				 	 </div>

				 	  <div class="form-group">
						    <label for="sendMailerNew">¿Enviar email sobre Novedades?</label>
						    <select class="form-control" id="sendMailerNew" required="true" name="sendMailerNew">
						      <option <?php echo $row['sendMailerNew'] == 'yes' ? 'selected' : '' ?> value="yes">SI</option>
						      <option <?php echo $row['sendMailerNew'] == 'no' ? 'selected' : '' ?> value="no">No</option>
						    </select>
				 	 </div>

				 	  <div class="form-group">
						    <label for="sendNewsletter">¿Enviar cartas?</label>
						    <select class="form-control" id="sendNewsletter" required="true" name="sendNewsletter">
						      <option <?php echo $row['sendNewsletter'] == 'yes' ? 'selected' : '' ?> value="yes">SI</option>
						      <option <?php echo $row['sendNewsletter'] == 'no' ? 'selected' : '' ?> value="no">No</option>
						    </select>
				 	 </div>

				 	 <div class="form-group">
						    <label for="rentalType">Tipo de Renta</label>
						    <select class="form-control" id="rentalType" required="true" name="rentalType">
						      <option <?php echo $row['rentalType'] == 'any' ? 'selected' : '' ?> value="any">Cualquier Tipo</option>
						      <option <?php echo $row['rentalType'] == 'short' ? 'selected' : '' ?> value="short">Corta</option>
						    </select>
				 	 </div>


				 	 <div class="form-group">
					    <label for="clientFolio">Folio del Cliente</label>
					    <input value='<?php echo $row['clientFolio']?>' type="text" class="form-control" id="clientFolio" placeholder="Numero de Folio del Cliente" name="clientFolio">
		 		   </div>

		 		    <div class="form-group">
						    <label for="clientVIP">¿Es cliente VIP?</label>
						    <select class="form-control" id="clientVIP" required="true" name="clientVIP">
						      <option <?php echo $row['clientVIP'] == 'yes' ? 'selected' : '' ?> value="yes">SI</option>
						      <option <?php echo $row['clientVIP'] == 'no' ? 'selected' : '' ?> value="no">NO</option>
						    </select>
				 	 </div>


				 	  <div class="form-group">
					    <label for="SSMA_TimeStamp">SSMA fecha de Inicio</label>
					    <input value='<?php echo $row['SSMA_TimeStamp']?>' type="date" class="form-control" id="SSMA_TimeStamp" placeholder="SSMA fecha de Inicio" name="SSMA_TimeStamp">
		 		   </div>

		 		    <div class="form-group">
					    <label for="clientNotes">Notas del Cliente</label>
					    <textarea name="clientNotes" id="clientNotes" class="form-control" placeholder="Ingrese las notas del cliente"><?php echo $row['clientNotes']?></textarea>
		 		   </div>
		 	</div>	   
</div>
 		   <button  onclick="updateData()" type="button" class="btn btn-primary">Actualizar Cliente</button>


	</form>

</div>

	<div style="height:30px"></div>



<!-----------------------------------------CUERPO DE LA PAGINA-->


<?php
//include header template
require('../layout/footer.php');
?>


<script type="text/javascript" >
function updateData() {
	var tipocliente = document.getElementById('tipocliente_input').value;

	UIkit.modal.confirm('¿Confirma que desea editar el cliente?', { center:true, labels: { ok: 'Ok', cancel: 'Volver a edición de cliente' } }).then(function() {
   for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
			$.ajax({
                url: '<?php echo DIR;?>clientes/updatecliente', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'text', // data type
                data : $("#addcliente").serialize(), // post data || get data
                success : function(result) {
                   	if (tipocliente == 'sale') {
                   window.location.replace("<?php echo DIR;?>clientes/index");
               } else if (tipocliente == 'renta'){
               		window.location.replace("<?php echo DIR;?>clientes/alquiler");
               }else if(tipocliente == 'otros') {
               		window.location.replace("<?php echo DIR;?>clientes/otros");
               }

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
