<?php 
include('../includes/conexion_nueva.php'); 


    $idservice =$_GET['idservice'];
    $active =$_GET['active'];
	mysqli_set_charset($connection, "utf8");
    $sql="UPDATE services SET published=?  WHERE id_services=?";
    $resultado=mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($resultado, "ss", $active, $idservice);
   $ok= mysqli_stmt_execute($resultado);       
    mysqli_stmt_close($resultado);	
    
 ?>