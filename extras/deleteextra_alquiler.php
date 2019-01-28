<?php 
 include('../includes/conexion_nueva.php'); 


    $id = $_GET['idextra'];

    mysqli_set_charset($connection, "utf8");
    $sql="DELETE FROM extras_alquileres WHERE id_extra=?";
    $resultado=mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($resultado, "i",$id);
    mysqli_stmt_execute($resultado);          
    mysqli_stmt_close($resultado);




?>


