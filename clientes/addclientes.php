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

<?php
if (isset($_GET['tipocliente']) AND !empty($_GET['tipocliente'])) {
	$tipocliente = $_GET['tipocliente'];
}

 ?>

<!-----------------------------------------CUERPO DE LA PAGINA-->
<div class="container-fluid" style="background-color: white; margin-top: 50px;">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
			<h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Alta de Clientes</h5>
		</div>
	</div>

	<form id="addcliente" style="margin-top: 30px;">

<!--INOUT ESCONDIDO-->
<input type="hidden" id="tipocliente_input" value="<?php echo $tipocliente ?>">

<!--INOUT ESCONDIDO-->

<div class="row">
	
	<div class="col-md-6 col-sm-6 col-xs-12">



			<div class="form-group">
				    <label for="clientType">Tipo de Cliente</label>
				    <select class="form-control" id="clientType" required="true" name="clientType">
				      <option value="sale">Venta</option>
				      <option value="renta">Renta</option>
				      <option value="otros">Otros</option>
				    </select>
		 	 </div>

		 	<div class="form-group">
				    <label for="mailerCheck">Checkeo por Email</label>
				    <select class="form-control" id="mailerCheck" required="true" name="mailerCheck">
				      <option value="yes">Si</option>
				      <option value="no">No</option>
				    </select>
		 	 </div>

		 	 <div class="form-group">
				    <label for="source">Desde nos vi&oacute;</label>
				    <select class="form-control" id="source" required="true" name="source">
				      <option value="website">Sitio Web</option>
				      <option value="others">Otros</option>
				    </select>
		 	 </div>

		 	 <div class="form-group">
				    <label for="foundBy">Como nos encontr&oacute;</label>
				    <select class="form-control" id="foundBy" required="true" name="foundBy">
				      <option value="Ask">Ask</option>
				      <option value="Google">Google</option>
				      <option value="Periodico">Periodico Local</option>
				      <option value="Internet">Internet</option>
				      <option value="Other">Other</option>
				    </select>
		 	 </div>

		 	  <div class="form-group">
				    <label for="OfficeID">Id de la Oficina</label>
				    <select class="form-control" id="OfficeID" required="true" name="OfficeID">
				      <option value="0">0</option>
				      <option value="1">1</option>
				    </select>
		 	 </div>

		 	 <div class="form-group">
				    <label for="EmployeeID">Id de los Empleados</label>
				    <select class="form-control" id="EmployeeID" required="true" name="EmployeeID">
				      <option value="0">0</option>
				      <option value="1">1</option>
				    </select>
		 	 </div>

		 	 <div class="form-group">
				    <label for="buyer">¿Es Comprador?</label>
				    <select class="form-control" id="buyer" required="true" name="buyer">
				      <option value="yes">SI</option>
				      <option value="no">No</option>
				    </select>
		 	 </div>

		 	 <div class="form-group">
			    <label for="clientName">Nombre del Cliente</label>
			    <input type="text" class="form-control" id="clientName" placeholder="Ingrese nombre del Cliente" name="clientName">
  			</div>

  			<div class="form-group">
			    <label for="clientEmail">Direcci&oacute;n de Email</label>
			    <input type="email" class="form-control" id="clientEmail" placeholder="Ingrese el Correo Electronico"  name="clientEmail">
 		   </div>

 		   <div class="form-group">
			    <label for="clientPass">Contraseña de Cliente</label>
			    <input type="text" class="form-control" id="clientPass" placeholder="Ingrese la clave de usuario" name="clientPass">
 		   </div>




			 <div class="form-group">
			    <label for="pais">Pais del Cliente</label>
			    <input type="text" class="form-control" id="pais" placeholder="Pais del Cliente" name="pais">
 		   </div>

 		    <div class="form-group">
			    <label for="nacimiento">Fecha de Nacimiento</label>
			    <input type="date" class="form-control" id="nacimiento" placeholder="Fecha de Nacimiento" name="nacimiento">
 		   </div>

 		     <div class="form-group">
			    <label for="clientSessionID">ID de la Sesi&oacute;n del Cliente</label>
			    <input type="text" class="form-control" id="clientSessionID" placeholder="Ingrese ID de la Sesión" name="clientSessionID">
 		   </div>

 		   <div class="form-group">
			    <label for="clientTel1">Telefono #1 de Cliente </label>
			    <input type="text" class="form-control" id="clientTel1" placeholder="Ingrese un numero telefonico" name="clientTel1">
 		   </div>

 		   <div class="form-group">
			    <label for="clientTel2">Telefono #2 de Cliente </label>
			    <input type="text" class="form-control" id="clientTel2" placeholder="Ingrese un numero telefonico" name="clientTel2">
 		   </div>

 		   <div class="form-group">
			    <label for="clientMob">Telefono movil del Cliente </label>
			    <input type="text" class="form-control" id="clientMob" placeholder="Ingrese un numero de movil" name="clientMob">
 		   </div>

 		     <div class="form-group">
			    <label for="clientFax">Fax de Cliente</label>
			    <input type="text" class="form-control" id="clientFax" placeholder="Ingrese un numero de Fax" name="clientFax">
 		   </div>

</div>

