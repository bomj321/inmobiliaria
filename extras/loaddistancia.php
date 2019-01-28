<?php require('../includes/config2.php'); ?>
<div class="uk-grid uk-grid-collapse">
	<div class="uk-width-1-3">
		<?php $total2 = "SELECT DISTINCT id FROM distancias_properties"; 
$total_prop2 = $db->query($total2)->fetchAll();  ?>
	 <p class="uk-card-title"><span uk-icon="icon:rss" class="icon-margin"></span>&nbsp; <strong> Mostrando <?php echo count($total_prop2)?> <span class="green"> distancias creadas</span> </strong> </p>	
	</div>
	<div class="uk-width-2-3 direct-filter">
	<div class="uk-grid uk-grid-medium" style="float:right;margin-top:4px; margin-right:10px;">
		<div class="uk-text-right"><button class="uk-button button-direct activo" onclick="previewModalNew()"><span uk-icon="icon:plus; ratio:0.85;"></span> Crear nueva distancia</button></div>
		
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
				
				<a onclick="deleteData2('<?php echo $refextra2?>')"><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
				
				
				</div></td>
			
			 
			
        </tr>
		<?php }?>
        
    </tbody>
</table>