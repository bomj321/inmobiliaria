<?php

include('../includes/conexion_nueva.php');


// ESTABLECER ZONA HORARIA DE ESPAÑA
date_default_timezone_set('Europe/Madrid');
// ESTABLECER ZONA HORARIA DE ESPAÑA


$id_propietario = $_POST['id_propietario'];
$propType = $_POST['propType'];
$active = $_POST['active'];
// $dateAdded                = date("Y-m-d H:i:s");
$add_sessionID = $_POST['add_sessionID'];
$OfficeID = $_POST['OfficeID'];
$EmployeeID = $_POST['EmployeeID'];
$sellerName1 = $_POST['sellerName1'];
$sellerName2 = $_POST['sellerName2'];
$nombrecompleto = $sellerName1 . " " . $sellerName2;
$sellerContact = $_POST['sellerContact'];
$sellerNationality = $_POST['sellerNationality'];
$population = $_POST['population'];
$postal_code = $_POST['postal_code'];
$sellerLang = $_POST['sellerLang'];
$sellerAddress = $_POST['sellerAddress'];
$sellerTel = $_POST['sellerTel'];
$sellerMob = $_POST['sellerMob'];
$sellerFax = $_POST['sellerFax'];
$sellerEmail = $_POST['sellerEmail'];
$sellerDNI = $_POST['sellerDNI'];
$comment = $_POST['comment'];
$SSMA_TimeStamp = $_POST['SSMA_TimeStamp'];

//20 datos a actualizar

mysqli_set_charset($connection, "utf8");
$sql = "UPDATE owners SET propType=?, active= ?, add_sessionID= ?, OfficeID= ?, EmployeeID= ?, sellerName1= ?,sellerContact= ?, sellerNationality=?, sellerLang=?,sellerAddress=?,sellerTel=?,sellerMob=?,sellerFax=?,sellerEmail=?,sellerDNI=?,comment=?,postal_code=?,population=?,SSMA_TimeStamp=? WHERE ID=?";
$resultado = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($resultado, "ssssssssssssssssssss", $propType, $active, $add_sessionID, $OfficeID, $EmployeeID, $nombrecompleto, $sellerContact, $sellerNationality, $sellerLang, $sellerAddress, $sellerTel, $sellerMob, $sellerFax, $sellerEmail, $sellerDNI,$comment,$postal_code,$population,$SSMA_TimeStamp, $id_propietario);
$ok = mysqli_stmt_execute($resultado);
if ($ok) {
    $mensaje = 'Propietario Actualizado';
    echo json_encode($mensaje);
} else {
    $mensaje = ' Error Propietario No Actualizado';
    echo json_encode($mensaje);
}
mysqli_stmt_close($resultado);
?>


