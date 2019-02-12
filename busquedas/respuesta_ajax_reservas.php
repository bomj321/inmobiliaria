<?php
$page = $_GET['p'];
$start = ($page-1)*10;
$busqueda = $_GET['busqueda'];


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

/*DETERMINAR SI EXISTEN FILAS*/

$stmt = $db_reservas->prepare("SELECT rental_enquiries.*,rentals.propNameES as NameES,rentals.propType as Type,rentals.propAddress as Address,clients.ClientName as nombrecliente FROM rental_enquiries LEFT JOIN rentals ON rental_enquiries.PropID = rentals.ID LEFT JOIN clients ON rental_enquiries.ClientID = clients.ID WHERE " . $queryCondition . "");

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$num_rows = $stmt->rowCount();

/*DETERMINAR SI EXISTEN FILAS*/

$arr = array();
    
if($num_rows > 0){

			$stmt = $db_reservas->prepare("SELECT rental_enquiries.*,rentals.propNameES as NameES,rentals.propType as Type,rentals.propAddress as Address,clients.ClientName as nombrecliente FROM rental_enquiries LEFT JOIN rentals ON rental_enquiries.PropID = rentals.ID LEFT JOIN clients ON rental_enquiries.ClientID = clients.ID WHERE " . $queryCondition . " ORDER BY ID limit 0, 5");
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();
			require_once('condicional_query_reserva.php');
			while ($row = $stmt->fetch()){
						$arr[] = array( 
							"reserva_id"         =>  $row['ID'],
							"reserva_name"       =>  $nombre_renta,		
							"reserva_fecha"      =>  date_format($date_reserva, 'd-m-Y'),	
							"reserva_cliente"    =>  $row['nombrecliente'],
							"reserva_tipo"       =>  $row['Type'],
							"reserva_entrada"    =>  date_format($date_entrada, 'd-m-Y'),	

							"reserva_tipo_boton" =>  $boton_reserva,	
							"reserva_precio"     =>  $row['bookingComm'],	
							"reserva_owner"      =>  $row['bookingOwnerFee'],	
							"reserva_chargues"   =>  $row['bookingCharges'],	
							"reserva_discount"   =>  $row['bookingFeeType'],	



							"reserva_direccion"  =>  $row['Address'],
							"reserva_adultos"    =>  $row['bookingAdults'],
							"reserva_ninos"      =>  $row['bookingChildren'],
							"reserva_edad"       =>  $row['bookingChildAges'],
							"reserva_notas"      =>  $row['bookingNotesPrivate'],
							"reserva_total"      =>  $total - ($row['bookingOwnerFee'] + $row['bookingCharges']+$row['bookingFeeType']).' Euros',
					);

			}
	echo ''. json_encode($arr) .'';

}
	
?>