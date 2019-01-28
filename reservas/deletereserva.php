<?php 
//include('../includes/conexion_nueva.php'); 
include('../includes/conexion_nueva_rental.php'); 

    $id = $_GET['idreserva'];

    mysqli_set_charset($connection, "utf8");
    $sql="DELETE FROM rental_enquiries WHERE ID=?";
    $resultado=mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($resultado, "s",$id);
    mysqli_stmt_execute($resultado);            
        mysqli_stmt_close($resultado);




?>


