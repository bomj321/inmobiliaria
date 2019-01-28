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


<!-----------------------------------------CUERPO DE LA PAGINA-->
<div class="container-fluid col-md-6 col-md-offset-3" style="background-color: white; margin-top: 50px;">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
			<h5 style="background-color: #efefef; font-weight: 600; color: #8b8f91; padding: 10px 10px 10px 10px;">Nuevo Extra o Servicio</h5>
		</div>
	</div>

	<form id="addextra" style="margin-top: 30px;">
<!--------------------------PANEL DE EXTRAS-->		
		<div class="panel panel-default">
		  <div class="panel-heading">INFORMACIÓN GENERAL DEL EXTRA</div>
		  <div class="panel-body"><!--CUERPO DEL PANEL-->
		    		<div class="row">
			<div class="col-md-4 col-xs-12">
				<div class="form-group">
				    <label for="name_es">Nombre en Espa&ntilde;ol <span style="color: red;">*</span></label>
				    <input type="text" class="form-control" id="name_es" placeholder="Ingrese nombre en Español" name="name_es">
  			   </div>
			</div>

			<div class="col-md-4 col-xs-12">
				<div class="form-group">
				    <label for="name_es">Nombre en Ingles<span style="color: red;">*</span></label>
				    <input type="text" class="form-control" id="name_en" placeholder="Ingrese nombre en Ingles" name="name_en">
  			   </div>
			</div>

			<div class="col-md-4 col-xs-12">
				<div class="form-group">
				    <label for="name_es">Nombre en Alem&aacute;n<span style="color: red;">*</span></label>
				    <input type="text" class="form-control" id="name_de" placeholder="Ingrese nombre en Alem&aacute;n" name="name_de">
  			   </div>
			</div>
			 

		</div>


		<div class="row">
			<div class="col-md-4 col-xs-12">
				<div class="form-group">
					    <label for="des_es">Descripci&oacute;n en Espa&ntilde;ol<span style="color: red;">*</span></label>
					    <textarea name="des_es" id="des_es" class="form-control" placeholder="Ingrese Descripción en Español"></textarea>
 		        </div>
			</div>

			<div class="col-md-4 col-xs-12">
				<div class="form-group">
					    <label for="des_en">Descripci&oacute;n en Ingles<span style="color: red;">*</span></label>
					    <textarea name="des_en" id="des_en" class="form-control" placeholder="Ingrese Descripción en Ingles"></textarea>
 		        </div>
			</div>

			<div class="col-md-4 col-xs-12">
				<div class="form-group">
					    <label for="des_de">Descripci&oacute;n en Alem&aacute;n<span style="color: red;">*</span></label>
					    <textarea name="des_de" id="des_de" class="form-control" placeholder="Ingrese Descripción en Alem&aacute;n"></textarea>
 		        </div>
			</div>

		</div>

		    <div class="form-group">
					    <label for="activacion">¿Solicitar activación en web/portales?<span style="color: red;">*</span></label>
					    <select class="form-control" id="activacion" required="true" name="activacion">
					      <option value="0">No,solo para uso interno</option>
					      <option value="1">Sí, solicitar para activación</option>			    
					    </select>
 		   </div>
		  </div><!--CUERPO DEL PANEL-->
		</div>
<!--------------------------PANEL DE EXTRAS-->
		<div class="panel panel-default">
  				<div class="panel-heading">CONDICIONES DE APLICACIÓN DEL SERVICIO</div>
				<div class="panel-body">
				    	<div class="form-group">
				  			  <label for="aplica">¿Cuándo se aplica?<span style="color: red;">*</span></label>
						    <select onchange="tipo_formulario_ajax()" class="form-control" id="aplica" required="true" name="aplica">
						      <option value="0">No se aplica nunca (no disponible)</option>
						      <option value="1">Se aplica si lo elije el turista</option>	
						      <option value="2">Se aplica siempre</option>
						      <option value="3">Se aplica según el número de ocupantes</option>	
						      <option value="4">Se aplica según el número de noches de reserva</option>
						      <option value="5">Se aplica según el número de noches previas a reservas</option>			    
						    </select>
		 				 </div>
		 				 <!--RESPUESTA AJAX-->
		 			        <div id='tipo_formulario_parte_1'></div>
		 			    <!--RESPUESTA AJAX-->
	 
				</div>

				
		</div>
			 	

		 	 

		 


 <!--RESPUESTA AJAX-->		 

 				<div id='tipo_formulario_parte_2'></div>
					
<!--RESPUESTA AJAX-->

 		   <button  onclick="saveData()" type="button" class="btn btn-primary">Registrar Extra</button>


	</form>	

</div>

	<div style="height:1800px"></div>



<!-----------------------------------------CUERPO DE LA PAGINA-->


<?php 
//include header template
require('../layout/footer.php'); 
?>


<script type="text/javascript" >
function saveData() {
var name_es = document.getElementById('name_es').value;
var name_en = document.getElementById('name_en').value;
var name_de = document.getElementById('name_de').value;


var des_es = document.getElementById('des_es').value;
var des_en = document.getElementById('des_en').value;
var des_de = document.getElementById('des_de').value;


if (name_es=='' || name_en=='' || name_de=='' || des_es=='' || des_en=='' || des_de=='') {
 alert('Hay campos Obligatiorios Vacios')
 return false;
}

	UIkit.modal.confirm('¿Confirma que desea agregar el extra?', { center:true, labels: { ok: 'Ok', cancel: 'Volver a alta de extras' } }).then(function() {
   for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
			$.ajax({
                url: '<?php echo DIR;?>extras/saveextra', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'text', // data type
                data : $("#addextra").serialize(), // post data || get data
                success : function(result) {
                   window.location.replace("<?php echo DIR;?>extras/alquileres");
                   
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