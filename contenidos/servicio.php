<script type="text/javascript" src="../ckeditor/ckeditor.js"> </script>
<?php require('../includes/config2.php'); 

if(!$user->is_logged_in()){ header('Location: ../login'); exit(); } 

$data = date('Y-m-d');;
$hora =  date('H:i:s');
$IPPROXY = $_SERVER['REMOTE_ADDR'];
$IP = getIP();
$Nav = $_SERVER['HTTP_USER_AGENT'];
$accio="Login";
$observacions="Conectado";

$loging = "INSERT INTO logs (data, hora, usuari, ip_conexio, ip_proxy, navegador, accio, observacions) VALUES ('".$data."','".$hora."','".$_SESSION['username']."','".$IPPROXY."', '".$IP."', '".$Nav."','".$accio."','".$observacions."')";
//$db->exec($loging);
$title = 'Villas Planet Inmobiliaria - XCONTROLPRO';
$activo="web";
$activo2="";
require('../layout/header.php');
?>

<?php 
include('../layout/menu.php'); 

?>

<div class="uk-container">
<div class="uk-grid">
<div class="uk-width-1-1 uk-margin-large-top">
<div class="uk-card card-forms uk-card-body" >
	<h3 class="yellow" style="font-weight:600"><span uk-icon="icon:plus-circle" class="icon-margin3"></span> Añadir nuevo servicio</h3>
	<hr class="uk-article-divider">
<div class="uk-width-1-1">
<form class="uk-form-stacked" id="addservice" action="">
<div class="uk-grid uk-grid-medium">

			<div class="uk-width-1-1 margin-forms">
        <label class="uk-form-label" for="form-stacked-text">Título servicio </label>
        <div class="uk-form-controls">
         <div class="uk-grid">
			 <div class="uk-width-1-3">
				 <p class="grey3" style="margin:5px 0 10px 0;"><img src="<?php echo DIR;?>images/castellano-flag.png">&nbsp; Título Castellano</p>
				 <input class="uk-input" type="text" name="tit_es">
			 </div>
			 <div class="uk-width-1-3">
				 <p class="grey3" style="margin:5px 0 10px 0;"><img src="<?php echo DIR;?>images/uk-flag.png">&nbsp; Título Inglés</p>
				 <input class="uk-input" type="text" name="tit_en">
			 </div>
			 <div class="uk-width-1-3">
				 <p class="grey3" style="margin:5px 0 10px 0;"><img src="<?php echo DIR;?>images/deustche-flag.png">&nbsp; Título Alemán</p>
				 <input class="uk-input" type="text" name="tit_de">
			 </div>
		</div>
        </div>
		
    </div>
	<div class="uk-width-1-1 margin-forms">
        <label class="uk-form-label" for="form-stacked-text">Texto destacado <span style="display:inline">&nbsp;<span uk-icon="icon:info; ratio:0.9;" class="icon-margin3"></span> <strong> Importante para SEO y posicionamiento web.</strong> Máx.Caracteres 250.</span></label>
        <div class="uk-form-controls">
         <div class="uk-grid">
			 <div class="uk-width-1-3">
				 <p class="grey3" style="margin:5px 0 10px 0;"><img src="<?php echo DIR;?>images/castellano-flag.png">&nbsp; Texto destacado Castellano</p>
				<textarea  name="seo_es" style="height:150px;"  class="uk-input uk-width-1-1"></textarea>
			 </div>
			 <div class="uk-width-1-3">
				 <p class="grey3" style="margin:5px 0 10px 0;"><img src="<?php echo DIR;?>images/uk-flag.png">&nbsp; Texto destacado Inglés</p>
				<textarea  name="seo_en" style="height:150px;"  class="uk-input uk-width-1-1"></textarea>
			 </div>
			 <div class="uk-width-1-3">
				 <p class="grey3" style="margin:5px 0 10px 0;"><img src="<?php echo DIR;?>images/deustche-flag.png">&nbsp; Texto destacado Alemán</p>
				 <textarea  name="seo_de" style="height:150px;"  class="uk-input uk-width-1-1"></textarea>
			 </div>
		</div>
        </div>
		
    </div>
			<div class="uk-width-1-1 margin-forms">
        <label class="uk-form-label" for="form-stacked-text">Descripción del servicio</label>
        <ul class="uk-subnav uk-subnav-pill" uk-switcher="animation: uk-animation-fade">
    <li><a href="#"> <p class="grey3" style="margin:5px 0 10px 0;"><img src="../images/castellano-flag.png">&nbsp; Descripción Castellano</p></a></li>
    <li><a href="#"><p class="grey3" style="margin:5px 0 10px 0;"><img src="../images/uk-flag.png">&nbsp; Descripción Inglés</p></a></li>
    <li><a href="#"><p class="grey3" style="margin:5px 0 10px 0;"><img src="../images/deustche-flag.png">&nbsp; Descripción Alemán</p></a></li>
</ul>

<ul class="uk-switcher uk-margin">
    <li> <textarea  id="editor1" name="des_es"  class="uk-width-1-1"></textarea>
            <script>
	
              CKEDITOR.replace( 'editor1', {
   filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl : '../filemanager/dialog.php?type=1&editor=ckeditor&fldr=' });</script></li>
    <li><textarea  id="editor2" name="des_en"  class="uk-width-1-1"></textarea>
		<script>
	
              CKEDITOR.replace( 'editor2', {
   filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl : '../filemanager/dialog.php?type=1&editor=ckeditor&fldr=' });</script>
           </li>
    <li><textarea  id="editor3" name="des_de"  class="uk-width-1-1"></textarea>
		<script>
	
              CKEDITOR.replace( 'editor3', {
   filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl : '../filemanager/dialog.php?type=1&editor=ckeditor&fldr=' });</script>
           </li>
</ul>
				
		
		
    </div>
	</div>
	
	
		
	
	</div>
	<div class="uk-margin-large-top">
		 <button onclick="saveData()"class="uk-button uk-button-primary" type="button"><strong>Guardar<span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button>
	<!-- <button class="uk-button uk-button-default uk-modal-close" onclick="backDetect()" type="button">Guardar sin publicar</button>-->
           
	</div>
</form>	
	</div>
</div>
	<div style="height:30px"></div>
</div>

</div>
</div>
</div>




<?php 
//include header template
require('../layout/footer.php'); 

?>
      
<script>

    
    UIkit.upload('.js-upload');
</script>


<script type="text/javascript" >      

		function saveData(param) {
	$("#activar").val(param);
	UIkit.modal.confirm('¿Confirma que desea Agregar el servicio?', { center:true, labels: { ok: 'Ok', cancel: 'Volver a Alta de Servicio' } }).then(function() {
   for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
			$.ajax({
                url: '<?php echo DIR;?>contenidos/add_servicio', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'text', // data type
                data : $("#addservice").serialize(), // post data || get data
                success : function(result) {
                   window.location.replace("<?php echo DIR;?>contenidos/servicios");
                   
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
</body> 
</html>