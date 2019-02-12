<?php
$page = $_GET['p'];
$start = ($page-1)*10;
$busqueda = $_GET['busqueda'];
require('../includes/config2.php'); 
require_once('query_propietario.php');

/*DETERMINAR SI EXISTEN FILAS*/

$stmt = $db->prepare("SELECT ID ,propType, dateAdded, sellerName1, sellerEmail,sellerTel  FROM owners WHERE " . $queryCondition . "");

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$num_rows = $stmt->rowCount();

/*DETERMINAR SI EXISTEN FILAS*/

$arr = array();
    
if($num_rows > 0){

			$stmt = $db->prepare("SELECT ID ,propType, dateAdded, sellerName1, sellerEmail,sellerTel  FROM owners WHERE " . $queryCondition . " ORDER BY ID limit $start, 5");
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();
			while ($row = $stmt->fetch()){
						$arr[] = array( 
							"propietario_id"       => $row['ID'],
							"propietario_tipo"     => $row['propType'],
				            "propietario_fecha"    => $row['dateAdded'],
							"propietario_nombre"   => $row['sellerName1'],
							"propietario_email"    => $row['sellerEmail'],
							"propietario_cellp"    => $row['sellerTel'],
					);

			}
	echo ''. json_encode($arr) .'';

}
	
?>