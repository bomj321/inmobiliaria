<?php 
include('../includes/conexion_nueva.php'); 


    $id = $_GET['idpropietario'];

    mysqli_set_charset($connection, "utf8");
    $sql="DELETE FROM owners WHERE ID=?";
    $resultado=mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($resultado, "s",$id);
        $ok=mysqli_stmt_execute($resultado); 
         if ($ok) {
                $mensaje= 'Propietario Eliminado';
                echo json_encode($mensaje);
              }else{
                    $mensaje= 'Error Propietario No Eliminado';
                echo json_encode($mensaje);
              }      
        mysqli_stmt_close($resultado);




?>


