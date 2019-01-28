
<?php require('../includes/config2.php'); 

if(!$user->is_logged_in()){ header('Location: ../login'); exit(); } 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

?>
<div class="uk-container">
<div class="uk-grid">
<div class="uk-width-1-2">
	<!--FILTROS-->

<div class="filters" style="padding: 5px 15px;">
	<div class="uk-grid">
		<div class="uk-width-3-5">
	<h3 class="orange uk-margin-small-bottom"><span uk-icon="icon:nut; ratio:0.9;"></span> <strong>Gestión de extras/equipamiento </strong></h3>
		</div>
		<div class="uk-width-2-5">
			<h5 class="uk-margin-small-bottom"><span uk-icon="icon:search; ratio:0.9;" class="icon-margin"></span><strong> Filtrar extra</strong></h5>   
        <div class="uk-form-controls">
		<?php 
	$zonas = $db->prepare("SELECT DISTINCT extraNombre FROM extras_properties order by extraNombre Asc");
$zonas->setFetchMode(PDO::FETCH_ASSOC);
$zonas->execute();

 
?>	
           <select placeholder="-Seleccionar-" onchange="" class="search-box">
			   <option>-Seleccionar-</option>
			<?php while ($optionzona = $zonas->fetch()){?>
			   <option><?php echo $optionzona['extraNombre'];?></option>
			 <?php }?> 
		

    </select>
     
    </div>
		</div>
	</div>
	
</div>
<!-- FIN FILTROS-->

 <div id="reloadextras" class="uk-card uk-card-primary uk-card-body" style="margin-bottom:80px;">
<div class="uk-grid uk-grid-collapse">
	<div class="uk-width-1-3">
<?php $total = "SELECT DISTINCT id FROM extras_properties"; 
$total_prop = $db->query($total)->fetchAll();  ?>
	 <p class="uk-card-title"><span uk-icon="icon:rss" class="icon-margin"></span>&nbsp; <strong> Mostrando <?php echo count($total_prop);?> <span class="green"> extras creados</span> </strong> </p>	
	</div>
	<div class="uk-width-2-3 direct-filter">
	<div class="uk-grid uk-grid-medium" style="float:right;margin-top:4px; margin-right:10px;">
		<div class="uk-text-right"><button type="button" class="uk-button button-direct activo" onclick="previewModalNew()"><span uk-icon="icon:plus; ratio:0.85;"></span> Crear nuevo extra</button></div>
		
	</div>
	</div>
 </div>
<table class="uk-table uk-table-middle  uk-table-striped">
		<thead>
        <tr>
			
			<th class="uk-table-shrink">Publicado</th>
			<th class="uk-width-large"><a href="" class="uk-link-reset icon-margin-top">Titulo<span class="sort"></span></a></th>
			<th class="uk-width-large"><a href="" class="uk-link-reset icon-margin-top">Asignado a<span class="sort"></span></a></th>
			<th class="uk-width-large"></th>
			<th class="uk-width-medium"></th>
			
			
        </tr>
    </thead>
    <tbody>
<?php $stmt = $db->prepare("SELECT id,extraActivo, extraNombre, extraTipoProp FROM extras_properties  ORDER BY extraNombre Asc");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while ($row = $stmt->fetch()){
$refextra=$row['id'];	
$title=$row['extraNombre'];
$active=$row['extraActivo'];
$tipoprop=$row['extraTipoProp'];
if ($tipoprop=="Venta,Anual,Vacacional,Temporal") {$tipoprop="Todas";} else { $tipoprop=$tipoprop;}
if ($active=="si") {$active="<span uk-icon='icon:check;' class='green'></span>";} else { $active="<span uk-icon='icon:ban;' class='red'></span>";}
if ($title!="") {$title=$title;} else {$title="-No asignado-";}	
									
		?>	
        <tr>
			
		<td class="uk-text-left"><?php echo $active;?></td>	
		<td class="uk-table-link"><a onclick="previewModal('<?php echo $refextra?>')" ><?php echo $title?></a></td>
		<td class="uk-table-link"><?php echo $tipoprop?></td>	
		<td class="uk-text-center"></td>			
<td class="uk-table-link"><div class="uk-grid uk-grid-small uk-float-right uk-margin-right">
				
				<a onclick="previewModal('<?php echo $refextra?>')"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>
				
				<a onclick="deleteData('<?php echo $refextra?>')"><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
				
				
				</div></td>
			
			 
			
        </tr>
		 <?php }?>
    </tbody>
