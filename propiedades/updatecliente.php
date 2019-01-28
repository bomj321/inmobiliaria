<?php 
include('../includes/conexion_nueva.php'); 


// ESTABLECER ZONA HORARIA DE ESPAÑA
date_default_timezone_set('Europe/Madrid');
// ESTABLECER ZONA HORARIA DE ESPAÑA


             /*VARIABLES*/
$id_cliente              =$_POST['id_cliente'];

$nombre                  =$_POST['nombre'];
$sellerDNI               =$_POST['sellerDNI'];
$sellerNationality       =$_POST['sellerNationality'];


$sellerLang              =$_POST['sellerLang'];
$telefono                =$_POST['telefono'];
$sellerMob               =$_POST['sellerMob'];
$sellerContact           =$_POST['sellerContact'];



$sellerFax               =$_POST['sellerFax'];
$email                   =$_POST['email'];
$sellerAddress           =$_POST['sellerAddress'];
$propType                =$_POST['propType'];



$add_sessionID           =$_POST['add_sessionID'];
$OfficeID                =$_POST['OfficeID'];
$EmployeeID              =$_POST['EmployeeID'];
$SSMA_TimeStamp          =$_POST['SSMA_TimeStamp'];


/*VARIABLES*/

//16 datos a actualizar

                mysqli_set_charset($connection, "utf8");
    $sql="UPDATE owners SET propType=?, add_sessionID= ?, OfficeID= ?, EmployeeID= ?, sellerName1= ?, sellerContact= ?, sellerNationality= ?, sellerLang= ?,sellerAddress= ?, sellerTel=?, sellerMob=?,sellerFax=?,sellerEmail=?,sellerDNI=?,SSMA_TimeStamp=? WHERE ID=?";
    $resultado=mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($resultado, "ssssssssssssssss",$propType,$add_sessionID,$OfficeID,$EmployeeID,$nombre,$sellerContact,$sellerNationality,$sellerLang,$sellerAddress,$telefono,$sellerMob,$sellerFax,$email,$sellerDNI,$SSMA_TimeStamp,$id_cliente);
        mysqli_stmt_execute($resultado);
        mysqli_stmt_close($resultado);




?>


