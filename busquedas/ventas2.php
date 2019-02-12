
<?php 
	/*PRIMERO SE OBTIENE LA CANTIDAD DE COLUMNAS*/

$query = $db->prepare('show columns from properties');
$query->setFetchMode(PDO::FETCH_ASSOC);

$query->execute();
$queryCondition = "";

$i = 0;
while ($row = $query->fetch()){
$i++;     
}

/*PRIMERO SE OBTIENE LA CANTIDAD DE COLUMNAS*/

/*DESPUES DE OBTIENDE LA QUERY A AGREGAR AL SELECT*/
$query_2 = $db->prepare('show columns from properties');
$query_2->setFetchMode(PDO::FETCH_ASSOC);

$query_2->execute();
$a = 0;
while ($row = $query_2->fetch()){

       $queryCondition .= ' properties.'. $row['Field'] . " LIKE '%" . $busqueda . "%'";

$a++;    

/*SECCION PARA VERIFICAR SI ES EL ULTIMO REGISTRO Y AGREGAR EL OR*/


if($i!=$a){
              $queryCondition .= " OR ";
          }

/*SECCION PARA VERIFICAR SI ES EL ULTIMO REGISTRO Y AGREGAR EL OR*/

}

/*DESPUES DE OBTIENDE LA QUERY A AGREGAR AL SELECT*/


 ?>










<div class="row" style="margin-top: 50px; background-color: white;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin-top: 10px;">
			  <table id="ventas_busqueda" class="table table-hover bulk_action dt-responsive nowrap table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                		<th>Imagen</th>
                                    <th>Publicado</th>
                                    <th>Referencia</th>
                                    <th>Estado</th>
                                    <th>Titulo / Nombre</th>
                                    <th>Tipo</th>
                                    <th>Propietario / Cliente</th>
                                    <th>Población</th>
                                    <th>Precio</th>
                                    <th style="min-width:100px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                          <!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->
<?php
$stmt = $db->prepare("SELECT distinct properties.yourRef,properties.sellerID,properties.propTown,properties.propLocation,properties.propNameES,properties.propType,properties.propPrice,properties.ID,properties.active,image_properties.medium as imagengrande,image_properties.small as imagenpequena,owners.sellerName1 as nombrevendedor FROM properties  LEFT JOIN owners ON properties.sellerID = owners.ID LEFT JOIN image_properties ON (image_properties.ref = properties.ID AND image_properties.orden = 1) WHERE" 
	.$queryCondition. " ORDER BY yourRef desc");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$i=1;
while ($row = $stmt->fetch())
{// WHILE 1

$ref=$row['yourRef'];
$tipo = explode('|',$row['propType']);
$localizaciones = explode(':',$row['propLocation']);
$town=$row['propTown'];
$title2 = limpia($row['propNameES']);
$location=$localizaciones;
if (($location=="0") or ($location=" ")) {
	$location=strtolower($localizaciones[0]);
} else {
	$location=$location;

}

$location=ucwords($location);

$titulo_prop=strtolower($row['propNameES']);

if ($location=="0") {
	$location="<span style='font-style:italic'>-No asignado-</span>";
}

$precio = number_format((float)$row['propPrice'], 0, ',', '.');

if ($precio!="0") {
	$precio=$precio."€";
} else {
	$precio="<i>-No asignado-</i>";
}
 ?>
<tr >
			            <td>
										<div uk-lightbox style="width:50px;height:50px; " id="activadas<?php echo $i?>">
													<a style='color: black;' <?php if ($row['imagengrande']=="")
													{

														?> 
														href="<?php echo DIR;?>images/nofoto.jpg"

														<?php

														 }else if ($row['imagengrande']!="")
														 {
														 	?> href="<?php echo $row['imagengrande']?>"
														 	
														 <?php
														}

														?>
														data-caption="<button onclick=previewGallery('<?php echo $row['ID']?>','<?php echo "activadas".$i ?>') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>">
														<?php if ($row['imagenpequena']=="")
														{
															?>
															<div style="background:url(<?php echo DIR;?>images/nofotosmall.jpg) no-repeat 50% 50%;height:100%; border-radius:50px"></div>
														<?php
														 }else if ($row['imagenpequena']!="")
														 {
														 	?>
														 	  <div style="background:url(<?php echo $row['imagenpequena']?>) no-repeat 50% 50%;height:100%; border-radius:50px"></div>
														 <?php
														  }

																?>

														</a>
														<?php if($row['imagengrande']!="") {

															?>
														<a href="<?php echo $row['imagengrande']?>" data-caption="<button onclick=previewGallery('<?php echo $row['ID']?>','<?php echo "activadas".$i ?>') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>"></a>

														<?php

												}?>

											</div>

										</td>
										<td>
											<center>
												<?php if ($row['active']=='1'): ?>

														<a><span uk-icon="icon:check;ratio: 1" class="green"></a></span>

													<?php else: ?>

														<a><span uk-icon="icon:close;ratio: 1" class="red"></a></span>

												<?php endif ?>
											</center>
										</td>
										<td><a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" ><span style="font-weight:600"><?php echo $row['yourRef']?></span></a></td>
										<td>Venta</td>
										<td><a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" class="uk-text-truncate"><?php echo $row['propNameES']?></a></td>
										<td>

											<?php
												$tipo_de_casa=str_replace('_', ' ',$row['propType']);
											 ?>

											<a style='color: black;' href="" ><?php echo ucfirst($tipo_de_casa);?></a>

										</td>
										<td><a style='color: black;' onclick="modalEditarProp(<?php echo $row['sellerID']?>)" ><?php echo $row['nombrevendedor']?></a></td>
										<td><a style='color: black;' ><?php echo $location?></a></td>
										<td><?php echo $precio?></td>
										<td>
											<div class="uk-grid uk-grid-small">
													<a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>
													
													<a style='color: black;' onclick="previewGallery('<?php echo $row['ID']?>','<?php echo "activadas".$i ?>')"><span uk-icon="icon:image;ratio:1" uk-tooltip="Galería"></span></a>

													<a style='color: black;' href="http://www.villasplanet.com/es/venta-<?php echo $title2?>-ref-<?php echo $row['yourRef']?>" target="new" ><span uk-icon="icon:link;ratio:1" uk-tooltip="Ficha web"></span></a>
													
											</div>
										</td>
</tr>
<!--CUERPO DE LA PAGINA-->
<?php
$i++;
}// WHILE 1
?>
                            </tbody>
                        </table>
		</div>
	</div>