</table>
        </div>
	
</div>
<div class="uk-width-1-2">
	<!--FILTROS-->

<div class="filters" style="padding: 5px 15px;">
	<div class="uk-grid">
		<div class="uk-width-3-5">
	<h3 class="orange uk-margin-small-bottom"><span uk-icon="icon:location; ratio:0.9;"></span> <strong>Gestión de distancias/entorno</strong></h3>
	
		</div>
		<div class="uk-width-2-5">
			<h5 class="uk-margin-small-bottom"><span uk-icon="icon:search; ratio:0.9;" class="icon-margin"></span><strong> Filtrar distancia</strong></h5>   
        <div class="uk-form-controls">
		<?php 
	

	

 
?>	
           <select placeholder="-Seleccionar-" onchange="" class="search-box">
			
			 
		

    </select>
     
    </div>
		</div>
	</div>
	
</div>
<!-- FIN FILTROS-->

 <div id="reloaddistancia" class="uk-card uk-card-primary uk-card-body" style="margin-bottom:80px;">
<div class="uk-grid uk-grid-collapse">
	<div class="uk-width-1-3">
		<?php $total2 = "SELECT DISTINCT id FROM distancias_properties"; 
$total_prop2 = $db->query($total2)->fetchAll();  ?>
	 <p class="uk-card-title"><span uk-icon="icon:rss" class="icon-margin"></span>&nbsp; <strong> Mostrando <?php echo count($total_prop2)?> <span class="green"> distancias creadas</span> </strong> </p>	
	</div>
	<div class="uk-width-2-3 direct-filter">
	<div class="uk-grid uk-grid-medium" style="float:right;margin-top:4px; margin-right:10px;">
		<div class="uk-text-right"><button class="uk-button button-direct activo" onclick="previewModalNew2()"><span uk-icon="icon:plus; ratio:0.85;"></span> Crear nueva distancia</button></div>
		
	</div>
	</div>
 </div>
<table class="uk-table uk-table-middle  uk-table-striped">
		<thead>
			
        <tr>
			
			<th class="uk-table-shrink">Publicado</th>
			<th class="uk-width-large"><a href="" class="uk-link-reset icon-margin-top">Titulo<span class="sort"></span></a></th>
			<th class="uk-width-large"><a href="" class="uk-link-reset icon-margin-top">Asignado a<span class="sort"></span></a></th>
			<th class="uk-width-large"></th>
			
        </tr>
    </thead>
    <tbody>
	<?php $stmt2 = $db->prepare("SELECT * FROM distancias_properties  ORDER BY distanciaNombre Asc");
$stmt2->setFetchMode(PDO::FETCH_ASSOC);
$stmt2->execute();
while ($row2 = $stmt2->fetch()){
$refextra2=$row2['id'];	
$title=$row2['distanciaNombre'];
$active=$row2['distanciaActivo'];
$tipoprop=$row2['distanciaTipoProp'];
if ($tipoprop=="Venta,Anual,Vacacional,Temporal") {$tipoprop="Todas";} else { $tipoprop=$tipoprop;}
if ($active=="si") {$active="<span uk-icon='icon:check;' class='green'></span>";} else { $active="<span uk-icon='icon:ban;' class='red'></span>";}
if ($title!="") {$title=$title;} else {$title="-No asignado-";}	
									
		?>	
        <tr>
			
		<td class="uk-text-left"><?php echo $active?></td>	
		<td class="uk-table-link"><a onclick="previewModal2('<?php echo $refextra2?>')" ><?php echo $title?></a></td>
		<td class="uk-table-link"><a onclick="previewModal2('<?php echo $refextra2?>')" ><?php echo $tipoprop?></a></td>	
				
<td class="uk-table-link"><div class="uk-grid uk-grid-small uk-float-left">
				
				<a onclick="previewModal2('<?php echo $refextra2?>')"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>
				
				<a onclick="deleteData2('<?php echo $refextra2?>')" ><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
				
				
				</div></td>
			
			 
			
        </tr>
		<?php }?>
        
    </tbody>
</table>
        </div>
	
</div>
</div>
</div>
       
    </div>




<?php 
//include header template
require('../layout/footer.php'); 

?>
<script type="text/javascript">
function previewModal(param) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>extras/editextras.php",
	data:'id='+param,
	 beforeSend: function(){
   $(".loader").show();
 
  },
	success: function(data){
		$(".loader").fadeOut("slow");
		UIkit.modal("#editextras").show();
		$("#editextras").html(data);
		
		
	}
	});   
        }
