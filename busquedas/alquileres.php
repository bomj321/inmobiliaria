
	<div class="row"  style="margin-top: 50px; background-color: white;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin-top: 10px;">
			 <table id="alquileres_busqueda" class="table table-hover bulk_action dt-responsive nowrap table-striped" cellspacing="0" width="100%">
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
                                    <th style="min-width:150px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                          <!--CONSULTAS SQL PARA EL CUERPO DE LA TABLA-->
<?php

/*PRIMERO SE OBTIENE LA CANTIDAD DE COLUMNAS*/

$query = $db->prepare('show columns from rentals');
$query->setFetchMode(PDO::FETCH_ASSOC);

$query->execute();
$queryCondition = "";

$i = 0;
while ($row = $query->fetch()){
$i++;     
}

/*PRIMERO SE OBTIENE LA CANTIDAD DE COLUMNAS*/

/*DESPUES DE OBTIENDE LA QUERY A AGREGAR AL SELECT*/
$query_2 = $db->prepare('show columns from rentals');
$query_2->setFetchMode(PDO::FETCH_ASSOC);

$query_2->execute();
$a = 0;
while ($row = $query_2->fetch()){

       $queryCondition .= ' rentals.'. $row['Field'] . " LIKE '%" . $busqueda . "%'";

$a++;    

/*SECCION PARA VERIFICAR SI ES EL ULTIMO REGISTRO Y AGREGAR EL OR*/


if($i!=$a){
              $queryCondition .= " OR ";
          }

/*SECCION PARA VERIFICAR SI ES EL ULTIMO REGISTRO Y AGREGAR EL OR*/

}

/*DESPUES DE OBTIENDE LA QUERY A AGREGAR AL SELECT*/








$stmt = $db->prepare("SELECT rentals.yourRef,rentals.sellerID,rentals.propTown,rentals.propLocation,rentals.propNameES,rentals.propType,rentals.propPrice,rentals.ID,rentals.active,image_properties_rentals.full as imagengrande,image_properties_rentals.small as imagenpequena,owners.sellerName1 as nombrevendedor FROM rentals  LEFT  JOIN owners ON rentals.sellerID = owners.ID LEFT  JOIN image_properties_rentals ON (image_properties_rentals.ref = rentals.ID AND image_properties_rentals.orden = 1) WHERE " . $queryCondition . " ORDER BY yourRef desc");
/*$stmt = $db->prepare("SELECT yourRef,sellerID,propTown,propLocation,propNameES,propType,propPrice,ID FROM rentals ORDER BY yourRef limit 50" );*/
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$i=1;
while ($row = $stmt->fetch())
{// WHILE 1
$ref=$row['yourRef'];
//$tipo = explode('|',$row['propType']);
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

<tr>

						            <td>
										<div uk-lightbox style="width:50px;height:50px; " id="short<?php echo $i?>">
													<a style='color: black;' <?php if ($row['imagengrande']=="")
													{

														?> href="<?php echo DIR;?>images/nofoto.jpg"<?php

														 }else if ($row['imagengrande']!="")
														 {
														 	?> href="<?php echo $row['imagengrande']?>"
														 <?php
														}?>
														data-caption="<button onclick=previewGallery('<?php echo $row['ID']?>','<?php echo "short".$i ?>') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>">
														<?php if ($row['imagenpequena']=="")
														{
															?>

																<img style='height: 50px;  border-radius: 50px;' src="<?php echo DIR;?>images/nofotosmall.jpg" alt="">
														<?php
														 }else if ($row['imagenpequena']!="")
														 {
														 	?>

														 	<img style='height: 50px;  border-radius: 50px;' src="<?php echo $row['imagenpequena']?>" alt="">
														 <?php
														  }

																?>

														</a>
														<?php if($row['imagengrande']!="") {

															?>
														<a href="<?php echo$row['imagengrande']?>" data-caption="<button onclick=previewGallery('<?php echo $row['ID']?>','<?php echo "short".$i ?>') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>"></a>

														<?php

												}?>

											</div>
										</td>
										<td>
											<center>
												<?php if ($row['active']=='1'): ?>

														<a onclick="estado('<?php echo $row['ID']?>','<?php echo $row['active']?>')"><span uk-icon="icon:check;ratio: 1" class="green"></a></span>

													<?php else: ?>

														<a onclick="estado('<?php echo $row['ID']?>','<?php echo $row['active']?>')"><span uk-icon="icon:close;ratio: 1" class="red"></a></span>

												<?php endif ?>
											</center>
										</td>
										<td><a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" ><span style="font-weight:600"><?php echo $row['yourRef']?></span></a></td>
										<td>Alquiler</td>
										<td><a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" class="uk-text-truncate"><?php echo $row['propNameES']?></a></td>
										<td>
											<?php
												$tipo_de_casa=str_replace('_', ' ',$row['propType']);
											 ?>

											<a style='color: black;' href="" ><?php echo ucfirst($tipo_de_casa);?></a>
										</td>
										<td><a style='color: black;' onclick="datoscliente(<?php echo $row['SellerID']?>)" data-toggle="modal" data-target="#cliente_modal" ><?php echo $row['nombrevendedor']?></a></td>
										<td><a style='color: black;'  href="" ><?php echo $location?></a></td>
										<td><?php echo $precio?></td>
										<td>
											<div class="uk-grid uk-grid-small">
													<!--<a style='color: black;' onclick="previewModal('<?php //echo $row['yourRef']?>')" ><span uk-icon="icon:info;ratio:1" uk-tooltip="Previsualizar"></span></a>-->
													<a style='color: black;' href="<?php echo DIR;?>propiedades/editar_rentals?yourRef=<?php echo trim($row['yourRef'])?>"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>
													<a style='color: black;' onclick="previewGallery('<?php echo $row['ID']?>','<?php echo "short".$i ?>')"><span uk-icon="icon:image;ratio:1" uk-tooltip="Galería"></span></a>
													<a style='color: black;' href="http://www.villasplanet.com/es/venta-<?php echo $title2?>-ref-<?php echo $row['yourRef']?>" target="new" ><span uk-icon="icon:link;ratio:1" uk-tooltip="Ficha web"></span></a>
													<a style='color: black;'  onclick="deletedata(<?php echo $row['ID']?>)"><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
													<a style='color: black;'  onclick="vercalendario(<?php echo $row['ID']?>)"><span uk-icon="icon:calendar;ratio:1" uk-tooltip="Calendario"></span></a>
													<a style='color: black;'  onclick="verperiodos(<?php echo $row['ID']?>)"><span uk-icon="icon:credit-card;ratio:1" uk-tooltip="Periodos"></span></a>
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
<!--TABLA TODAS-->
