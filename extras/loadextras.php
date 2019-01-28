<?php require('../includes/config2.php'); ?>
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
			<th class="uk-width-large"> </th>
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
if ($tipoprop=="Venta/Anual/Vacacional/Temporal") {$tipoprop="Todas";} else { $tipoprop=$tipoprop;}
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