function reloadExtras() {
	var reload='yes';
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>extras/loadextras.php",
	data:'id='+reload,
	 beforeSend: function(){
   //$(".loader").show();
 
  },
	success: function(data){
		//$(".loader").fadeOut("slow");
		$("#reloadextras").html(data).fadeIn('slow');
		
		
	}
	});   
        }
function reloadDistancias() {
	var reload='yes';
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>extras/loaddistancia.php",
	data:'id='+reload,
	 beforeSend: function(){
   //$(".loader").show();
 
  },
	success: function(data){
		//$(".loader").fadeOut("slow");
		$("#reloaddistancia").html(data).fadeIn('slow');
		
		
	}
	});   
        }
function previewModalNew() {
	var accion='nuevo';
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>extras/nuevo-extra.php",
	data:'accion='+accion,
	 beforeSend: function(){
   $(".loader").show();
 
  },
	success: function(data){
		$(".loader").fadeOut("slow");
		UIkit.modal("#newextras").show();
		$("#newextras").html(data);
		$("select.search-box")[0].sumo.reload();
		
	}
	});   
        }
function previewModal2(param3) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>extras/editdistancia.php",
	data:'id='+param3,
			 beforeSend: function(){
   $(".loader").show();
 
  },
	success: function(data){
		$(".loader").fadeOut("slow");
		UIkit.modal("#editdistancias").show();
		$("#editdistancias").html(data);
	
		
	}
	});   
        }
function previewModalNew2() {
	var accion='nuevo';
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>extras/nueva-distancia.php",
	data:'accion='+accion,
	 beforeSend: function(){
   $(".loader").show();
 
  },
	success: function(data){
		$(".loader").fadeOut("slow");
		UIkit.modal("#newdistancia").show();
		$("#newdistancia").html(data);
		
	}
	});   
        }
function deleteData(param) {
	if (confirm("¿Confirma que desea eliminar el extra/equipamiento?")) {
            var accion2='delete'; 
            
			$.ajax({
	type: "POST",
	url: "<?php echo DIR;?>extras/manageextra.php",
	data:'id='+param +'&accion='+accion2,
	 beforeSend: function(){
   $(".loader").show();
 
  },
                success : function(result) {
					 $(".loader").hide();
                   UIkit.modal.dialog("<h3><span class='green' style='padding:30px; font-size:18px; display:block'><strong><span uk-icon='icon:check;'></i> Extra/equipamiento eliminado con éxito.</strong><br>Puede volver a crear o editar desde la zona de gestión de extras/distancias.</span></h3>");
				   reloadExtras();
                 
                },
                error: function(xhr, resp, text,result) {
                  
					
                } 
				
			});
} else {}}
	function deleteData2(param) {
	if (confirm("¿Confirma que desea eliminar la distancia/entorno?")) {
            var accion2='delete'; 
            
			$.ajax({
	type: "POST",
	url: "<?php echo DIR;?>extras/managezona.php",
	data:'id='+param +'&accion='+accion2,
	 beforeSend: function(){
   $(".loader").show();
 
  },
                success : function(result) {
					 $(".loader").hide();
                   UIkit.modal.dialog("<h3><span class='green' style='padding:30px; font-size:18px; display:block'><strong><span uk-icon='icon:check;'></i> Distancia/entorno eliminado con éxito.</strong><br>Puede volver a crear o editar desde la zona de gestión de extras/distancias.</span></h3>");
				   reloadDistancias();
                 
                },
                error: function(xhr, resp, text,result) {
                  
					
                } 
				
			});
} else {}}
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
<div class="loader" style="display:none; z-index:4000000"><div class="uk-position-center uk-overlay uk-overlay-default" style="padding:30px 40px"><div uk-spinner="ratio: 2"></div><p>Cargando...</p></div>
<div id="editextras" class="uk-modal-container" uk-modal="stack:true; bg-close:false; esc-close:false;" style="z-index:100000">
</div>
<div id="newextras" class="uk-modal-container" uk-modal="stack:true; bg-close:false; esc-close:false;" style="z-index:100000">
</div>	
<div id="editdistancias" class="uk-modal-container" uk-modal="stack:true; bg-close:false; esc-close:false;" style="z-index:100000">
</div>	
<div id="newdistancia" class="uk-modal-container" uk-modal="stack:true; bg-close:false; esc-close:false;" style="z-index:100000">
</div>		
</body>
</html>