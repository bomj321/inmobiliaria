<?php 
 include('../includes/conexion_nueva.php'); 


// ESTABLECER ZONA HORARIA DE ESPAÑA
date_default_timezone_set('Europe/Madrid');
// ESTABLECER ZONA HORARIA DE ESPAÑA


   
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
                

//20 datos a insertar

                //////////////////////INSERT USUARIO
            mysqli_set_charset($connection, "utf8");
            $sql_extra="INSERT INTO extras_alquileres (name_es,name_en,name_de,des_es,des_en,des_de,activacion,aplica,cantidad_ocupantes,temporadas,start_temporada,end_temporada,cantidad,max_cantidad,precio_incluido,a_que_precio,iva,cuando_se_paga,que_dia_aplica,proveedores) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado_extra=mysqli_prepare($connection, $sql_extra);
           	mysqli_stmt_bind_param($resultado_extra, "ssssssssssssssssssss",$name_es,$name_en,$name_de,$des_es,$des_en,$des_de,$activacion,$aplica,$cantidad_ocupantes,$temporadas,$start_temporada,$end_temporada,$cantidad,$max_cantidad,$precio_incluido,$a_que_precio,$iva,$cuando_se_paga,$que_dia_aplica,$proveedores);
            mysqli_stmt_execute($resultado_extra);
            mysqli_stmt_close($resultado_extra);
            

//////////////////////INSERT USUARIO CIERRO
mysqli_close($connection)

?>


