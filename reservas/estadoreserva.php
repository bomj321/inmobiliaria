<?php 
include('../includes/conexion_nueva.php'); 
//include('../includes/conexion_nueva_rental.php'); 



                $estado_final         = $_GET['estado_final'];
                $id_reserva           = $_GET['id_reserva'];
			  	

//9 datos a actualizar

                mysqli_set_charset($connection, "utf8");
                $sql="UPDATE rental_enquiries SET tipo_reserva=?  WHERE ID=?";
                $resultado=mysqli_prepare($connection, $sql);
                mysqli_stmt_bind_param($resultado, "ss",$estado_final,$id_reserva);
                mysqli_stmt_execute($resultado);                 
                mysqli_stmt_close($resultado);




?>


