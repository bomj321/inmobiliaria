<?php 

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
$stmt7 = $db->prepare("SELECT MAX(orden) as maxorden FROM image_zonas where ref='$ref'");
$stmt7->execute();
$row7 = $stmt7->fetch(PDO::FETCH_ASSOC);
$orden=$row7['maxorden'];
$orden1=$orden1+1;
if ($tipo=="cancelar"){
$stmt6 = $db->prepare("SELECT * FROM image_zonas where ref='$ref' and orden between '$orden1' and '$orden' ");
$stmt6->setFetchMode(PDO::FETCH_ASSOC);
$stmt6->execute();	
while ($row6 = $stmt6->fetch()){
$orden2=$row6['orden'];
$delete = "DELETE from image_zonas where ref='$ref' and orden='$orden2'";
$stmt44 = $db->prepare("SELECT original,full,medium,small FROM image_zonas WHERE ref='$ref' and orden='$orden2'");
$stmt44->execute();
$row44 = $stmt44->fetch(PDO::FETCH_ASSOC);
$filename2=$row44['original'];
$original=DIR."uploads-zonas/".$filename2;
$full=DIR."uploads-zonas/lg_".$filename2;
$medium=DIR."uploads-zonas/m_".$filename2;
$small=DIR."uploads-zonas/th_".$filename2;
unlink ("../uploads-zonas/$filename2");
unlink ("../uploads-zonas/lg_$filename2");
unlink ("../uploads-zonas/m_$filename2");
unlink ("../uploads-zonas/th_$filename2");
$db->exec($delete);
$orden++;
}
} else if ($tipo=="guardar"){
	if ($ordengallery==""){
		$i=0;
	foreach ($ordenselect2 as $value2){
		
$update23 = "UPDATE image_zonas SET caption='$captionselect2[$i]' where image_zonas.id='$value2'";
$db->exec($update23);	

$i++;
	}
	} 
	else {
	$orden=1;
		
	foreach ($ordenid as $value){
		
$update22 = "UPDATE image_zonas SET orden='$orden' where image_zonas.id='$value'";
$db->exec($update22);	

$orden++;
	}
		
$i=0;
	foreach ($ordenselect2 as $value2){
		
$update23 = "UPDATE image_zonas SET caption='$captionselect2[$i]' where image_zonas.id='$value2'";
$db->exec($update23);	

$i++;
	}		

		 

	
}}

?>