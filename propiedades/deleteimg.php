<?php 
require('../includes/config2.php'); 

$ref3=$_POST["ref"];
$refid=$_POST["refid"];
$orden2=$_POST["orden"];
$tipo=$_POST["tipo"];
$delete = "DELETE from image_properties where id='$refid' and orden='$orden2'";
$stmt44 = $db->prepare("SELECT original,full,medium,small FROM image_properties WHERE id='$refid' and orden='$orden2'");
$stmt44->execute();
$row44 = $stmt44->fetch(PDO::FETCH_ASSOC);
$filename2=$row44['original'];
$original="../../uploads/".$filename2;
$full="../../uploads/lg_".$filename2;
$medium="../../uploads/m_".$filename2;
$small="../../uploads/th_".$filename2;
$filename_original = $_SERVER["DOCUMENT_ROOT"] . '/uploads/'.$filename2;
$filename_full     = $_SERVER["DOCUMENT_ROOT"] . '/uploads/lg_'.$filename2;
$filename_medium   = $_SERVER["DOCUMENT_ROOT"] . '/uploads/m_'.$filename2;
$filename_small    = $_SERVER["DOCUMENT_ROOT"] . '/uploads/th_'.$filename2;



unlink ($filename_original);
unlink ($filename_full);
unlink ($filename_medium);
unlink ($filename_small);
$db->exec($delete);
$stmt6666 = $db->prepare("SELECT * FROM image_properties where  ref='$ref3' order by orden asc");
$stmt6666->setFetchMode(PDO::FETCH_ASSOC);
$stmt6666->execute();	
$orden666=1;
while ($row6666 = $stmt6666->fetch()){
$value666=$row6666['id'];
$update226 = "UPDATE image_properties SET orden='$orden666' where image_properties.id='$value666'";
$db->exec($update226);	
$orden666++;	
}	
?>