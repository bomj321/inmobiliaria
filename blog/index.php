
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
$activo="Blog";
$activo2="";
require('../layout/header.php');
?>
<?php 
include('../layout/menu.php'); 

?>
<div class="uk-container">
<div class="uk-grid">
<div class="uk-width-1-1">
	<!--FILTROS-->

<div class="filters" style="padding: 5px 15px;">
	<div class="uk-grid">
		<div class="uk-width-3-5">
	<h3 class="orange uk-margin-small-bottom"><span uk-icon="icon:rss; ratio:0.9;"></span> <strong>Gestión de noticias/Blog</strong></h3>
	<p class="uk-margin-small-bottom" style="margin-top:0">En esta sección podrá gestionar todos los detalles referidos a las últimas noticias de la web, informaciones, eventos...</p>
		</div>
		<div class="uk-width-2-5">
			<h5 class="uk-margin-small-bottom"><span uk-icon="icon:search; ratio:0.9;" class="icon-margin"></span><strong> Filtrar noticia por titulo</strong></h5>   
        <div class="uk-form-controls">
		<?php 
	
$total = "SELECT DISTINCT CodiProp FROM Blog where Activo='Si'"; 
$total_prop = $db->query($total)->fetchAll(); 
$zonas = $db->prepare("SELECT DISTINCT Titulo FROM Blog where Activo='Si'  order by CodiProp Asc");
$zonas->setFetchMode(PDO::FETCH_ASSOC);
$zonas->execute();

 
?>	
           <select placeholder="-Seleccionar-" onchange="" class="search-box">
			<?php while ($optionzona = $zonas->fetch()){?>
			 <option><?php echo $optionzona['Titulo'];?>
			 <?php }?> 

    </select>
     
    </div>
		</div>
	</div>
	
</div>
<!-- FIN FILTROS-->

 <div class="uk-card uk-card-primary uk-card-body" style="margin-bottom:80px;">
<div class="uk-grid uk-grid-collapse">
	<div class="uk-width-1-3">
	 <p class="uk-card-title"><span uk-icon="icon:rss" class="icon-margin"></span>&nbsp; <strong> Mostrando <?php echo count($total_prop);?> <span class="green"> noticias creadas</span> </strong> </p>	
	</div>
	<div class="uk-width-2-3 direct-filter">
	<div class="uk-grid uk-grid-medium" style="float:right;margin-top:4px; margin-right:10px;">
		
		
		
	</div>
	</div>
 </div>
<table class="uk-table uk-table-middle  uk-table-striped">
		<thead>
        <tr>
			<th  class="uk-table-shrink"></th>
			<th class="uk-table-shrink">Publicado</th>
			<th class="uk-width-large"><a href="" class="uk-link-reset icon-margin-top">Titulo<span class="sort"></span></a></th>
			<th class="uk-width-large"><a href="" class="uk-link-reset icon-margin-top">Texto destacado<span class="sort"></span></a></th>
			
			
			
			<th ><a href="" class="uk-link-reset icon-margin-top">Fecha de publicación<span class="sort"></span></a></th>
			<th ><a href="" class="uk-link-reset icon-margin-top">Categoría<span class="sort"></span></a></th>
			
			<th class="uk-width-small"></th>
        </tr>
    </thead>
    <tbody>
		<?php 
		
//Sólo se muestra venta
$stmt = $db->prepare("SELECT * FROM Blog ORDER BY fecha desc");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while ($row = $stmt->fetch()){
$originalDate = $row['fecha'];
$fecha = date("d-m-Y", strtotime($originalDate));
$id=$row['CodiProp'];
$titlepost=$row['Titulo'];
$titlepostlimpio=limpia($row['Titulo']);
$title=$row['Texto_destacado'];
$foto=$row['Imagen_destacada'];
$active=$row['Activo'];
$cat=$row['Codeti_Codi'];
if ($active=="Si") {$active="<span uk-icon='icon:check;' class='green'></span>";} else {$active="<span uk-icon='icon:ban;' class='red'></span>";}
if ($title!="") {$title=$title;} else {$title="-No asignado-";
$stmt2 = $db->prepare("SELECT Nombre FROM etiquetas where Cod_equip='$cat'");
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);									  }
		?>
        <tr>
			<td><div uk-lightbox style="width:50px;height:50px; "><a href="<?php echo DIR;?><?php echo $foto?>" data-caption="<button class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;' uk-toggle='target: #galeria-listado'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>"><div style="background:url(<?php echo DIR;?><?php echo $foto?>) no-repeat 50% 50%;height:100%; border-radius:50px;background-size:200px 200px;"></div></a></div></td>
		<td class="uk-text-center"><?php echo $active?></td>	
		<td class="uk-table-link"><a onclick="previewModal('<?php echo $id?>')" ><?php echo $titlepost;?></a></td>
				<td class=" uk-text-truncate"><a onclick="previewModal('<?php echo $id?>')" ><?php echo $title;?></a></td>
        
		
		
			
	<td ><?php echo $fecha;?></td>
			<td class="uk-table-link" ><a href="<?php echo DIR;?>blog/tags"><?php echo $row2['Nombre'];?></a></td>

			
			 
			<td class="uk-table-expand" ><div class="uk-grid uk-grid-small">
				<a onclick="previewModal('<?php echo $id?>')" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>
				<a href=""><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>
				<a  uk-toggle="target: #galeria-listado"><span uk-icon="icon:image;ratio:1" uk-tooltip="Galería"></span></a>
				<a href="https://www.villasplanet.com/es/blog/post-<?php echo $titlepostlimpio?>-id-<?php echo $id?>" target="new" ><span uk-icon="icon:link;ratio:1" uk-tooltip="Ficha web"></span></a>
				<a href=""><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
				
				
				</div></td>
        </tr><?php }?>
		
        
    </tbody>
</table>
        </div>
	
</div>

</div>
</div>
       
    </div>

<div id="preview-modal"></div>


<?php 
//include header template
require('../layout/footer.php'); 
include ('../layout/galeria-blog.php');
?>
<script type="text/javascript">
function previewModal(param) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>blog/previewpost.php",
	data:'id='+param,
			 beforeSend: function(){
   $(".loader").show();
  },
	success: function(data){
		$(".loader").fadeOut("slow");
		$("#preview-modal").html(data);
		
		
	}
	});   
        }
</script>
<script type="text/javascript">
        $(document).ready(function () {
          $('.search-box').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:true,noMatch: 'No hay resultadao para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
			$('.select-gallery').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultadao para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
			$('.simple').SumoSelect();

	

        });
	
    </script>
<script>
 UIkit.upload('.js-upload');
</script>
</body>
</html>