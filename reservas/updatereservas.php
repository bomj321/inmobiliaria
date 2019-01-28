<?php
//include('../includes/conexion_nueva.php'); 
include('../includes/conexion_nueva_rental.php'); 

// ESTABLECER ZONA HORARIA DE ESPAÑA
date_default_timezone_set('Europe/Madrid');
// ESTABLECER ZONA HORARIA DE ESPAÑA


                $id_reserva                 = $_POST['id_reserva'];

	        $id_cliente                 = $_POST['id_cliente'];
                $id_propiedad               = $_POST['id_propiedad'];
                $tipo_reserva               = $_POST['tipo_reserva'];
                $touroperador               = $_POST['touroperador'];
                $fecha_entrada              = $_POST['fecha_entrada'];
                $fecha_salida               = $_POST['fecha_salida'];
                $fecha_reserva              = $_POST['fecha_reserva'];
                $adults                     = $_POST['adults'];
                $childrens                  = $_POST['childrens'];
                $age_childrens              = $_POST['age_childrens'];

                $bookingCot                 = $_POST['bookingCot'];
                $bookingComm                = $_POST['bookingComm'];
                $bookingFeeType             = $_POST['bookingFeeType'];
                $bookingDeposit             = $_POST['bookingDeposit'];
                $bookingOutstanding         = $_POST['bookingOutstanding'];

                $bookingOwnerFee            = $_POST['bookingOwnerFee'];
                $bookingCharges             = $_POST['bookingCharges'];


                $info_entrada_salida        = $_POST['info_entrada_salida'];
                $comentarios                = $_POST['enquiryComments'];
                $bookingNotesPrivate        = $_POST['bookingNotesPrivate'];

//21 datos a actualizar


                mysqli_set_charset($connection, "utf8");
                $sql="UPDATE rental_enquiries SET ClientID=?, PropID= ?,bookingNotes=?, enquiryStart= ?, enquiryEnd= ?, dateAdded= ?,bookingComm= ?,bookingAdults= ?,bookingChildren= ?,bookingChildAges= ?,bookingCot= ?,bookingFeeType= ?,bookingDeposit= ?,bookingOutstanding= ?,bookingOwnerFee= ?,bookingCharges= ?,enquiryComments= ?,touroperador= ?,bookingNotesPrivate= ?,info_entrada_salida=?  WHERE ID=?";
                $resultado=mysqli_prepare($connection, $sql);
                mysqli_stmt_bind_param($resultado, "sssssssssssssssssssss",$id_cliente,$id_propiedad,$tipo_reserva,$fecha_entrada,$fecha_salida,$fecha_reserva,$bookingComm,$adults,$childrens,$age_childrens,$bookingCot,$bookingFeeType,$bookingDeposit,$bookingOutstanding,$bookingOwnerFee,$bookingCharges,$comentarios,$touroperador,$bookingNotesPrivate,$info_entrada_salida,$id_reserva);
                mysqli_stmt_execute($resultado);
                mysqli_stmt_close($resultado);




?>
