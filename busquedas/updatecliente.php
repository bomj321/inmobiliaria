<?php 
include('../includes/conexion_nueva.php'); 


// ESTABLECER ZONA HORARIA DE ESPAÑA
date_default_timezone_set('Europe/Madrid');
// ESTABLECER ZONA HORARIA DE ESPAÑA


             /*VARIABLES*/
$id_cliente            =$_POST['id_cliente'];
$clientName            =$_POST['clientName'];
$pais                  =$_POST['pais'];
$clientLang            =$_POST['clientLang'];


$clientTel1            =$_POST['clientTel1'];
$clientMob             =$_POST['clientMob'];
$clientFax             =$_POST['clientFax'];
$clientEmail           =$_POST['clientEmail'];



$clientAddress         =$_POST['clientAddress'];
$propType              =$_POST['propType'];
$clientIDNum           =$_POST['clientIDNum'];
$OfficeID              =$_POST['OfficeID'];



$EmployeeID            =$_POST['EmployeeID'];


/*VARIABLES*/

//16 datos a actualizar

                mysqli_set_charset($connection, "utf8");
    $sql="UPDATE clients SET clientName=?, pais= ?, clientLang= ?, clientTel1= ?, clientMob= ?, clientFax= ?, clientEmail= ?, clientAddress= ?,propType= ?, clientIDNum=?, OfficeID=?,EmployeeID=? WHERE ID=?";
    $resultado=mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($resultado, "sssssssssssss",$clientName,$pais,$clientLang,$clientTel1,$clientMob,$clientFax,$clientEmail,$clientAddress,$propType,$clientIDNum,$OfficeID,$EmployeeID,$id_cliente);
        mysqli_stmt_execute($resultado);
        mysqli_stmt_close($resultado);




?>


