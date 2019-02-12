
<?php 
require_once('query_cliente.php');

$stmt = $db->prepare("SELECT ID ,clientType, dateAdded, clientName, clientEmail,clientTel1  FROM clients WHERE " . $queryCondition_cliente . "");

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$num_rows = $stmt->rowCount();


$stmt = $db->prepare("SELECT ID ,clientType, dateAdded, clientName, clientEmail,clientTel1  FROM clients WHERE " . $queryCondition_cliente . " ORDER BY ID limit 0, 5");

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$i = 1;
 ?> 

<?php if ($num_rows > 0): ?>
   
    <strong><h1>Clientes</h1></strong>

      <div id="clients_list">

            <?php while ($row = $stmt->fetch()){// WHILE 1 ?>

                <div class="panel-group" id="item-<?php echo $i ?>" role="tablist" aria-multiselectable="true" >
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="heading<?php echo $i; ?>">
                            <h4 class="panel-title">
                              <a role="button" data-toggle="collapse" data-parent="#item-<?php echo $i ?>" href="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                                <?php echo $row['clientName']?>
                              </a>
                            </h4>
                          </div>
                          <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>">
                            <div class="panel-body">
                             <p><strong>ID del Cliente:</strong><?php echo $row['ID']?> </p>
                             <p><strong>Tipo del Cliente:</strong><?php echo $row['clientType']?> </p>                   
                             <p><strong>Fecha de Creaci&oacute;n: </strong><a style='color: black;' onclick="previewModal('<?php echo $row['ID']?>')" class="uk-text-truncate"><?php echo $row['dateAdded']?> </a></p>                    
                            <p><strong>Email del Cliente: </strong><?php echo $row['clientEmail']?></p> 
                            <p><strong>Telefono del Cliente: </strong><?php echo $row['clientTel1']?></p>
                            <button class="btn btn-danger" id='boton_clientes_editar' onclick="modalEditar(<?php echo $row['ID']?>)">Editar Cliente</button>
                            </div>
                          </div>       
                        </div>     
                </div>

                <?php $i++; } ?>
          <?php if ($num_rows > 5): ?>
            <div id="clients_items">
              <button class="btn btn-warning pull-right boton_ver_mas btn-lg" onclick="load_clientes(2,<?php echo $num_rows ?>,'<?php echo $busqueda ?>')">Ver más</button>
          </div> 
          <?php endif ?>
              
      </div>

<?php endif ?> 
