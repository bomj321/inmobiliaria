<?php
$page = $_GET['p'];
$start = ($page-1)*10;
$busqueda = $_GET['busqueda'];
require('../includes/config2.php'); 
require_once('query_cliente.php');

/*DETERMINAR SI EXISTEN FILAS*/

$stmt = $db->prepare("SELECT ID ,clientType, dateAdded, clientName, clientEmail,clientTel1  FROM clients WHERE " . $queryCondition_cliente . "");

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$num_rows = $stmt->rowCount();

/*DETERMINAR SI EXISTEN FILAS*/

$arr = array();
    
if($num_rows > 0){

			$stmt = $db->prepare("SELECT ID ,clientType, dateAdded, clientName, clientEmail,clientTel1  FROM clients WHERE " . $queryCondition_cliente . " ORDER BY ID limit $start, 5");
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