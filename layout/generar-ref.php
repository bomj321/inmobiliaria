<?php 
require('../includes/config2.php'); 
$accion=$_POST["accionref"];
if ($accion=="venta"){
$ref = $db->prepare("SELECT ID FROM properties ORDER BY ID DESC LIMIT 1");
			   $ref->setFetchMode(PDO::FETCH_ASSOC);
$ref->execute();

while ($row3 = $ref->fetch()){ 
$ref_ok=$row3['ID']+1001;
$ref_ok=$ref_ok."V";
echo $ref_ok;
}	
	
}else if ($accion=="alquiler"){
$ref = $db->prepare("SELECT ID FROM rentals ORDER BY ID DESC LIMIT 1");
			   $ref->setFetchMode(PDO::FETCH_ASSOC);
$ref->execute();

while ($row3 = $ref->fetch()){ 
$ref_ok=$row3['ID']+1001;
$ref_ok=$ref_ok."A";
echo $ref_ok;
}	
	
	
}?>
