<script type="text/javascript" src="../ckeditor/ckeditor.js"> </script>
<?php require('../includes/config2.php'); 
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
$activo="propiedades";
$activo2="";
require('../layout/header.php');
?>

<?php 
include('../layout/menu.php'); 
$accion=$_GET['accion'];
$refedit=$_GET['ref'];
if ($accion=="edit"){
$stmt85 = $db->prepare("SELECT * FROM sys_towns where ID='$refedit'");
$stmt85->setFetchMode(PDO::FETCH_ASSOC);
$stmt85->execute();
while ($zonaedit = $stmt85->fetch()){
$activar=$zonaedit['active'];
$cp=$zonaedit['PC'];
$descripcion=$zonaedit['townDescripES'];
$descripcionDE=$zonaedit['townDescripDE'];
$descripcionEN=$zonaedit['townDescripEN'];
$interes=$zonaedit['interesTown'];
$interesDE=$zonaedit['interesTownDE'];
$interesEN=$zonaedit['interesTownEN'];
$coordenadas=$zonaedit['longlatpobla'];	
$coor = explode('-',$zonaedit['longlatpobla']);	
$ocio=$zonaedit['ocioTown'];
$ocioDE=$zonaedit['ocioTownDE'];
$ocioEN=$zonaedit['ocioTownEN'];
$titleTown=$zonaedit['titleTown'];
$titleTownDE=$zonaedit['titleTownDE'];
$titleTownEN=$zonaedit['titleTownEN'];
$town=$zonaedit['Town'];		
}	
	
	
}
?>

<div class="uk-container">
<div class="uk-grid">
<div class="uk-width-1-1 uk-margin-large-top">
<div class="uk-card card-forms uk-card-body" >
	<h3 class="yellow" style="font-weight:600"><span uk-icon="icon:plus-circle" class="icon-margin3"></span> Añadir nueva zona</h3>
	<hr class="uk-article-divider">
