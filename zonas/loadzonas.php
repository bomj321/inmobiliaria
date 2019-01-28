<?php require('../includes/config2.php'); ?>

<div class="uk-grid uk-grid-collapse">
	<div class="uk-width-1-3">
		<?php $total = "SELECT DISTINCT Town FROM sys_towns where Location='0'"; 
$total_prop = $db->query($total)->fetchAll(); ?>
	 <p class="uk-card-title"><span uk-icon="icon:location" class="icon-margin"></span>&nbsp; <strong> Mostrando <?php echo count($total_prop);?> <span class="green"> zonas creadas</span> </strong> </p>	
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
			<th class="uk-width-medium"><a href="" class="uk-link-reset icon-margin-top">Población<span class="sort"></span></a></th>
			<th class="uk-width-large"><a href="" class="uk-link-reset icon-margin-top">Titulo destacado<span class="sort"></span></a></th>
			<th class="uk-table-small"><a href="" class="uk-link-reset icon-margin-top">Referencia<span class="sort "></span></a></th>
			
			
			<th ><a href="" class="uk-link-reset icon-margin-top">Latitud/Longitud<span class="sort"></span></a></th>
			
			<th class="uk-width-small"><a href="" class="uk-link-reset icon-margin-top">Código postal<span class="sort"></span></a></th>
			<th class="uk-width-small"></th>
        </tr>
    </thead>
    <tbody>
		<?php 
		
//Sólo se muestra venta
$stmt = $db->prepare("SELECT distinct Town, PC,active,ID, longlatpobla,titleTown FROM sys_towns where Location='0' ORDER BY Town Asc");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while ($row = $stmt->fetch()){
$refzona=$row['ID'];
$coor = explode('-',$row['longlatpobla']);	
$title=$row['titleTown'];
$CP=$row['PC'];
$townlimpio=limpia($row['Town']);
$active=$row['active'];
if ($active=="1") {$active="<span uk-icon='icon:check;' class='green'></span>";} else {$active="<span uk-icon='icon:ban;' class='red'></span>";}
if ($CP!="") {$CP=$CP;} else {$CP="-No asignado-";}
if ($title!="") {$title=$title;} else {$title="-No asignado-";}
$stmt4 = $db->prepare("SELECT full,small FROM image_zonas WHERE ref='$refzona' and orden=1");
$stmt4->execute();
$row4 = $stmt4->fetch(PDO::FETCH_ASSOC);	
									
		?>
		
        <tr>
			<td><div uk-lightbox style="width:50px;height:50px; "><a <?php if ($row4['full']=="") {?>href="<?php echo DIR;?>images/nofoto.jpg"<?php }else if ($row4['full']!=""){?> href="<?php echo $row4['full']?>"<?php }?>data-caption="<button onclick=previewGallery('<?php echo $row['ID']?>') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>"><?php if ($row4['small']=="") {?><div style="background:url(<?php echo DIR;?>images/nofotosmall.jpg) no-repeat 50% 50%;height:100%; border-radius:50px"></div><?php }else if ($row4['small']!=""){?><div style="background:url(<?php echo $row4['small']?>) no-repeat 50% 50%;height:100%; border-radius:50px"></div><?php }?></a>
			<?php if($row4['full']!="") {
			$stmt455 = $db->prepare("SELECT full FROM image_zonas WHERE ref='$refzona' and orden!=1");
$stmt455->setFetchMode(PDO::FETCH_ASSOC);
$stmt455->execute();
			while ($row455 = $stmt455->fetch()){
				?>	
			<a href="<?php echo $row455['full']?>" data-caption="<button onclick=previewGallery('<?php echo $row['ID']?>') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>"></a>
				
			<?php }}?>
				
				</div></td>
		<td class="uk-text-center"><?php echo $active?></td>	
		<td class="uk-table-link"><a onclick="previewModal('<?php echo $row['ID']?>')" ><?php echo $row['Town'];?></a></td>
				<td class="uk-table-link"><a href="" ><?php echo $title;?></a></td>
        <td class="uk-table-link"><a onclick="previewModal('<?php echo $row['ID']?>')" ><?php echo $row['ID'];?></a></td> 
		
        <td class="uk-table-link"><a href="" ><?php if(($row['longlatpobla'])!=""){?><?php echo $coor[0];?> / <?php echo $coor[1];?><?php }else {echo "-No asignado-";}?></a></td> 
		
			
	<td ><?php echo $CP;?></td>

			
			 
			<td class="uk-table-expand" ><div class="uk-grid uk-grid-small">
				<a onclick="previewModal('<?php echo $row['ID']?>')" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>
				<a href="<?php echo DIR;?>zonas/zona?accion=edit&ref=<?php echo $row['ID']?>"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>
				<a onclick="previewGallery('<?php echo $row['ID']?>')"><span uk-icon="icon:image;ratio:1" uk-tooltip="Galería"></span></a>
				<a href="https://www.villasplanet.com/es/informacion-sobre-<?php echo $townlimpio?>" target="new" ><span uk-icon="icon:link;ratio:1" uk-tooltip="Ficha web"></span></a>
				<a onclick="deleteData('<?php echo $row['ID']?>')"><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
				
				
				</div></td>
        </tr><?php }?>
		
        
    </tbody>
</table>