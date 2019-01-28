<?php require('../includes/config2.php');
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>
<p>Creando array de localidades para cada población</p>
<?php 
$stmt = $db->prepare("SELECT distinct Town FROM sys_towns where Location='0' order by Town ASC");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();$num=0;
while ($row = $stmt->fetch()){
$town1=$row['Town'];

$stmt699 = $db->prepare("SELECT distinct Location FROM sys_towns where Town='$town1' order by Town ASC");
$stmt699->setFetchMode(PDO::FETCH_ASSOC);
$stmt699->execute();
	$arraylocalidad1=array();
while ($row699 = $stmt699->fetch()){?>	

<?php $localidad=strtolower($row699['Location']);
									
   
?>
<?php if ($localidad!="0") {
    array_push($arraylocalidad1, $localidad);
	   
	  
   }
	
 }
$arraylocalidad = implode(",",$arraylocalidad1);
$arraylocalidad=addslashes($arraylocalidad);
	 var_dump($arraylocalidad);
    $zona111 = "UPDATE sys_towns SET  localidades_asociadas='$arraylocalidad' where sys_towns.Town='$town1' and sys_towns.Location='0'";
$db->exec($zona111);
	
?>



							 <?php }?>
