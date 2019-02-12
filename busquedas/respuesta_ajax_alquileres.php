<?php
$page = $_GET['p'];
$start = ($page-1)*10;
$busqueda = $_GET['busqueda'];
require('../includes/config2.php'); 
require_once('query_alquiler.php');

/*DETERMINAR SI EXISTEN FILAS*/

$stmt = $db->prepare("SELECT rentals.yourRef,rentals.sellerID,rentals.propTown,rentals.propLocation,rentals.propNameES,rentals.propType,rentals.propPrice,rentals.ID,rentals.active,image_properties_rentals.full as imagengrande,image_properties_rentals.small as imagenpequena,owners.sellerName1 as nombrevendedor FROM rentals  LEFT  JOIN owners ON rentals.sellerID = owners.ID LEFT  JOIN image_properties_rentals ON (image_properties_rentals.ref = rentals.ID AND image_properties_rentals.orden = 1) WHERE " . $queryCondition_alquiler . "");

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$num_rows = $stmt->rowCount();

/*DETERMINAR SI EXISTEN FILAS*/

$arr = array();
    
if($num_rows > 0){

			$stmt = $db->prepare("SELECT rentals.yourRef,rentals.sellerID,rentals.propTown,rentals.propLocation,rentals.propNameES,rentals.propType,rentals.propPrice,rentals.ID,rentals.active,image_properties_rentals.full as imagengrande,image_properties_rentals.small as imagenpequena,owners.sellerName1 as nombrevendedor FROM rentals  LEFT  JOIN owners ON rentals.sellerID = owners.ID LEFT  JOIN image_properties_rentals ON (image_properties_rentals.ref = rentals.ID AND image_properties_rentals.orden = 1) WHERE " . $queryCondition_alquiler . " ORDER BY ID limit $start, 5");
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();
			$i= 1;
			while ($row = $stmt->fetch()){
					require_once('condicional_query_alquiler.php');
						$arr[] = array( 
							"alquiler_id"         => $row['ID'],
							"alquiler_name"       => $row['propNameES'],
							"alquiler_foto"       => $imagen_foto,
							"alquiler_img_grande" => $row['imagengrande'],
							"alquiler_img_chica"  => $row['imagenpequena'],
							"alquiler_active"     => $activo,
							"alquiler_ref"        => $row['yourRef'],
							"alquiler_casa_tipo"  => $tipo_de_casa,
							"alquiler_cliente"    => $row['nombrevendedor'],
							"alquiler_vendedor"   => $row['sellerID'],
							"alquiler_poblacion"  => $location,
							"alquiler_precio"     => $precio,
							"alquiler_titulo"     => $title2,

				            
					);
			$i++;			

			}
	echo ''. json_encode($arr) .'';

}
	
?>