<div class="col-md-6 col-sm-6 col-xs-12">	

 		   <div class="form-group">
			    <label for="clientAddress">Direcci&oacute;n del Cliente</label>
			    <input type="text" class="form-control" id="clientAddress" placeholder="Ingrese dirección del Cliente" name="clientAddress">
 		   </div>

 		    <div class="form-group">
				    <label for="clientLang">Idioma del Cliente</label>
				    <select class="form-control" id="clientLang" required="true" name="clientLang">
				       <option >-Seleccionar-</option>
				       <option value="es">Español</option>
					   <option value="en">Ingles</option>
					   <option value="de">Aleman</option>
						 <option value="ma">Mallorquin</option>				  	   				     	    
				    </select>
		 	 </div>

 		   <div class="form-group">
			    <label for="clientIDNum">Numero de Id del Cliente</label>
			    <input type="text" class="form-control" id="clientIDNum" placeholder="Numero de Id del Cliente" name="clientIDNum">
 		   </div>

 		 	  <div class="form-group">
				    <label for="propType">Tipo de Propiedades</label>
				    <select class="form-control" id="propType" required="true" name="propType">
				       <option >-Seleccionar-</option>
				       <option value="all">Todos </option>
					   <option value="Pisos_y_apartamentos">Pisos y apartamentos</option>
					   <option value="chalet_villas">Chalet y villas</option>
					   <option value="casas_rusticas">Casas y fincas rústicas</option>
					   <option value="casa_pueblo">Casas de pueblo</option>
					   <option value="solares_parcelas">Solares y parcelas</option>
				    </select>
		 	 </div>

		 	  <div class="form-group">
			    <label for="propPriceStart">Precio Minimo</label>
			    <input type="text" class="form-control" id="propPriceStart" placeholder="Precio Minimo" name="propPriceStart">
 		   </div>

 		    <div class="form-group">
			    <label for="propPriceEnd">Precio Maximo</label>
			    <input type="text" class="form-control" id="propPriceEnd" placeholder="Precio Maximo" name="propPriceEnd">
 		   </div>

 		    <div class="form-group">
				    <label for="propTowns">Lugar de las Propiedades</label>
				    <select class="form-control" id="propTowns" required="true" name="propTowns">
				       <option >-Seleccionar-</option>
				       <option value="all">Todas</option>
						<!--CONSULTA SQL-->
						 <?php
						   $provincias = $db->prepare("SELECT * FROM provincia");
						   $provincias->setFetchMode(PDO::FETCH_ASSOC);
							$provincias->execute();
						while ($provincia = $provincias->fetch()){
							?>
						<!--CONSULTA SQL-->
					   <option value="<?php echo $provincia['provincia'] ?>"><?php echo $provincia['provincia'] ?></option>

					<?php  }?>

				    </select>
		 	 </div>


		 	 <div class="form-group">
			    <label for="propBedFrom">Cantidad minima de cuartos</label>
			    <input type="text" class="form-control" id="propBedFrom" placeholder="Cantidad minima de cuartos" name="propBedFrom">
 		   </div>

 		   <div class="form-group">
			    <label for="propBedTo">Cantidad m&aacute;xima de cuartos</label>
			    <input type="text" class="form-control" id="propBedTo" placeholder="Cantidad máxima de cuartos" name="propBedTo">
 		   </div>

 		   <div class="form-group">
				    <label for="sendMailerMonth">¿Enviar email mensualmente?</label>
				    <select class="form-control" id="sendMailerMonth" required="true" name="sendMailerMonth">
				      <option value="yes">SI</option>
				      <option value="no">No</option>
				    </select>
		 	 </div>

		 	  <div class="form-group">
				    <label for="sendMailerNew">¿Enviar email sobre Novedades?</label>
				    <select class="form-control" id="sendMailerNew" required="true" name="sendMailerNew">
				      <option value="yes">SI</option>
				      <option value="no">No</option>
				    </select>
		 	 </div>

		 	  <div class="form-group">
				    <label for="sendNewsletter">¿Enviar cartas?</label>
				    <select class="form-control" id="sendNewsletter" required="true" name="sendNewsletter">
				      <option value="yes">SI</option>
				      <option value="no">No</option>
				    </select>
		 	 </div>

		 	 <div class="form-group">
				    <label for="rentalType">Tipo de Renta</label>
				    <select class="form-control" id="rentalType" required="true" name="rentalType">
				      <option value="any">Cualquier Tipo</option>
				      <option value="short">Corta</option>
				    </select>
		 	 </div>


		 	 <div class="form-group">
			    <label for="clientFolio">Folio del Cliente</label>
			    <input type="text" class="form-control" id="clientFolio" placeholder="Numero de Folio del Cliente" name="clientFolio">
 		   </div>

 		    <div class="form-group">
				    <label for="clientVIP">¿Es cliente VIP?</label>
				    <select class="form-control" id="clientVIP" required="true" name="clientVIP">
				      <option value="yes">SI</option>
				      <option value="no">NO</option>
				    </select>
		 	 </div>


		 	  <div class="form-group">
			    <label for="SSMA_TimeStamp">SSMA fecha de Inicio</label>
			    <input type="date" class="form-control" id="SSMA_TimeStamp" placeholder="SSMA fecha de Inicio" name="SSMA_TimeStamp">
 		   </div>

 		    <div class="form-group">
			    <label for="clientNotes">Notas del Cliente</label>
			    <textarea name="clientNotes" id="clientNotes" class="form-control" placeholder="Ingrese las notas del cliente"></textarea>
 		   </div>
 	</div>	   
</div> 		   

 		   <button  onclick="saveData()" type="button" class="btn btn-primary">Registrar Cliente</button>


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
	var tipocliente = document.getElementById('tipocliente_input').value;
	UIkit.modal.confirm('¿Confirma que desea agregar el cliente?', { center:true, labels: { ok: 'Ok', cancel: 'Volver a alta de cliente' } }).then(function() {
   for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
			$.ajax({
                url: '<?php echo DIR;?>clientes/savecliente', // url where to submit the request
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
                     UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> <strong>Ha habido un error al agregar. Inténtelo de nuevo.</strong>', status: 'danger', timeout:2000})
					alert(error);
                }

			});
}, function () {

});

}
 </script>
