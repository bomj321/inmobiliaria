<?php 
 include('../includes/conexion_nueva.php'); 


// ESTABLECER ZONA HORARIA DE ESPAÑA
date_default_timezone_set('Europe/Madrid');
// ESTABLECER ZONA HORARIA DE ESPAÑA


                $id_extra                           = $_POST['id_extra'];
			  	$name_es                            = $_POST['name_es'];
                $name_en                            = $_POST['name_en'];
                $name_de                            = $_POST['name_de'];
                $des_es                             = $_POST['des_es'];
                $des_en                             = $_POST['des_en'];                   
                $des_de                             = $_POST['des_de'];


                $activacion                         = $_POST['activacion'];
                $aplica                             = $_POST['aplica'];

                $cantidad_ocupantes_1               = $_POST['cantidad_ocupantes_1'];
                $cantidad_ocupantes_2               = $_POST['cantidad_ocupantes_2'];
                $cantidad_ocupantes                 = $cantidad_ocupantes_1.'-'.$cantidad_ocupantes_2;

                $temporadas                         = $_POST['temporadas'];
                $start_temporada                    = $_POST['start_temporada'];
                $end_temporada                      = $_POST['end_temporada'];


                $cantidad                           = $_POST['cantidad'];
                $max_cantidad                       = $_POST['max_cantidad'];


                $precio_incluido                    = $_POST['precio_incluido'];
                $a_que_precio_1                     = $_POST['a_que_precio_1'];
                $a_que_precio_2                     = $_POST['a_que_precio_2'];
                $a_que_precio                       = $a_que_precio_1.'-'.$a_que_precio_2;


                $iva                                = $_POST['iva'];
                $cuando_se_paga                     = $_POST['cuando_se_paga'];
                $que_dia_aplica                     = $_POST['que_dia_aplica'];
                $proveedores                        = $_POST['proveedores'];

//21 datos a actualizar

                mysqli_set_charset($connection, "utf8");
    $sql="UPDATE extras_alquileres SET name_es=?, name_en= ?, name_de= ?, des_es= ?, des_en= ?, des_de= ?, activacion= ?, aplica= ?,cantidad_ocupantes= ?, temporadas=?, start_temporada=?,end_temporada=?,cantidad=?,max_cantidad=?,precio_incluido=?,a_que_precio=?,iva=?,cuando_se_paga=?,que_dia_aplica=?,proveedores=? WHERE id_extra=?";
    $resultado=mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($resultado, "sssssssssssssssssssss",$name_es,$name_en,$name_de,$des_es,$des_en,$des_de,$activacion,$aplica,$cantidad_ocupantes,$temporadas,$start_temporada,$end_temporada,$cantidad,$max_cantidad,$precio_incluido,$a_que_precio,$iva,$cuando_se_paga,$que_dia_aplica,$proveedores,$id_extra);
        mysqli_stmt_execute($resultado);            
        mysqli_stmt_close($resultado);




?>


