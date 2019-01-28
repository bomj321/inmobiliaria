


<?php 	
//VACACIONAL
$total = "SELECT yourRef FROM rentals where active='1' and rentalType='short' and propETV='yes'"; 
$total_prop = $db->query($total)->fetchAll();  
?>
 <div class="uk-card uk-card-primary uk-card-body" style="margin-bottom:80px;">
<div class="uk-grid uk-grid-collapse">
	<div class="uk-width-1-3">
	 <p class="uk-card-title"><span uk-icon="icon:home" class="icon-margin"></span>&nbsp; <strong> Mostrando <?php echo count($total_prop);?> propiedades en venta<span class="green"> publicadas</span> </strong> </p>	
	</div>
	<div class="uk-width-2-3 direct-filter">
	<div class="uk-grid uk-grid-medium" style="float:right;margin-top:4px; margin-right:10px;">
		<div class="uk-text-right"><button class="uk-button button-direct ">Venta</button></div>
		<div class=" uk-text-right"><button class="uk-button button-direct activo">Alquiler vacacional</button></div>
			<div class="uk-text-right"><button class="uk-button button-direct">Otros alquileres</button></div>
		
		<div style="width:200px;"><select  placeholder="Ordenar por" class="simple">
        <option> Publicadas</option> 
		<option> No publicadas</option> 
		<option> Mostrar todas</option>
		
    </select></div>
		<div style="width:200px;"><select  placeholder="Ordenar por" class="simple">
        <option> Más recientes</option> 
		<option> Destacados</option> 
		<option> Precio más alto</option>
    </select></div>
	</div>
	</div>
 </div>
<table class="uk-table uk-table-middle  uk-table-striped">
		<thead>
        <tr>
			<th></th>
			<th class="uk-table-shrink">Publicado</th>
			<th class="uk-width-small"><a href="" class="uk-link-reset icon-margin-top">Referencia <span class="sort "></span></a></th>
			<th class="uk-width-small"><a href="" class="uk-link-reset icon-margin-top">Estado <span class="sort "></span></a></th>
			
			
            <th class="uk-width-large"><a href="" class="uk-link-reset icon-margin-top">Titulo / Nombre <span class="sort"></span></a></th>
			<th class="uk-width-medium"><a href="" class="uk-link-reset icon-margin-top">Tipo <span class="sort"></span></a></th>
			<th class="uk-width-medium"><a href="" class="uk-link-reset icon-margin-top">Propietario / Cliente <span class="sort"></span></a></th>
			<th class="uk-width-small"><a href="" class="uk-link-reset icon-margin-top">Población<span class="sort"></span></a></th>
			<th class="uk-text-right uk-width-small " style="padding-right:35px;"><a href="" class="uk-link-reset icon-margin-top">Precio<span class="sort"></span></a></th>
			<th class="uk-width-small"></th>
        </tr>
    </thead>
    <tbody>
		<?php 
		
//Sólo se muestra venta
$stmt = $db->prepare("SELECT yourRef,sellerID,propTown,propLocation,propNameES,propType,propPrice,priceRangeBottom FROM rentals where active='1' and rentalType='short' and propETV='yes' ORDER BY yourRef DESC");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while ($row = $stmt->fetch()){
$ref=$row['yourRef'];	
$tipo = explode('|',$row['propType']);
$localizaciones = explode(':',$row['propLocation']);
$town=$row['propTown'];
$title2 = limpia($row['propNameES']);	
$location=strtolower($localizaciones[1]);
if (($location=="0") or ($location=" ")) {$location=strtolower($localizaciones[0]);} else {$location=$location;}
$location=ucwords($location);
$titulo_prop=strtolower($row['propNameES']);
if ($location=="0") {$location="<span style='font-style:italic'>-No asignado-</span>";}
$precio = number_format((float)$row['priceRangeBottom'], 0, ',', '.');
if ($precio!="0") {$precio=$precio."€";} else {$precio="<i>-No asignado-</i>";}
$cliente=$row['sellerID'];
$stmt2 = $db->prepare("SELECT sellerName1 FROM owners WHERE ID='$cliente'");
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
$stmt4 = $db->prepare("SELECT full,small FROM image_properties WHERE ref='$ref' and orden=1");
$stmt4->execute();
$row4 = $stmt4->fetch(PDO::FETCH_ASSOC);

		?>
        <tr>
			<td><div uk-lightbox style="width:50px;height:50px; "><a  href="<?php echo $row4['full']?>" data-caption="<button class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;' uk-toggle='target: #galeria-listado'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>"><?php if ($row4['small']=="") {?><div style="background:url(<?php echo DIR;?>images/nofotosmall.jpg) no-repeat 50% 50%;height:100%; border-radius:50px"></div><?php }else{?><div style="background:url(<?php echo $row4['small']?>) no-repeat 50% 50%;height:100%; border-radius:50px"></div><?php }?></td>
			<td class="uk-text-center"><span uk-icon="icon:check;" class="green"></span></td>
			 <td class="uk-table-link"><a onclick="previewModal('<?php echo $row['yourRef']?>')" ><span style="font-weight:600"><?php echo $row['yourRef']?></span></a>
			<td class="uk-table-link"><a href="" >Venta</a></td>
			</td>
			 <td class="uk-table-link uk-text-truncate" ><a onclick="previewModal('<?php echo $row['yourRef']?>')" class="uk-text-truncate"><?php echo $row['propNameES']?></a></td>
	<td class="uk-table-link"><a href="" ><?php echo tipo_propiedad($tipo[0]);?></a></td>
			 <td class="uk-table-link"><a href="" ><?php echo $row2['sellerName1']?></a></td>
			 <td class="uk-table-link"><a href="" ><?php echo $location?></a></td>
			<td class="uk-text-right" style="padding-right:35px;"><a onclick="previewModal('<?php echo $row['yourRef']?>')"><span uk-icon="icon:calendar;"></span> Consultar</a></td>
			<td class="uk-table-expand" ><div class="uk-grid uk-grid-small">
				<a onclick="previewModal('<?php echo $row['yourRef']?>')" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>
				<a href=""><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>
				<a onclick="previewGallery('<?php echo $row['yourRef']?>')"><span uk-icon="icon:image;ratio:1" uk-tooltip="Galería"></span></a>
				<a href="http://www.villasplanet.com/es/venta-<?php echo $title2?>-ref-<?php echo $row['yourRef']?>" target="new" ><span uk-icon="icon:link;ratio:1" uk-tooltip="Ficha web"></span></a>
				<a href=""><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
				</div></td>
        </tr><?php }?>
		
        
    </tbody>
</table>
        </div>
<!-- FIN VACACIONAL -->