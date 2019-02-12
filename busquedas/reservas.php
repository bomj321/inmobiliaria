
<?php 
$host = '91.142.222.126';
$database = 'webstyle_mallorcapanel';
$user = 'miguel_workana';
$pass = 'Hpc4~f25';


try {

  //create PDO connection
  $db_reservas = new PDO("mysql:host=".$host.";charset=utf8mb4;dbname=".$database, $user, $pass);
    //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);//Suggested to uncomment on production websites
    $db_reservas->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Suggested to comment on production websites
    $db_reservas->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch(PDOException $e) {
  //show error
    echo '<p class="uk-alert-danger">'.$e->getMessage().'</p>';
    exit;
}


require_once('query_reserva.php');

$db_reservas_row = $db_reservas->prepare("SELECT rental_enquiries.*,rentals.propNameES as NameES,rentals.propType as Type,rentals.propAddress as Address,clients.ClientName as nombrecliente FROM rental_enquiries LEFT JOIN rentals ON rental_enquiries.PropID = rentals.ID LEFT JOIN clients ON rental_enquiries.ClientID = clients.ID WHERE " . $queryCondition_reserva . " ORDER BY rental_enquiries.ID DESC");

$db_reservas_row->setFetchMode(PDO::FETCH_ASSOC);
$db_reservas_row->execute();
$num_rows_reservas = $db_reservas_row->rowCount();


$db_reservas_array = $db_reservas->prepare("SELECT rental_enquiries.*,rentals.propNameES as NameES,rentals.propType as Type,rentals.propAddress as Address,clients.ClientName as nombrecliente FROM rental_enquiries LEFT JOIN rentals ON rental_enquiries.PropID = rentals.ID LEFT JOIN clients ON rental_enquiries.ClientID = clients.ID WHERE " . $queryCondition_reserva . " ORDER BY rental_enquiries.ID DESC limit 0, 5");

$db_reservas_array->setFetchMode(PDO::FETCH_ASSOC);
$db_reservas_array->execute();
$i = 1;
 ?> 

<?php if ($num_rows_reservas > 0): ?>
   
    <strong><h1>Reservas</h1></strong>

      <div id="reservas_list">

            <?php while ($row = $db_reservas_array->fetch()){// WHILE 1 ?>

                <div class="panel-group" id="reserva-<?php echo $i ?>" role="tablist" aria-multiselectable="true" >
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="heading<?php echo $i; ?>">
                            <h4 class="panel-title">
                              <a role="button" data-toggle="collapse" data-parent="#reserva-<?php echo $i ?>" href="#reserva<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                                <?php echo $row['NameES']?>
                              </a>
                            </h4>
                          </div>
                          <div id="reserva<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>">
                            <div class="panel-body">
                                <p><strong>ID de la Reserva: </strong><?php echo $row['ID']?> </p>
                                <p><strong>Fecha de la Reserva: </strong>
                                      <?php $date_reserva = date_create($row['dateAdded']); ?>
                                      <?php echo date_format($date_reserva, 'd-m-Y'); ?>
                               </p>            
                                <p><strong>Cliente: </strong><?php echo $row['nombrecliente'] ?></p> 
                                <p><strong>Tipo Propiedad: </strong><?php echo $row['Type']?></p>
                                <p><strong>Fecha de Entrada: </strong>
                                    <?php $date_entrada = date_create($row['enquiryStart']); ?>
                                    <?php echo date_format($date_entrada, 'd-m-Y'); ?>
                                </p>
                                <p><strong>Fecha de Salida: </strong>
                                    <?php $date_salida = date_create($row['enquiryEnd']); ?>
                                    <?php echo date_format($date_salida, 'd-m-Y'); ?>
                                </p>
                                <p><strong>Tipo de Reserva:
                                    <?php require_once('condicional_boton_reserva.php'); ?>


                                </p>
                                <p><strong>Precio: </strong><?php echo $row['bookingComm']?></p>
                                <p><strong>Owner: </strong><?php echo $row['bookingOwnerFee']?></p>
                                <p><strong>Charges: </strong><?php echo $row['bookingCharges']?></p>
                                <p><strong>Discount: </strong><?php echo $row['bookingFeeType']?></p>
                                <p><strong>Direcci&oacute;n: </strong><?php echo $row['Address']?></p>
                                <p><strong>Adultos: </strong><?php echo $row['bookingAdults']?></p>
                                <p><strong>Ni&ntilde;os: </strong><?php echo $row['bookingChildren']?></p>
                                <p><strong>Edades: </strong><?php echo $row['bookingChildAges']?></p>
                                <p><strong>Comentarios: </strong><?php echo $row['bookingNotesPrivate']?></p>
                                <p><strong>Profit: </strong>
                                    
                                            <!--FORMATEO DE LOS DATOS-->
                                            <?php 
                                                    /*if (empty($row['bookingComm'])) {
                                                        $row['bookingComm'] = 0 ;
                                                    }*/

                                                    if (empty($row['bookingOwnerFee']) || !is_numeric($row['bookingOwnerFee'])) {
                                                        $row['bookingOwnerFee'] = 0 ;
                                                    }

                                                    if (empty($row['bookingCharges']) || !is_numeric($row['bookingCharges'])) {
                                                        $row['bookingCharges'] = 0 ;
                                                    }
                                                    if (empty($row['bookingFeeType']) || !is_numeric($row['bookingFeeType'])) {
                                                        $row['bookingFeeType'] = 0 ;
                                                    }

                                                    /*if (empty($row['bookingDeposit'])) {
                                                        $row['bookingDeposit'] = 0 ;
                                                    }*/

                                                    if (!empty($row['bookingComm']) AND $row['bookingComm'] != '0.00') {
                                                        $total = $row['bookingComm'];

                                                    }elseif(!empty($row['bookingDeposit']) AND $row['bookingDeposit'] != '0.00'){
                                                        $total = $row['bookingDeposit'];
                                                    }else{
                                                        $total = 0;
                                                    }
                                             ?>

                                            <!--FORMATEO DE LOS DATOS-->

                                            <?php echo ($total) - ($row['bookingOwnerFee'] + $row['bookingCharges']+$row['bookingFeeType']) ?> Euros


                                </p>
                                <button class="btn btn-warning" onclick="modalEditarReservas(<?php echo $row['ID']?>)">Editar Reserva</button>
                            </div>
                          </div>       
                        </div>     
                </div>

                <?php $i++; } ?>
          <?php if ($num_rows_reservas > 5): ?>
            <div id="reservas_items">
              <button class="btn btn-danger pull-right boton_ver_mas btn-lg" onclick="load_reservas(2,<?php echo $num_rows_reservas ?>,'<?php echo $busqueda ?>')">Ver más</button>
          </div> 
          <?php endif ?>
              
      </div>

<?php endif ?> 
