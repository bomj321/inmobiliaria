
<?php 
require_once('query_propietario.php');

$stmt_owners = $db->prepare("SELECT ID ,propType, dateAdded, sellerName1, sellerEmail,sellerTel  FROM owners WHERE " . $queryCondition . " ORDER BY ID");

$stmt_owners->setFetchMode(PDO::FETCH_ASSOC);
$stmt_owners->execute();
$num_rows_owners = $stmt_owners->rowCount();


$stmt_owners_array = $db->prepare("SELECT ID ,propType, dateAdded, sellerName1, sellerEmail,sellerTel  FROM owners WHERE " . $queryCondition . " ORDER BY ID limit 0, 5");

$stmt_owners_array->setFetchMode(PDO::FETCH_ASSOC);
$stmt_owners_array->execute();
$i = 1;
 ?> 

<?php if ($num_rows_owners > 0): ?>
   
    <strong><h1>Propietarios</h1></strong>

      <div id="owners_list">

            <?php while ($row = $stmt_owners_array->fetch()){// WHILE 1 ?>

                <div class="panel-group" id="owner-<?php echo $i ?>" role="tablist" aria-multiselectable="true" >
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="heading<?php echo $i; ?>">
                            <h4 class="panel-title">
                              <a role="button" data-toggle="collapse" data-parent="#owner-<?php echo $i ?>" href="#owner<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                                <?php echo $row['sellerName1']?>
                              </a>
                            </h4>
                          </div>
                          <div id="owner<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>">
                            <div class="panel-body">
                             <p><strong>ID del Propietario:</strong><?php echo $row['ID']?> </p>
                             <p><strong>Tipo de Propietario:</strong><?php echo $row['propType']?> </p>                   
                             <p><strong>Fecha de Creaci&oacute;n: </strong><a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" class="uk-text-truncate"><?php echo $row['dateAdded']?> </a></p>                    
                            <p><strong>Email del Propietario: </strong><?php echo $row['sellerEmail']?></p> 
                            <p><strong>Telefono del Propietario: </strong><?php echo $row['sellerTel']?></p>
                            <button class="btn btn-danger" id='boton_propietarios_editar' onclick="modalEditarProp(<?php echo $row['ID']?>)">Editar Propietario</button>
                            </div>
                          </div>       
                        </div>     
                </div>

                <?php $i++; } ?>
          <?php if ($num_rows_owners > 5): ?>
            <div id="owners_items">
              <button class="btn btn-primary pull-right boton_ver_mas btn-lg" onclick="load_owners(2,<?php echo $num_rows_owners ?>,'<?php echo $busqueda ?>')">Ver más</button>
          </div> 
          <?php endif ?>
              
      </div>

<?php endif ?> 
