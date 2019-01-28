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
$activo="blog";
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
	<h3 class="yellow" style="font-weight:600"><span uk-icon="icon:plus-circle" class="icon-margin3"></span> Añadir nueva noticia</h3>
	<hr class="uk-article-divider">
<div class="uk-width-1-1">
<form class="uk-form-stacked" id="property" action="">
<div class="uk-grid uk-grid-medium">

	
		<div class="uk-width-1-1 ">
 
	<div class="uk-width-1-1">
    <div class="uk-grid">
		 <div class="uk-width-1-1"><label class="uk-form-label" for="form-stacked-text">Referencia noticia </label>
        <div class="uk-form-controls">
		<?php $refauto = $db->prepare("SELECT CodiProp FROM Blog ORDER BY CodiProp DESC LIMIT 1");
			   $refauto->setFetchMode(PDO::FETCH_ASSOC);
$refauto->execute();
while ($refauto1 = $refauto->fetch()){ 
$ref_ok=$refauto1['CodiProp']+1;
?>
<input class="uk-input uk-width-1-6" id="ref-venta" type="text" value="<?php echo $ref_ok;?>" disabled><?php }?> <span style="display:inline">&nbsp;<span uk-icon="icon:info; ratio:0.9;" class="icon-margin3"></span> <strong> Se genera automáticamente.</strong> No puede ser cambiada.</span>
        </div>
			
		</div>
		
		
		</div>
		
	</div>
		
    </div>
		<div class="uk-width-1-1 margin-forms">
        <label class="uk-form-label" for="form-stacked-text">Selecciona a que categorías pertenece</label>
        <div class=" uk-grid-medium uk-child-width-auto uk-grid margin-forms">
			<?php $refauto2 = $db->prepare("SELECT DISTINCT Nombre FROM Etiquetas ORDER BY Nombre asc");
			   $refauto2->setFetchMode(PDO::FETCH_ASSOC);
$refauto2->execute();
while ($refauto22 = $refauto2->fetch()){ ?>
            <label style="cursor:pointer"><input id="" class="uk-checkbox" type="checkbox">&nbsp; <?php echo $refauto22['Nombre'];?></label>
            <?php }?>
	
        </div>
		<hr class="uk-article-divider " style="margin-top:35px;">
    </div>
	
			<div class="uk-width-1-1 margin-forms">
        <label class="uk-form-label" for="form-stacked-text">Título notícia</label>
        <div class="uk-form-controls">
         <div class="uk-grid">
			 <div class="uk-width-1-3">
				 <p class="grey3" style="margin:5px 0 10px 0;"><img src="<?php echo DIR;?>images/castellano-flag.png">&nbsp; Título Castellano</p>
				 <input class="uk-input " type="text">
			 </div>
			 <div class="uk-width-1-3">
				 <p class="grey3" style="margin:5px 0 10px 0;"><img src="<?php echo DIR;?>images/uk-flag.png">&nbsp; Título Inglés</p>
				 <input class="uk-input " type="text">
			 </div>
			 <div class="uk-width-1-3">
				 <p class="grey3" style="margin:5px 0 10px 0;"><img src="<?php echo DIR;?>images/deustche-flag.png">&nbsp; Título Alemán</p>
				 <input class="uk-input " type="text">
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
				<textarea  name="descripcion" style="height:150px;"  class="uk-input uk-width-1-1"><?=$descripcion?></textarea>
			 </div>
			 <div class="uk-width-1-3">
				 <p class="grey3" style="margin:5px 0 10px 0;"><img src="<?php echo DIR;?>images/uk-flag.png">&nbsp; Texto destacado Inglés</p>
				<textarea  name="descripcion" style="height:150px;"  class="uk-input uk-width-1-1"><?=$descripcion?></textarea>
			 </div>
			 <div class="uk-width-1-3">
				 <p class="grey3" style="margin:5px 0 10px 0;"><img src="<?php echo DIR;?>images/deustche-flag.png">&nbsp; Texto destacado Alemán</p>
				 <textarea  name="descripcion" style="height:150px;"  class="uk-input uk-width-1-1"><?=$descripcion?></textarea>
			 </div>
		</div>
        </div>
		
    </div>
			<div class="uk-width-1-1 margin-forms">
        <label class="uk-form-label" for="form-stacked-text">Descripción de la noticia</label>
        <ul class="uk-subnav uk-subnav-pill" uk-switcher="animation: uk-animation-fade">
    <li><a href="#"> <p class="grey3" style="margin:5px 0 10px 0;"><img src="../images/castellano-flag.png">&nbsp; Descripción Castellano</p></a></li>
    <li><a href="#"><p class="grey3" style="margin:5px 0 10px 0;"><img src="../images/uk-flag.png">&nbsp; Descripción Inglés</p></a></li>
    <li><a href="#"><p class="grey3" style="margin:5px 0 10px 0;"><img src="../images/deustche-flag.png">&nbsp; Descripción Alemán</p></a></li>