<div class="uk-width-1-1 uk-margin-top">
<form class="uk-form-stacked" id="zonaform">
<div class="uk-grid uk-grid-medium">
<input type="text" hidden value="<?php echo $accion?>" name="accion">
<div class="uk-width-1-1">
   
    <h5 class="grey-titles"><strong>Generación automática de zona</strong></h5>   
    <div class="uk-grid ">
	<div class="uk-width-1-3 ">
		<div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-text">Introduzca nombre de zona ( <span style="font-size:11px"><span uk-icon="icon:info; ratio:0.8"></span> La dirección no quedará registrada )</span> </label>
        <div class="uk-form-controls">
            <input class="uk-input" id="map-address" type="text" placeholder="Introduzca la población para completar los campos automáticamente...">
        </div>
    </div>
			<div class="uk-margin">
				<div class="uk-grid uk-grid-medium">
	<div class="uk-width-2-3">
        <label class="uk-form-label" for="form-stacked-text">Población</label>
        <div class="uk-form-controls">
           <input type="text" id="map-city" name="town" class="uk-input" value="">
        </div>
    </div>
					<div class="uk-width-1-3">
        <label class="uk-form-label" for="form-stacked-text">Código Postal</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="map-zip" name="cp" type="text" placeholder="" value="">
        </div>
    </div>
				</div></div>
		<div class="uk-margin">
				<div class="uk-grid uk-grid-medium">
	<div class="uk-width-1-2">
        <label class="uk-form-label" for="form-stacked-text">Latitud</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="map-lat" name="latitud" type="text" placeholder="" value="">
        </div>
    </div>
					<div class="uk-width-1-2">
        <label class="uk-form-label" for="form-stacked-text">Longitud</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="map-lon" name="longitud" type="text" placeholder="" value="">
        </div>
					</div></div>
					<?php if ($accion=="edit"){?><div class="uk-margin">
				
	<div class="uk-width-1-1">
       
        <div class="uk-form-controls">
			
			<ul uk-accordion>
    <li class="uk-open" id="reloadlocalidad">

			<?php $stmt6999 = $db->prepare("SELECT localidades_asociadas FROM sys_towns where Town='$town' and Location='0'");
		
$stmt6999->setFetchMode(PDO::FETCH_ASSOC);
$stmt6999->execute();
while ($row6999 = $stmt6999->fetch()){?>
		
<?php $list=explode(',',$row6999['localidades_asociadas']);
 asort($list);			
				
				?>
									  
				
        <a class="uk-accordion-title grey-titles" href="#" style="font-size:14px; color: #959595 !important;"><strong>Zonas asociadas a la población</strong></a>
        <div class="uk-accordion-content">
		<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            
        </tr>
    </thead>
    <tbody>
		<tr style="font-size:13px;"><td><div class="uk-grid">
			<div class="uk-width-1-3" style="padding-top: 8px;">
				AÑADIR NUEVA</div>
			<div class="uk-width-2-3">
				<input class="uk-input" value="" id="addZona2" name="nueva-area" type="text" placeholder="" style="display:inline;width:70%;"><button onclick="addZona('<?php echo $refedit?>')" class="uk-button uk-button-primary" type="button" style="display:inline;width:30%; text-align:center;padding:0 3px; height:33px;line-height:10px;">Agregar</button>
			</div>
			
			</div></td><td style="text-align:right; float:right; "><div class="uk-grid uk-grid-small">
				
				<td style="text-align:right; float:right; "><div class="uk-grid uk-grid-small">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div></td>
				</div></td></tr>
		<?php foreach ($list as $loc) { if ($loc!="") {?>
	    
        <tr style="font-size:13px;">
            <td><?php echo ucwords($loc);?></td>
           
            <td style="text-align:right; float:right; "><div class="uk-grid uk-grid-small">
				
				<a href="<?php echo DIR;?>zonas/zona?accion=edit&ref=<?php echo $row['ID']?>" style="color:#959595 !important"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>
				
				
				<a onclick="deleteZona('<?php echo strtolower($loc)?>')" style="color:#959595 !important"><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
				
				
				</div></td>
		</tr>
		<?php }}?>
    </tbody>
</table>
		</div>
   
				<?php }?>
		 </li>
			</ul>
			
        </div>
    </div>
	
				
				</div><?php } else if ($accion=="nuevo"){?>
		 <div class=" grey-titles uk-margin-top" style="font-size:14px; color: #959595 !important;"><strong>Zonas asociadas a la población</strong></div><p><span uk-icon="icon:info;"></span> Las zonas sólo podrán ser creadas y gestionadas una vez se haya creado y guardado la nueva población.</p><?php }?>
		</div>
	
		
	</div>
		<div class="uk-width-2-3">
		<div id="map" style="width: 100%; height: 450px;"></div>
			<p><span uk-icon="icon:info; ratio:0.9;" class="icon-margin3"></span> Puedes mover el marcador para seleccionar el punto concreto</p>
	</div>
	</div>
	</div>
	<div class="uk-width-1-1 margin-forms">
		<hr class="uk-article-divider">
	</div>
	
		<div class="uk-width-1-1 margin-forms">
   
    <h5 class="grey-titles"><strong>Datos generales de la zona</strong></h5> 
	<div class="uk-width-1-1">
    <div class="uk-grid">
		 <div class="uk-width-1-1"><label class="uk-form-label" for="form-stacked-text">Referencia zona </label>
        <div class="uk-form-controls">
		<?php $refauto = $db->prepare("SELECT ID FROM sys_towns ORDER BY ID DESC LIMIT 1");
			   $refauto->setFetchMode(PDO::FETCH_ASSOC);
