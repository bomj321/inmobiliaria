<?php 
include('../includes/conexion_nueva.php'); 

    $id = $_GET['idcliente'];

    mysqli_set_charset($connection, "utf8");
    $sql="DELETE FROM clients WHERE ID=?";
    $resultado=mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($resultado, "s",$id);
        $ok=mysqli_stmt_execute($resultado); 
         if ($ok) {
                $mensaje= 'Cliente Eliminado';
                echo json_encode($mensaje);
              }else{
                    $mensaje= 'Error Cliente No Eliminado';
                echo json_encode($mensaje);
              }      
        mysqli_stmt_close($resultado);




?>


