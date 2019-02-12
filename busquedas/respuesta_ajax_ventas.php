<?php
$page = $_GET['p'];
$start = ($page-1)*5;
$busqueda = $_GET['busqueda'];
require('../includes/config2.php'); 
require_once('query_venta.php');

/*DETERMINAR SI EXISTEN FILAS*/

$stmt = $db->prepare("SELECT distinct properties.yourRef,properties.sellerID,properties.propTown,properties.propLocation,properties.propNameES,properties.propType,properties.propPrice,properties.ID,properties.active,image_properties.medium as imagengrande,image_properties.small as imagenpequena,owners.sellerName1 as nombrevendedor FROM properties  LEFT JOIN owners ON properties.sellerID = owners.ID LEFT JOIN image_properties ON (image_properties.ref = properties.ID AND image_properties.orden = 1) WHERE " . $queryCondition_venta . "");

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$num_rows = $stmt->rowCount();

/*DETERMINAR SI EXISTEN FILAS*/

$arr = array();
    
if($num_rows > 0){

			$stmt = $db->prepare("SELECT distinct properties.yourRef,properties.sellerID,properties.propTown,properties.propLocation,properties.propNameES,properties.propType,properties.propPrice,properties.ID,properties.active,image_properties.medium as imagengrande,image_properties.small as imagenpequena,owners.sellerName1 as nombrevendedor FROM properties  LEFT JOIN owners ON properties.sellerID = owners.ID LEFT JOIN image_properties ON (image_properties.ref = properties.ID AND image_properties.orden = 1) WHERE " . $queryCondition_venta . " ORDER BY ID limit $start, 5");
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();
			$i= 1;
			while ($row = $stmt->fetch()){
					require_once('condicional_query_venta.php');
						$arr[] = array( 
							"venta_id"         => $row['ID'],
							"venta_name"       => $row['propNameES'],
							"venta_foto"       => $imagen_foto,
							"venta_img_grande" => $row['imagengrande'],
							"venta_img_chica"  => $row['imagenpequena'],
							"venta_active"     => $activo,
							"venta_ref"        => $row['yourRef'],
							"venta_casa_tipo"  => $tipo_de_casa,
							"venta_cliente"    => $row['nombrevendedor'],
							"venta_vendedor"   => $row['sellerID'],
							"venta_poblacion"  => $location,
							"venta_precio"     => $precio,
							"venta_titulo"     => $title2,

				            
					);
			$i++;			

			}
	echo ''. json_encode($arr) .'';

}
	
?>