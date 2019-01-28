<?php
require('../includes/config2.php');
$ref=$_POST["ref"];
$zonas = $db->prepare("SELECT * FROM rentals where ID='$ref'");
$zonas->setFetchMode(PDO::FETCH_ASSOC);
$zonas->execute();
while ($row3 = $zonas->fetch()){
$tipo = explode('|',$row3['propType']);
$localizaciones = explode(':',$row3['propLocation']);
$town=$row3['propTown'];
$cliente=$row3['SellerID'];
$poblacion=strtoupper($localizaciones[0]);
$location=strtolower($localizaciones[1]);
if (($location=="0") or ($location=" ")) {$location=strtolower($localizaciones[0]);} else {$location=$location;}
$location=ucwords($location);
$area=strtolower($localizaciones[1]);
$area=ucfirst($area);
$titulo_prop=ucwords(strtoupper($row3['propNameES']));
if ($location=="0") {$location="<span style='font-style:italic'>-No asignado-</span>";}
$precio = number_format((float)$row3['propPrice'], 0, ',', '.');
$owner = $db->prepare("SELECT sellerName1 FROM owners WHERE ID='$cliente'");
$owner->execute();
$owner2 = $owner->fetch(PDO::FETCH_ASSOC);
$CP = $db->prepare("SELECT PC FROM sys_towns where Town='$poblacion' and Location='0' limit 1");
$CP->execute();
$CP2 = $CP->fetch(PDO::FETCH_ASSOC);
$stmt4 = $db->prepare("SELECT full FROM image_properties_rentals WHERE ref='$ref' and orden=1");//////////////////////////////REVISAR ESTA PARTE DEL CODIGO
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
            <div class="uk-background-cover uk-width-1-3" style="background-image: url('<?php echo $row4['full'];?>');" uk-height-viewport></div>
            <div class="uk-padding-large uk-width-2-3">
				<div class="uk-grid">
					<div class="uk-width-1-3">
                <h1 class="uk-margin-small-bottom orange"><?php echo $row3['ID']+1000;?>V</h1>
					</div>
					<div class="uk-width-2-3">
                <div class="uk-grid uk-grid-medium" style="float:right;margin-top:4px; margin-right:10px;">
		<div class="uk-text-right">
        <a class="uk-button button-direct" style='color: black;' href="<?php echo DIR;?>propiedades/editar_rentals?yourRef=<?php echo trim($row3['yourRef'])?>"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span>Editar propiedad</a>

    </div>
		<div class=" uk-text-right"><button onclick="previewGallery('<?php echo $row3['ID']?>','<?php echo "short" ?>')" class="uk-button button-direct"><span uk-icon="icon:image; ratio:0.9" class="icon-margin"></span> Editar galería</button></div>
	</div>
					</div>
				</div>
				 <h4 class="uk-margin-small-top uk-margin-small-bottom uk-text-uppercase"><strong><?php echo $titulo_prop;?></strong></h4>
				<h5 class="uk-margin-small-top uk-margin-small-bottom"> <?php if ($row3['active']!="0"){?> <span class="green"><span uk-icon="icon:check; ratio:0.9"></span> Publicado</span> <?php }else{?> <span class="uk-icon-button uk-margin-small-right" uk-icon="ban"></span> No publicado <?php }?> </h5>
				<h4 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Precio:</span> <?php if ($precio!="0"){?>  <?php echo $precio." €";?> <?php }else{ echo "-No asignado-";}?> </h4>

				<h4 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Propietario/cliente:</span> <?php echo $owner2['sellerName1']?></h4>
				<hr class="uk-article-divider uk-margin-small-bottom">
					<div class=" uk-grid-medium uk-child-width-auto uk-grid ">

					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Tipo de inmueble:</span> <?php echo tipo_propiedad($tipo[0]);?> </h5>
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Estado:</span> Vendido u Oferta o Reservado o Disponible </h5>
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Destacado:</span> <?php if ($row3['propFeatured']=="yes"){?>  Si <?php }else{ echo "No";}?> </h5>
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Propiedad de lujo:</span> <?php if ($row3['esLujo']=="yes"){?>  Si <?php }else{ echo "No";}?> </h5>
					</div>
				<h5 class="grey-titles uk-margin-top uk-margin-small-bottom"><strong><span uk-icon="icon:location; ratio:0.9" class="icon-margin"></span> Situación del inmueble</strong></h5>
				<div class=" uk-grid-medium uk-child-width-auto uk-grid">
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Población:</span> <?php echo $location;?> </h5>
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Área:</span> <?php if ($area!="0"){?>  <?php echo $area;?> <?php }else{ echo "-No asignada-";}?> </h5>
				<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Dirección:</span> <?php if ($row3['propAddress']!=""){?>  <?php echo $row3['propAddress'];?> <?php }else{ echo "-No asignada-";}?> </h5>
				<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">C.P:</span> <?php if ($CP2['PC']!=""){?>  <?php echo $CP2['PC'];?> <?php }else{ echo "-No asignado-";}?> </h5>

				</div>
				<h5 class="grey-titles uk-margin-top uk-margin-small-bottom"><strong><span uk-icon="icon:info; ratio:0.9" class="icon-margin"></span> Información general de la propiedad</strong></h5>
				<h5 class="uk-margin-small-top uk-margin-small-bottom">Distribución</h5>
				<div class=" uk-grid-medium uk-child-width-auto uk-grid">

					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Habitaciones sencillas:</span> <?php echo $row3['propBedSingle'];?> </h5>
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Habitaciones dobles:</span> <?php echo $row3['propBedDouble'];?> </h5>
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Baños:</span> <?php echo $row3['propBathroom'];?> </h5>
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Aseos:</span> <?php echo $row3['propToilet'];?> </h5>


				</div>
				<h5 class="uk-margin-small-top uk-margin-small-bottom">Medidas inmueble</h5>
				<div class=" uk-grid-medium uk-child-width-auto uk-grid">

					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Superficie útil ( m<sup>2</sup> ):</span> <?php if ($row3['propHouseM2']!=""){?>  <?php echo $row3['propHouseM2'];?> <?php }else{ echo "-";}?> </h5>
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Superficie terraza ( m<sup>2</sup> ):</span> <?php if ($row3['propTerraceM2']!=""){?>  <?php echo $row3['propTerraceM2'];?> <?php }else{ echo "-";}?> </h5>
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Superficie terreno ( m<sup>2</sup> ):</span> <?php if ($row3['propLandM2']!=""){?>  <?php echo $row3['propLandM2'];?> <?php }else{ echo "-";}?></h5>
					<h5 class="uk-margin-small-top uk-margin-small-bottom"><span class="orange">Superficie total ( m<sup>2</sup> ):</span>
             <?php

                      if(is_numeric($row3['propHouseM2']) AND is_numeric($row3['propTerraceM2']) AND is_numeric($row3['propLandM2']))
                      {
                          $total_sup = ($row3['propHouseM2'] + $row3['propTerraceM2'] + $row3['propLandM2']);

                      }else{
                        $total_sup = 'Sin Informaci&oacute;n';
                      }


	                 echo $total_sup;
                   ?>
          </h5>


				</div>
				<h5 class="grey-titles uk-margin-top uk-margin-small-bottom"><strong><span uk-icon="icon:cog; ratio:0.9" class="icon-margin"></span> Detalles de la propiedad</strong></h5>
                 <ul class="uk-margin-top" uk-tab>
    <li class="uk-active"><a href="">Características/Equipamiento</a></li>
    <li><a href="">Entorno/Distancias</a></li>
	<li><a href="">Extras/Servicios</a></li>

</ul>
<ul class="uk-switcher uk-margin-small-top">
	<li>
	 <div class="uk-form-controls">
         <div class="uk-grid">
			 <div class=" uk-grid-medium uk-child-width-auto uk-grid ">
            <label style=" margin-top:5px;"><input class="uk-checkbox" type="checkbox" checked disabled>&nbsp; Piscina</label>
			<label style=" margin-top:5px;" ><input class="uk-checkbox" type="checkbox" checked disabled>&nbsp; Parking/Garaje: Comunitario</label>

				 <label style=" margin-top:5px;"><input class="uk-checkbox" type="checkbox" checked disabled>&nbsp; Lavanderia</label>
				 <label style="margin-top:5px;"><input class="uk-checkbox" type="checkbox" checked disabled>&nbsp; Jardín</label>
				 <label style="margin-top:5px;"><input class="uk-checkbox" type="checkbox" checked disabled>&nbsp; Calefacción</label>
				 <label style="margin-top:5px;"><input class="uk-checkbox" type="checkbox" checked disabled>&nbsp; Aire acondicionado</label>
				 <label style="margin-top:5px;"><input class="uk-checkbox" type="checkbox" checked disabled>&nbsp; Chimenea</label>
			<label style="margin-top:5px;"><input class="uk-checkbox" type="checkbox" checked disabled>&nbsp; Bodega</label>


        </div>


			</div>

		</div>
	</li>
	<li><div class="uk-form-controls">
         <div class="uk-grid">
			 <div class=" uk-grid-medium uk-child-width-auto uk-grid ">
           <label style="cursor:pointer; margin-top:5px;" > <p class="orange " style="margin:5px 0 10px 0;">Distancia al aeropuerto: <span class="grey3"> 20 km.</span></p>
				 </label>
			<label style="cursor:pointer; margin-top:5px;" > <p class="orange " style="margin:5px 0 10px 0;">Distancia a la playa:<span class="grey"> 300 m.</span></p>
				 </label>
				 <label style="cursor:pointer; margin-top:5px;" > <p class="orange " style="margin:5px 0 10px 0;">Distancia a restaurantes:<span class="grey3"> 50 m</span></p>
				 </label>
        </div>


			</div>

		</div></li>
	<li> No hay extras o servicios asociados</li>
				</ul>

            </div>
        </div>
    </div>
</div>
<?php }
?>
