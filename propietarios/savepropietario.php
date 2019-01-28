<?php

include('../includes/conexion_nueva.php');


// ESTABLECER ZONA HORARIA DE ESPAÑA
date_default_timezone_set('Europe/Madrid');
// ESTABLECER ZONA HORARIA DE ESPAÑA



$propType = $_POST['propType'];
$active = $_POST['active'];
$dateAdded = date("Y-m-d H:i:s");
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

//20 datos a insertar
//////////////////////INSERT USUARIO
mysqli_set_charset($connection, "utf8");
$sql_client = "INSERT INTO owners (propType,active,dateAdded,add_sessionID,OfficeID,EmployeeID,sellerName1,sellerContact,sellerNationality,sellerLang,sellerAddress,sellerTel,sellerMob,sellerFax,sellerEmail,sellerDNI,comment,postal_code,population,SSMA_TimeStamp) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado_client = mysqli_prepare($connection, $sql_client);
mysqli_stmt_bind_param($resultado_client, "ssssssssssssssssssss", $propType, $active, $dateAdded, $add_sessionID, $OfficeID, $EmployeeID, $nombrecompleto, $sellerContact, $sellerNationality, $sellerLang, $sellerAddress, $sellerTel, $sellerMob, $sellerFax, $sellerEmail, $sellerDNI,$comment,$postal_code,$population,$SSMA_TimeStamp);
mysqli_stmt_execute($resultado_client);
mysqli_stmt_close($resultado_client);

//////////////////////INSERT USUARIO CIERRO
mysqli_close($connection)
?>


