<?php 
require('../includes/config2.php'); 
$ref=$_POST["ID"];
$zonas = $db->prepare("SELECT * FROM sys_towns where ID='$ref' and Location='0'");
$zonas->setFetchMode(PDO::FETCH_ASSOC);
$zonas->execute();
while ($row3 = $zonas->fetch()){
$title=$row3['titleTown'];
$CP=$row3['PC'];
$active=$row3['active'];
if ($active=="1") {$active="<span uk-icon='icon:check;' class='green'></span>";} else {$active="<span uk-icon='icon:ban;' class='red'></span>";}
if ($CP!="") {$CP=$CP;} else {$CP="-No asignado-";}
if ($title!="") {$title=$title;} else {$title="-No asignado-";}	
$coor = explode('-',$row3['longlatpobla']);	
$descripcion=$row3['townDescripES'];
$interes=$row3['interesTown'];
$ocio=$row3['ocioTown'];
if ($descripcion!="") {$descripcion=$descripcion;} else {$descripcion="-No asignado-";}	
if ($interes!="") {$interes=$interes;} else {$interes="-No asignado-";}	
if ($ocio!="") {$ocio=$ocio;} else {$ocio="-No asignado-";}	
	$stmt4 = $db->prepare("SELECT full FROM image_zonas WHERE ref='$ref' and orden=1");
$stmt4->execute();
$row4 = $stmt4->fetch(PDO::FETCH_ASSOC);	
?>

<script type="text/javascript">
UIkit.modal("#previewajax").show();
</script>
<div id="previewajax" class="uk-modal-full" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
        <div class="uk-grid-collapse uk-child-width-1-3@s uk-flex-top" uk-grid>
            <div class="uk-background-cover uk-width-1-3" style="background-image: url('<?php if ($row4['full']!="") {?><?php echo $row4['full']?><?php }else{?><?php echo DIR;?>images/nofoto.jpg<?php }?>');" uk-height-viewport></div>
            <div class="uk-padding-large uk-width-2-3">
				<div class="uk-grid">
					<div class="uk-width-1-3">
                <h1 class="uk-margin-small-bottom orange"><?php echo $row3['Town'];?></h1>
					</div>
					<div class="uk-width-2-3">
                <div class="uk-grid uk-grid-medium" style="float:right;margin-top:4px; margin-right:10px;">
		<div class="uk-text-right"><a href="<?php echo DIR;?>zonas/zona?accion=edit&ref=<?php echo $row3['ID']?>"><button class="uk-button button-direct"><span uk-icon="icon:pencil; ratio:0.9" class="icon-margin"></span> Editar zona</button></a></div>
		<div class=" uk-text-right"><a onclick="previewGallery('<?php echo $ref?>')"><button class="uk-button button-direct" type="button"><span uk-icon="icon:image; ratio:0.9" class="icon-margin"></span> Editar galería</button></a></div>		
	</div>
					</div>
				</div>
				 <h4 class="uk-margin-small-top uk-margin-small-bottom uk-text-uppercase"><strong><?php echo $title;?></strong></h4>
				<h5 class="uk-margin-small-top uk-margin-small-bottom"> <?php if ($row3['active']!="0"){?> <span class="green"><span uk-icon="icon:check; ratio:0.9"></span> Publicado</span> <?php }else{?> <span class="uk-icon-button uk-margin-small-right" uk-icon="ban"></span> No publicado <?php }?> </h5>	
				<div class=" uk-grid-medium uk-child-width-auto uk-grid ">
					
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Ref:</span> <?php echo $row3['ID'];?> </h5>	
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Coordenadas:</span> <?php if(($row3['longlatpobla'])!=""){?><?php echo $coor[0];?> / <?php echo $coor[1];?><?php }else {echo "-No asignado-";}?> </h5>	
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Código postal:</span> <?php echo $CP;?> </h5>	
					</div>
					<h5 class="grey-titles uk-margin-top uk-margin-small-bottom"><strong><span uk-icon="icon:list; ratio:0.9" class="icon-margin"></span> Descripción de la zona</strong></h5> 
				<p class="uk-text-justify" style="line-height:1.7"><?php echo $descripcion;?></p>
				<h5 class="grey-titles uk-margin-top uk-margin-small-bottom"><strong><span uk-icon="icon:bookmark; ratio:0.9" class="icon-margin"></span> Sitios de interés</strong></h5> 
				<p class="uk-text-justify" style="line-height:1.7"><?php echo $interes;?></p>
				<h5 class="grey-titles uk-margin-top uk-margin-small-bottom"><strong><span uk-icon="icon:bell; ratio:0.9" class="icon-margin"></span> Actividades y entretenimiento</strong></h5> 
				<p class="uk-text-justify" style="line-height:1.7"><?php echo $ocio;?></p>
				

            </div>
        </div>
    </div>
</div>
<?php }
?>