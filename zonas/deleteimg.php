<?php 
require('../includes/config2.php'); 

$ref3=$_POST["ref"];
$orden2=$_POST["orden"];
$tipo=$_POST["tipo"];
$delete = "DELETE from image_zonas where ref='$ref3' and orden='$orden2'";
$stmt44 = $db->prepare("SELECT original,full,medium,small FROM image_zonas WHERE ref='$ref3' and orden='$orden2'");
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
$stmt6666 = $db->prepare("SELECT * FROM image_zonas where ref='$ref3' order by orden asc");
$stmt6666->setFetchMode(PDO::FETCH_ASSOC);
$stmt6666->execute();	
$orden666=1;
while ($row6666 = $stmt6666->fetch()){
$value666=$row6666['id'];
$update226 = "UPDATE image_zonas SET orden='$orden666' where image_zonas.id='$value666'";
$db->exec($update226);	
$orden666++;	
}	
?>