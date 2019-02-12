<?php 


/*ALQUILERES*/

	require_once('query_alquiler.php');
	$stmt_alquiler = $db->prepare("SELECT rentals.yourRef,rentals.sellerID,rentals.propTown,rentals.propLocation,rentals.propNameES,rentals.propType,rentals.propPrice,rentals.ID,rentals.active,image_properties_rentals.full as imagengrande,image_properties_rentals.small as imagenpequena,owners.sellerName1 as nombrevendedor FROM rentals  LEFT  JOIN owners ON rentals.sellerID = owners.ID LEFT  JOIN image_properties_rentals ON (image_properties_rentals.ref = rentals.ID AND image_properties_rentals.orden = 1) WHERE " . $queryCondition_alquiler . "");
	$stmt_alquiler->setFetchMode(PDO::FETCH_ASSOC);
	$stmt_alquiler->execute();
	$num_rows_alquiler = $stmt_alquiler->rowCount();

/*ALQUILERES*/



/*CLIENTES*/
	

	require_once('query_cliente.php');
	$stmt_cliente = $db->prepare("SELECT ID ,clientType, dateAdded, clientName, clientEmail,clientTel1  FROM clients WHERE " . $queryCondition_cliente . "");
	$stmt_cliente->setFetchMode(PDO::FETCH_ASSOC);
	$stmt_cliente->execute();
	$num_rows_cliente = $stmt_cliente->rowCount();

/*CLIENTES*/


/*PROPIETARIOS*/
	require_once('query_propietario.php');

	$stmt_owners = $db->prepare("SELECT ID ,propType, dateAdded, sellerName1, sellerEmail,sellerTel  FROM owners WHERE " . $queryCondition_propietario . " ORDER BY ID");

	$stmt_owners->setFetchMode(PDO::FETCH_ASSOC);
	$stmt_owners->execute();
	$num_rows_owners = $stmt_owners->rowCount();
/*PROPIETARIOS*/

/*RESERVAS*/
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
/*RESERVAS*/

/*VENTAS*/
	require_once('query_venta.php');

$stmt = $db->prepare("SELECT distinct properties.yourRef,properties.sellerID,properties.propTown,properties.propLocation,properties.propNameES,properties.propType,properties.propPrice,properties.ID,properties.active,image_properties.medium as imagengrande,image_properties.small as imagenpequena,owners.sellerName1 as nombrevendedor FROM properties  LEFT JOIN owners ON properties.sellerID = owners.ID LEFT JOIN image_properties ON (image_properties.ref = properties.ID AND image_properties.orden = 1) WHERE " . $queryCondition_venta . "");

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$num_rows = $stmt->rowCount();
/*VENTAS*/

if ($num_rows>$num_rows_reservas) {
	 require_once('clientes.php');
     require_once('propietarios.php');
     require_once('reservas.php');
     require_once('ventas.php');
     require_once('alquileres.php');
}else{
	 require_once('clientes.php');
     require_once('propietarios.php');
     require_once('reservas.php');
     require_once('ventas.php');
     require_once('alquileres.php');
}

 ?>