$refauto->execute();
while ($refauto1 = $refauto->fetch()){ 
$ref_ok=$refauto1['ID']+1;
if ($accion=="edit"){$ref_ok=$refedit;}
?>
<input class="uk-input uk-width-1-6" id="ref-venta" type="text" value="<?php echo $ref_ok;?>" disabled>
			<input type="text" name="ref" hidden value="<?php echo $ref_ok;?>"><?php }?> <span style="display:inline"><span uk-icon="icon:info; ratio:0.9;" class="icon-margin3"></span> <strong>Se genera automáticamente.</strong> No puede ser cambiada.</span>
        </div>
			
		</div>
		
		
		</div>
		
	</div>
		
    </div>
			<div class="uk-width-1-1 margin-forms">
        <label class="uk-form-label" for="form-stacked-text">Título </label>
        <div class="uk-form-controls">
         <div class="uk-grid">
			 <div class="uk-width-1-3">
				 <p class="grey3" style="margin:5px 0 10px 0;"><img src="<?php echo DIR;?>images/castellano-flag.png">&nbsp; Título Castellano</p>
				 <input class="uk-input" name="titleTown" type="text" value="<?php echo $titleTown;?>">
			 </div>
			 <div class="uk-width-1-3">
				 <p class="grey3" style="margin:5px 0 10px 0;"><img src="<?php echo DIR;?>images/uk-flag.png">&nbsp; Título Inglés</p>
				 <input class="uk-input " name="titleTownEN" type="text" value="<?php echo $titleTownEN;?>">
			 </div>
			 <div class="uk-width-1-3">
				 <p class="grey3" style="margin:5px 0 10px 0;"><img src="<?php echo DIR;?>images/deustche-flag.png">&nbsp; Título Alemán</p>
				 <input class="uk-input " name="titleTownDE" type="text" value="<?php echo $titleTownDE;?>">
			 </div>
		</div>
        </div>
		
    </div>
			<div class="uk-width-1-1 margin-forms">
        <label class="uk-form-label" for="form-stacked-text">Descripción </label>
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
    <li><textarea  id="editor2" name="descripcionEN"  class="uk-width-1-1"><?=$descripcionEN?></textarea>
		<script>
	
              CKEDITOR.replace( 'editor2', {
   filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl : '../filemanager/dialog.php?type=1&editor=ckeditor&fldr=' });</script>
           </li>
    <li><textarea  id="editor3" name="descripcionDE"  class="uk-width-1-1"><?=$descripcionDE?></textarea>
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
				<ul id="reloadgallery" class="uk-grid-medium uk-child-width-1-2 uk-child-width-1-9@s uk-text-center" uk-grid >
<?php if ($accion=="edit") {?>
<?php $stmt699 = $db->prepare("SELECT * FROM image_zonas where ref='$refedit' order by orden asc");
$stmt699->setFetchMode(PDO::FETCH_ASSOC);
$stmt699->execute();
while ($row699 = $stmt699->fetch()){?>					
<li>

		<div class="image uk-card"><div class="uk-inline-clip uk-transition-toggle uk-light covergallery" tabindex="0"><img src="<?php echo $row699['small']?>"><div class="uk-position-top-right" style="top:10px !important; right:10px !important">
           
            </div></div> <input type="text" class="uk-input uk-text-center" placeholder="Titulo de imagen" <?php if ($row699['caption']!="") {?> value="<?php echo $row699['caption'];?>"<?php }?> disabled></div>
		
			   </li>					
		
<?php }}?>
			</ul>
			<div class="uk-placeholder uk-text-center">
   
    
   

       <?php $refauto = $db->prepare("SELECT ID FROM sys_towns ORDER BY ID DESC LIMIT 1");
			   $refauto->setFetchMode(PDO::FETCH_ASSOC);
$refauto->execute();
while ($refauto1 = $refauto->fetch()){ 
$ref_ok=$refauto1['ID']+1;
	if ($accion=="edit"){$ref_ok=$refedit;}
?>
        <a onclick="previewGallery('<?php echo $ref_ok?>')"><button type="button" class="uk-button uk-link uk-margin-left uk-margin-small-top"> <span uk-icon="icon: cloud-upload; ratio:1.3"></span> <?php if ($accion=="edit") {?> Editar imágenes<?php } else if ($accion=="nuevo") {?> Selección de imágenes <?php }?></button></a><?php }?>
    </div>
</div>
			


	</div>
	<div class="uk-width-1-1 margin-forms">
		<hr class="uk-article-divider">
	</div>
	
		<div class="uk-width-1-1 margin-forms">
   
    <h5 class="grey-titles"><strong>Sitios de interés</strong></h5> 
	<div class="uk-width-1-1 margin-forms">
     
        <ul class="uk-subnav uk-subnav-pill" uk-switcher="animation: uk-animation-fade">
    <li><a href="#"> <p class="grey3" style="margin:5px 0 10px 0;"><img src="../images/castellano-flag.png">&nbsp; Contenido Castellano</p></a></li>
    <li><a href="#"><p class="grey3" style="margin:5px 0 10px 0;"><img src="../images/uk-flag.png">&nbsp; Contenido Inglés</p></a></li>
    <li><a href="#"><p class="grey3" style="margin:5px 0 10px 0;"><img src="../images/deustche-flag.png">&nbsp; Contenido Alemán</p></a></li>
