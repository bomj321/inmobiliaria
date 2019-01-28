<?php 
include('../includes/conexion_nueva.php'); 


    $id = $_GET['idservicio'];

    mysqli_set_charset($connection, "utf8");
    $sql="DELETE FROM services WHERE id_services=?";
    $resultado=mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($resultado, "s",$id);
        $ok=mysqli_stmt_execute($resultado); 
         if ($ok) {
                $mensaje= 'Servicio Eliminado';
                echo json_encode($mensaje);
              }else{
                    $mensaje= 'Error Servicio No Eliminado';
                echo json_encode($mensaje);
              }      
        mysqli_stmt_close($resultado);




?>


