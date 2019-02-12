<?php
$page = $_GET['p'];
$start = ($page-1)*10;
$busqueda = $_GET['busqueda'];
require('../includes/config2.php'); 
require_once('query_venta.php');

/*DETERMINAR SI EXISTEN FILAS*/

$stmt = $db->prepare("SELECT distinct properties.yourRef,properties.sellerID,properties.propTown,properties.propLocation,properties.propNameES,properties.propType,properties.propPrice,properties.ID,properties.active,image_properties.medium as imagengrande,image_properties.small as imagenpequena,owners.sellerName1 as nombrevendedor FROM properties  LEFT JOIN owners ON properties.sellerID = owners.ID LEFT JOIN image_properties ON (image_properties.ref = properties.ID AND image_properties.orden = 1) WHERE " . $queryCondition . "");

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$num_rows = $stmt->rowCount();

/*DETERMINAR SI EXISTEN FILAS*/

$arr = array();
    
if($num_rows > 0){

			$stmt = $db->prepare("SELECT distinct properties.yourRef,properties.sellerID,properties.propTown,properties.propLocation,properties.propNameES,properties.propType,properties.propPrice,properties.ID,properties.active,image_properties.medium as imagengrande,image_properties.small as imagenpequena,owners.sellerName1 as nombrevendedor FROM properties  LEFT JOIN owners ON properties.sellerID = owners.ID LEFT JOIN image_properties ON (image_properties.ref = properties.ID AND image_properties.orden = 1) WHERE " . $queryCondition . " ORDER BY ID limit 0, 5");
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();
			while ($row = $stmt->fetch()){
						$arr[] = array( 
							"cliente_id"       => $row['ID'],
							"cliente_tipo"     => $row['clientType'],
				            "cliente_fecha"    => $row['dateAdded'],
							"cliente_nombre"   => $row['clientName'],
							"cliente_email"    => $row['clientEmail'],
							"cliente_cellp"    => $row['clientTel1'],
					);

			}
	echo ''. json_encode($arr) .'';

}
	
?>