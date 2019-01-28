<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('../includes/config2.php'); 
$orden1=$_POST["orden1"];
$ref=$_POST["ref"];
$tipo=$_POST["tipo"];
$ordengallery=$_POST["ordengallery"];
$ordenid=$_POST["ordenid"];
$ordenselect=$_POST["ordenselect"];
$captionselect=$_POST["captionselect"];
$ordenselect2=explode(',',$ordenselect);
$captionselect2=explode(',',$captionselect);
$ordengallery2=explode(',',$ordengallery);
$ordenid=explode(',',$ordenid);
$stmt7 = $db->prepare("SELECT MAX(orden) as maxorden FROM image_properties_rentals where ref='$ref'");
$stmt7->execute();
$row7 = $stmt7->fetch(PDO::FETCH_ASSOC);
$orden=$row7['maxorden'];
$orden1=$orden1+1;
if ($tipo=="cancelar"){
$stmt6 = $db->prepare("SELECT * FROM image_properties_rentals where ref='$ref' and orden between '$orden1' and '$orden' ");
$stmt6->setFetchMode(PDO::FETCH_ASSOC);
$stmt6->execute();	
while ($row6 = $stmt6->fetch()){
$orden2=$row6['orden'];
$delete = "DELETE from image_properties_rentals where ref='$ref' and orden='$orden2'";
$stmt44 = $db->prepare("SELECT original,full,medium,small FROM image_properties_rentals WHERE ref='$ref' and orden='$orden2'");
$stmt44->execute();
$row44 = $stmt44->fetch(PDO::FETCH_ASSOC);
$filename2=$row44['original'];
$original="http://www.webstyledns.com/uploads/".$filename2;
$full="http://www.webstyledns.com/uploads/lg_".$filename2;
$medium="http://www.webstyledns.com/uploads/m_".$filename2;
$small="http://www.webstyledns.com/uploads/th_".$filename2;
unlink ("../../uploads/$filename2");
unlink ("../../uploads/lg_$filename2");
unlink ("../../uploads/m_$filename2");
unlink ("../../uploads/th_$filename2");
$db->exec($delete);
$orden++;
}
} else if ($tipo=="guardar"){
	if ($ordengallery==""){
		$i=0;
	foreach ($ordenselect2 as $value2){
		
$update23 = "UPDATE image_properties_rentals SET caption='$captionselect2[$i]' where image_properties_rentals.id='$value2'";
$db->exec($update23);	

$i++;
	}
	} 
	else {
	$orden=1;
		
	foreach ($ordenid as $value){
		
$update22 = "UPDATE image_properties_rentals SET orden='$orden' where image_properties_rentals.id='$value'";
$db->exec($update22);	

$orden++;
	}
		
$i=0;
	foreach ($ordenselect2 as $value2){
		
$update23 = "UPDATE image_properties_rentals SET caption='$captionselect2[$i]' where image_properties_rentals.id='$value2'";
$db->exec($update23);	

$i++;
	}		

		 

	
}}

?>