</ul>

<ul class="uk-switcher uk-margin">
    <li> <textarea  id="editor1" name="descripcion"  class="uk-width-1-1"><?=$descripcion?></textarea>
            <script>
	
              CKEDITOR.replace( 'editor1', {
   filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl : '../filemanager/dialog.php?type=1&editor=ckeditor&fldr=' });</script></li>
    <li><textarea  id="editor2" name="descripcion"  class="uk-width-1-1"><?=$descripcion?></textarea>
		<script>
	
              CKEDITOR.replace( 'editor2', {
   filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl : '../filemanager/dialog.php?type=1&editor=ckeditor&fldr=' });</script>
           </li>
    <li><textarea  id="editor3" name="descripcion"  class="uk-width-1-1"><?=$descripcion?></textarea>
		<script>
	
              CKEDITOR.replace( 'editor3', {
   filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl : '../filemanager/dialog.php?type=1&editor=ckeditor&fldr=' });</script>
           </li>
</ul>
				
		
		
    </div>
	</div>
	
		<div class="uk-width-1-1 margin-forms">
		<hr class="uk-article-divider">
	</div>
	
		<div class="uk-width-1-1 margin-forms">
   
    <h5 class="grey-titles"><strong>Galería de imagenes</strong></h5> 
			<div class="uk-width-1-1 uk-text-center">
	<div uk-spinner="ratio: 2" id="loading-indicator" style="display:none" ></div>	
			</div>
<ul id="gallery" class="uk-grid-medium uk-child-width-1-2 uk-child-width-1-9@s uk-text-center" uk-sortable="handle: .image" uk-grid style="display:none"></ul>
    
			<div class="js-upload uk-placeholder uk-text-center">
   
    
    <div uk-form-custom>
        <input id="multiFiles" name="files[]" type="file" multiple="multiple">
        <button class="uk-button uk-link uk-margin-left uk-margin-small-top"> <span uk-icon="icon: cloud-upload; ratio:1.3"></span> Selección de imágenes</button>
    </div>
</div>
			


	</div>
	<div class="uk-width-1-1 margin-forms">
		<hr class="uk-article-divider">
	</div>
	
		
	

	
		
	
	</div>
	<div class="uk-margin-large-top">
		 <button class="uk-button uk-button-primary" type="button"><strong>Guardar y publicar&nbsp; <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button>
	 <button class="uk-button uk-button-default uk-modal-close" onclick="backDetect()" type="button">Guardar sin publicar</button>
           
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
<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyAlD35Pnso2gahg3OiljQnNPyYF6OsLiPo&sensor=false&libraries=places'></script>
<script src="../js/locationpicker.jquery.min.js"></script>
<script>
	function updateControls(addressComponents) {
  
    $('#map-city').val(addressComponents.city);
	$('#map-zip').val(addressComponents.postalCode);
		 
 
		
   
}
            $('#map').locationpicker({
                location: {
                    latitude: 39.8439258,
                    longitude: 3.1300568
                },
                radius: 400,
				fillColor: '#FF0000',

				zoom:15,
				addressFormat: 'street_number',
				markerIcon: 'images/map-marker.png',
                inputBinding: {
                    latitudeInput: $('#map-lat'),
                    longitudeInput: $('#map-lon'),
                    radiusInput: $('#map-radius'),
                    locationNameInput: $('#map-address')
                },
                enableAutocomplete: true,
				enableAutocompleteBlur: true,
				oninitialized : function (component) {
      $('#map-address').val('');
	  $('#map-lat').val('');
	  $('#map-lon').val('');				
   },
                onchanged: function (currentLocation, radius, isMarkerDropped) {
         var addressComponents = $(this).locationpicker('map').location.addressComponents;
        updateControls(addressComponents);
                }
            });
        </script>
      