</ul>

<ul class="uk-switcher uk-margin">
    <li> <textarea  id="editor5" name="interes"  class="uk-width-1-1"><?=$interes?></textarea>
            <script>
	
              CKEDITOR.replace( 'editor5', {
   filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl : '../filemanager/dialog.php?type=1&editor=ckeditor&fldr=' });</script></li>
    <li><textarea  id="editor6" name="interesEN"  class="uk-width-1-1"><?=$interesEN?></textarea>
		<script>
	
              CKEDITOR.replace( 'editor6', {
   filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl : '../filemanager/dialog.php?type=1&editor=ckeditor&fldr=' });</script>
           </li>
    <li><textarea  id="editor7" name="interesDE"  class="uk-width-1-1"><?=$interesDE?></textarea>
		<script>
	
              CKEDITOR.replace( 'editor7', {
   filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl : '../filemanager/dialog.php?type=1&editor=ckeditor&fldr=' });</script>
           </li>
</ul>
				
		
		
    </div>
		
			


	</div>
	
	
	<div class="uk-width-1-1 margin-forms">
		<hr class="uk-article-divider">
	</div>
	
		<div class="uk-width-1-1 margin-forms">
   
    <h5 class="grey-titles"><strong>Actividades y entretenimiento</strong></h5> 
	<div class="uk-width-1-1 margin-forms">
     
        <ul class="uk-subnav uk-subnav-pill" uk-switcher="animation: uk-animation-fade">
    <li><a href="#"> <p class="grey3" style="margin:5px 0 10px 0;"><img src="../images/castellano-flag.png">&nbsp; Contenido Castellano</p></a></li>
    <li><a href="#"><p class="grey3" style="margin:5px 0 10px 0;"><img src="../images/uk-flag.png">&nbsp; Contenido Inglés</p></a></li>
    <li><a href="#"><p class="grey3" style="margin:5px 0 10px 0;"><img src="../images/deustche-flag.png">&nbsp; Contenido Alemán</p></a></li>
</ul>

<ul class="uk-switcher uk-margin">
    <li> <textarea  id="editor8" name="ocio"  class="uk-width-1-1"><?=$ocio?></textarea>
            <script>
	
              CKEDITOR.replace( 'editor8', {
   filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl : '../filemanager/dialog.php?type=1&editor=ckeditor&fldr=' });</script></li>
    <li><textarea  id="editor9" name="ocioEN"  class="uk-width-1-1"><?=$ocioEN?></textarea>
		<script>
	
              CKEDITOR.replace( 'editor9', {
   filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl : '../filemanager/dialog.php?type=1&editor=ckeditor&fldr=' });</script>
           </li>
    <li><textarea  id="editor10" name="ocioDE"  class="uk-width-1-1"><?=$ocioDE?></textarea>
		<script>
	
              CKEDITOR.replace( 'editor10', {
   filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=', filebrowserImageBrowseUrl : '../filemanager/dialog.php?type=1&editor=ckeditor&fldr=' });</script>
           </li>
</ul>
				
		
		
    </div>
		
			


	</div>
	
	</div>
	<div class="uk-margin-large-top">
		 <a onclick="saveData('1')"> <button class="uk-button uk-button-primary" type="button"><strong>Guardar y publicar&nbsp; <span uk-icon="icon:push;ratio:0.95" class="icon-margin"></span></strong></button></a>
	 <a onclick="saveData('0')"> <button class="uk-button uk-button-default uk-modal-close" type="button">Guardar sin publicar</button></a>
          <input type="text" name="activar" id="activar" hidden> 
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
                    latitude: <?php if ($accion=="edit"){?><?php echo $coor[1]?><?php }else{?> 39.8439258<?php }?>,
                    longitude: <?php if ($accion=="edit"){?><?php echo $coor[0]?><?php }else{?> 3.1300568<?php }?>
                },
                radius: 0,
				fillColor: '#FF0000',
				
				zoom:15,
				mapTypeId: google.maps.MapTypeId.HYBRID,
				addressFormat: 'street_number',
				markerIcon: '<?php echo DIR;?>images/map-marker.png',
                inputBinding: {
                    latitudeInput: $('#map-lat'),
                    longitudeInput: $('#map-lon'),
                    radiusInput: $('#map-radius'),
                    locationNameInput: $('#map-address')
                },
				markerInCenter: true,
                enableAutocomplete: true,
				enableAutocompleteBlur: true,
				oninitialized : function (component) {
     
	 			 $('#map-address').val('');
	  $('#map-lat').val('<?php if ($accion=="edit"){?><?php echo $coor[1]?><?php }else{?> 39.8439258<?php }?>');
	  $('#map-lon').val('<?php if ($accion=="edit"){?><?php echo $coor[0]?><?php }else{?> 3.1300568<?php }?>');		
					
							
   },
                onchanged: function (currentLocation, radius, isMarkerDropped) {
         var addressComponents = $(this).locationpicker('map').location.addressComponents;
        updateControls(addressComponents);
                }
            });
        </script>
