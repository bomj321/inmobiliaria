<?php
include('../includes/conexion_nueva.php');

    $idventa =$_GET['idventa'];
    $active =$_GET['active'];
	mysqli_set_charset($connection, "utf8");
    $sql="UPDATE rentals SET active=?  WHERE ID=?";
    $resultado=mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($resultado, "ss", $active, $idventa);
    mysqli_stmt_execute($resultado);
    mysqli_stmt_close($resultado);



 ?>