<script type="text/javascript">
        $(document).ready(function () {
			$('.box-gallery').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultadao para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
			
		});$('#property').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});</script>
<script>

    
    UIkit.upload('.js-upload');
</script>
<script type="text/javascript">
		
             $(document).ready(function(e){

            $("#multiFiles").change(function(){
                    var form_data = new FormData();
                    var ins = document.getElementById('multiFiles').files.length;
                    for (var x = 0; x < ins; x++) {
                        form_data.append("files[]", document.getElementById('multiFiles').files[x]);
                    }
				$('#gallery').show();
                    $.ajax({
                        url: '<?php echo DIR;?>propiedades/uploads-blog.php', 
                        dataType: 'text', 
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
						beforeSend: function(){
   $('#loading-indicator').show();
  },
                        success: function (response) {
							$('#loading-indicator').hide();
                            $('#gallery').append(response); 
							
                        },
                        error: function (response) {
                            $('#gallery').html(response); 
                        }
                    });
                });
            });
        </script>
<script type="text/javascript">
$(document).ready(function () {
    var ckbox = $('#tipopropiedad2');
	var ckbox2 = $('#tipopropiedad1');
    var ckbox3 = $('#tipopropiedad3');
	var ckbox4 = $('#tipopropiedad4');
	var ckbox4 = $('#tipopropiedad4');
	
	$('#tipopropiedad1').on('click',function () {
	if (ckbox2.is(':checked')) {
	$.ajax({
	type: "POST",
	url: "<?php echo DIR;?>layout/generar-ref.php",
	data:'accionref='+'venta',
		
	success: function(data){
		$("#ref-venta").val(data);
		$("#ref-venta").attr('disabled',false);
		
	}
	});
} 
else  {
	$("#ref-venta").val('');
	$("#ref-venta").attr('disabled',true);
	
} 
		
	});
	$('#tipopropiedad2,#tipopropiedad3,#tipopropiedad4').on('click',function () {
	if ((ckbox.is(':checked')) || (ckbox3.is(':checked')) || (ckbox4.is(':checked')) ) {
	$.ajax({
	type: "POST",
	url: "<?php echo DIR;?>layout/generar-ref.php",
	data:'accionref='+'alquiler',
	success: function(data){
		$("#ref-alquiler").val(data);
		$("#ref-alquiler").attr('disabled',false);
		
	}
	});
} 
else  {
	$("#ref-alquiler").val('');
	$("#ref-alquiler").attr('disabled',true);
	
} });
    $('#tipopropiedad2').on('click',function () {
        if (ckbox.is(':checked')) {
 $('#alertchecked').append("<div class='message uk-alert-danger uk-margin-top ' style='padding:10px'>Al seleccionar alquiler vacacional, los otros tipos de alquiler quedarán desactivados.</div>");
setTimeout(function() {
  $('.message').fadeOut();
}, 3200);
		   ckbox3.attr('disabled', true);
		   ckbox3.attr('checked', false);
		   ckbox4.attr('disabled', true);
		   ckbox4.attr('checked', false);
        } else {
             ckbox2.removeAttr('disabled');
		    ckbox3.removeAttr('disabled');
			ckbox4.removeAttr('disabled');
        }
    });
});
$(document).on("change",".superficie", function() {
    var sum = 0;
    $(".superficie").each(function(){
        sum += +$(this).val();
    });
    $(".suptotal").val(sum);
});	
</script>
<script type="text/javascript" language="javascript">
              $(window).bind('beforeunload', function(){
  return "Do you want to exit this page?";
});
    </script>
<script>
        $(window).load(function(){
          $('body').backDetect(function(){
			  var result = window.confirm('This page is asking you to confirm that you want to leave - data you have entered may not be saved');
			  if (result == false) {
              backDetect();
            };
          });
			
        });
	
    </script>
<script type="text/javascript" >
        $(document).ready(function () {
			$('.box-gallery-poblaciones').SumoSelect({search: false, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultados para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
			$('.car-options').SumoSelect({search: false, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultados para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});

$('select.box-gallery-poblaciones')[0].sumo.disable();


				$('.box-gallery-poblaciones1').SumoSelect({search: false, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultados para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
			$('select.box-gallery-poblaciones1')[0].sumo.disable();
			

	

		});
 </script>
</body> 
</html>