<script type="text/javascript">
	function reloadGallery(param44) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>zonas/reloadgallery.php",
	data:'ref='+param44,
			 beforeSend: function(){
   $("#loading-indicator").show();
  },
	success: function(data){
		$('#loading-indicator').hide();
		$("#reloadgallery").html(data);
		
	}
	});   
        }
function previewGallery(param) {
	var edicion = 'si';
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>zonas/previewgalleryzona.php",
	data:'ref='+param +'&mostrar='+edicion,
			 beforeSend: function(){
   $(".loader").show();
  },
	success: function(data){
		$(".loader").fadeOut("slow");
		UIkit.modal("#previewgalleryzona").show();
		$("#previewgalleryzona").html(data);
		$("select.select-gallery")[0].sumo.reload();
		
	}
	});   
        }
function addZona(param) {
	var nombre= $('#addZona2').val();
	var add='si';
     $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>zonas/managezona.php",
	data:'ref='+param +'&nombre='+nombre +'&add='+add,
			 beforeSend: function(){
  
  },
	success: function(data){
		
		$("#reloadlocalidad").html(data);
		
		
	}
	});   
        }
function deleteZona(param) {
	var ref= <?php echo $refedit?>;
	var add='si';
	var deletezona ='si';
     $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>zonas/managezona.php",
	data:'ref='+ref +'&nombre='+param +'&add='+add +'&deletezona='+deletezona,
			 beforeSend: function(){
  
  },
	success: function(data){
		
		$("#reloadlocalidad").html(data);
		
		
	}
	});   
        }
</script>
<script type="text/javascript">
        $(document).ready(function () {
			$('.box-gallery').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultados para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
			
		});$('#property').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});</script>

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
<script src="<?php echo DIR;?>js/validar-form.min.js"></script>
<script type="text/javascript" >
function saveData(param) {
	$("#activar").val(param);
	UIkit.modal.confirm('¿Confirma que desea guardar la zona?', { center:true, labels: { ok: 'Ok', cancel: 'Volver a edición' } }).then(function() {
   for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
			$.ajax({
                url: '<?php echo DIR;?>zonas/managezona', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'json', // data type
                data : $("#zonaform").serialize(), // post data || get data
                success : function(result) {
                   UIkit.modal.dialog(result['messageERROR']);
                 
                },
                error: function(xhr, resp, text) {
                     UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> <strong>Ha habido un error al guardar. Inténtelo de nuevo.</strong>', status: 'danger', timeout:2000})
					
                } 
				
			});
}, function () {
   
});
	
}        
 </script>
<script type="text/javascript">
        $(document).ready(function () {
          $('.search-box').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:true,noMatch: 'No hay resultados para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
			$('.select-gallery').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultados para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
			$('.simple').SumoSelect();

	

        });
	
    </script>
<script>
 UIkit.upload('.js-upload');
</script>
<?php include ('../layout/galeria-zonas.php');?>
</body> 
</html>