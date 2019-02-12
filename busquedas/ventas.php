
<?php 
require_once('query_venta.php');

$stmt = $db->prepare("SELECT distinct properties.yourRef,properties.sellerID,properties.propTown,properties.propLocation,properties.propNameES,properties.propType,properties.propPrice,properties.ID,properties.active,image_properties.medium as imagengrande,image_properties.small as imagenpequena,owners.sellerName1 as nombrevendedor FROM properties  LEFT JOIN owners ON properties.sellerID = owners.ID LEFT JOIN image_properties ON (image_properties.ref = properties.ID AND image_properties.orden = 1) WHERE " . $queryCondition . "");

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$num_rows = $stmt->rowCount();


$stmt = $db->prepare("SELECT distinct properties.yourRef,properties.sellerID,properties.propTown,properties.propLocation,properties.propNameES,properties.propType,properties.propPrice,properties.ID,properties.active,image_properties.medium as imagengrande,image_properties.small as imagenpequena,owners.sellerName1 as nombrevendedor FROM properties  LEFT JOIN owners ON properties.sellerID = owners.ID LEFT JOIN image_properties ON (image_properties.ref = properties.ID AND image_properties.orden = 1) WHERE " . $queryCondition . " ORDER BY ID limit 0, 5");

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$i = 1;
 ?> 

<?php if ($num_rows > 0): ?>
   
    <strong><h1>Ventas</h1></strong>

      <div id="ventas_list">

            <?php while ($row = $stmt->fetch()){// WHILE 1 
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


                <div class="panel-group" id="venta-<?php echo $i ?>" role="tablist" aria-multiselectable="true" >
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="heading<?php echo $i; ?>">
                            <h4 class="panel-title">
                              <a role="button" data-toggle="collapse" data-parent="#venta-<?php echo $i ?>" href="#venta<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                                <?php echo $row['propNameES']?>
                              </a>
                            </h4>
                          </div>
                          <div id="venta<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>">
                            <div class="panel-body">
                                                               
                                <strong>Imagen:
                                <?php if ($row['imagengrande']==""): ?>
                                      <div uk-lightbox style="width:50px;height:50px; " id="activadas<?php echo $i?>">   
                                                <a style='color: black;' href="<?php echo DIR;?>images/nofoto.jpg" data-caption="<button onclick=previewGallery('<?php echo $row['ID']?>','<?php echo "venta".$i ?>') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>">
                                                   <div style="background:url(<?php echo DIR;?>images/nofotosmall.jpg) no-repeat 50% 50%;height:100%; border-radius:50px"></div> 
                                        </div>
                                    <?php elseif($row['imagengrande']!=""): ?>
                                        <div uk-lightbox style="width:50px;height:50px; " id="activadas<?php echo $i?>">
                                            <a style='color: black;' href="<?php echo $row['imagengrande']?>" data-caption="<button onclick=previewGallery('<?php echo $row['ID']?>','<?php echo "venta".$i ?>') class='uk-button uk-button-primary uk-margin-bottom' style='padding:10px 20px;'><h3 style='margin-bottom:0px;'><span uk-icon='icon:image;ratio:1'></span> <strong>Editar galería</strong></h3></button>">
                                                 <div style="background:url(<?php echo $row['imagengrande']?>) no-repeat 50% 50%;height:100%; border-radius:50px"></div>
                                         </div>        
                                     <?php elseif($row['imagenpequena']==""): ?> 
                                            <div uk-lightbox style="width:50px;height:50px; " id="activadas<?php echo $i?>"> 
                                                 <div style="background:url(<?php echo DIR;?>images/nofotosmall.jpg) no-repeat 50% 50%;height:100%; border-radius:50px"></div>
                                         </div>   
                                     <?php elseif($row['imagenpequena']==!""): ?>  
                                        <div uk-lightbox style="width:50px;height:50px; " id="activadas<?php echo $i?>"> 
                                            <div style="background:url(<?php echo $row['imagenpequena']?>) no-repeat 50% 50%;height:100%; border-radius:50px"></div>
                                        </div>             

                                <?php endif ?>

                              </strong>
                            

                             <p style="margin-top: 40px;"><strong>ID: </strong><?php echo $row['ID'] ?></p>
                             <p><strong>Estado: </strong>

                               <?php if ($row['active']=='1'): ?>

                                            <a><span uk-icon="icon:check;ratio: 1" class="green"></a></span>

                                        <?php else: ?>

                                            <a><span uk-icon="icon:close;ratio: 1" class="red"></a></span>

                                    <?php endif ?>


                            </p>                   
                             <p><strong>Referencia: </strong><a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" ><span style="font-weight:600"><?php echo $row['yourRef']?></span></a></p>                    
                            <p><strong>Tipo: </strong>
                                    <?php
                                                $tipo_de_casa=str_replace('_', ' ',$row['propType']);
                                             ?>

                                            <a style='color: black;' href="" ><?php echo ucfirst($tipo_de_casa);?></a>
                            </p>
                            <p><strong>Propietario / Cliente: </strong>
                                <a style='color: black;' onclick="modalEditarProp(<?php echo $row['sellerID']?>)" ><?php echo $row['nombrevendedor']?></a>
                            </p>
                            <p><strong>Poblaci&oacute;n: </strong><?php echo $location?></p>
                            <p><strong>Precio: </strong><?php echo $precio?></p>
                            <button class="btn btn-danger" onclick="previewModal('<?php echo $row['ID']?>')">Previsualizar</button>
                            <button class="btn btn-success" onclick="previewGallery('<?php echo $row['ID']?>','<?php echo "venta".$i ?>')">Galer&iacute;a</button>
                            <button class="btn btn-primary" href="http://www.villasplanet.com/es/venta-<?php echo $title2?>-ref-<?php echo $row['yourRef']?>" target="new" >Ficha web</button>
                            </div>
                          </div>       
                        </div>     
                </div>

                <?php $i++; } ?>
          <?php if ($num_rows > 5): ?>
            <div id="ventas_items">
              <button class="btn btn-success pull-right boton_ver_mas btn-lg" onclick="load_ventas(2,<?php echo $num_rows ?>,'<?php echo $busqueda ?>','')">Ver más</button>
          </div> 
          <?php endif ?>
              
      </div>

<?php endif ?> 
