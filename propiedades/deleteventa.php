<?php 
include('../includes/conexion_nueva.php'); 


    $id = $_GET['idventa'];

    mysqli_set_charset($connection, "utf8");
    $sql="DELETE FROM properties WHERE ID=?";
    $resultado=mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($resultado, "s",$id);
        mysqli_stmt_execute($resultado);          
        mysqli_stmt_close($resultado);




?>


