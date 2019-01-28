
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
<div class="uk-width-1-1">
	<!--FILTROS-->

<div class="filters" style="padding: 5px 15px;">
	<div class="uk-grid">
		<div class="uk-width-4-5">
	<h3 class="orange uk-margin-small-bottom"><span uk-icon="icon:rss; ratio:0.9;"></span> <strong>Gestión de categorías blog</strong></h3>
	<p class="uk-margin-small-bottom" style="margin-top:0">En esta sección podrá gestionar todos los detalles referidos a las categorías del blog</p>
		</div>
		<div class="uk-width-1-5">
			<h5 class="uk-margin-small-bottom"><span uk-icon="icon:search; ratio:0.9;" class="icon-margin"></span><strong> Filtrar categoría</strong></h5>   
        <div class="uk-form-controls">
		<?php 
	
$total = "SELECT DISTINCT Nombre FROM Etiquetas where Activo='Si'"; 
$total_prop = $db->query($total)->fetchAll(); 
$zonas = $db->prepare("SELECT DISTINCT Nombre FROM Etiquetas where Activo='Si' order by Nombre Asc");
$zonas->setFetchMode(PDO::FETCH_ASSOC);
$zonas->execute();

 
?>	
           <select placeholder="-Seleccionar-" onchange="" class="search-box">
			<?php while ($optionzona = $zonas->fetch()){?>
			 <option><?php echo $optionzona['Nombre'];?>
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
	 <p class="uk-card-title"><span uk-icon="icon:rss" class="icon-margin"></span>&nbsp; <strong> Mostrando <?php echo count($total_prop);?> <span class="green"> categorías creadas</span> </strong> </p>	
	</div>
	<div class="uk-width-2-3 direct-filter">
	<div class="uk-grid uk-grid-medium" style="float:right;margin-top:4px; margin-right:10px;">
		<div class="uk-text-right"><button class="uk-button button-direct activo" uk-toggle="target: #nueva-categoria"><span uk-icon="icon:plus; ratio:0.85;"></span> Crear nueva categoría</button></div>
		
	</div>
	</div>
 </div>
<table class="uk-table uk-table-middle  uk-table-striped">
		<thead>
        <tr>
			
			<th class="uk-table-shrink">Publicado</th>
			<th class="uk-width-small"><a href="" class="uk-link-reset icon-margin-top">Titulo<span class="sort"></span></a></th>
			<th class="uk-width-large"></th>
			
			
        </tr>
    </thead>
    <tbody>
		<?php 
		
//Sólo se muestra venta
$stmt = $db->prepare("SELECT * FROM Etiquetas ORDER BY Nombre Asc");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while ($row = $stmt->fetch()){
$originalDate = $row['fecha'];
$fecha = date("d-m-Y", strtotime($originalDate));
$id=$row['Cod_equip'];
$titlepost=$row['Nombre'];
$titlepostlimpio=limpia($row['Nombre']);
$title=$row['Texto_destacado'];
$foto=$row['Imagen_destacada'];
$active=$row['Activo'];
$cat=$row['Codeti_Codi'];
if ($active=="Si") {$active="<span uk-icon='icon:check;' class='green'></span>";} else {$active="<span uk-icon='icon:ban;' class='red'></span>";}
if ($title!="") {$title=$title;} else {$title="-No asignado-";
$stmt2 = $db->prepare("SELECT Nombre FROM Etiquetas where Cod_equip='$cat'");
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);									  }

		?>
        <tr>
			
		<td class="uk-text-left"><?php echo $active?></td>	
		<td class="uk-table-link"><a onclick="previewModal('<?php echo $id?>')" ><?php echo $titlepost;?></a></td>
				
<td class="uk-table-link"><div class="uk-grid uk-grid-small uk-float-left">
				
				<a onclick="previewModal('<?php echo $id?>')"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>
				
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
include ('nueva-categoria.php');
?>
<script type="text/javascript">
function previewModal(param) {
         $.ajax({
	type: "POST",
	url: "<?php echo DIR;?>blog/edittag.php",
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