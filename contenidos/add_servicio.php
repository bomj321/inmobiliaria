<?php 
include('../includes/conexion_nueva.php'); 


// ESTABLECER ZONA HORARIA DE ESPAÑA
date_default_timezone_set('Europe/Madrid');
// ESTABLECER ZONA HORARIA DE ESPAÑA


   
			  	$published                 = 1;               
                $tit_es                    = $_POST['tit_es'];
                $tit_en                    = $_POST['tit_en'];
                $tit_de                    = $_POST['tit_de'];                   
                $seo_es                    = $_POST['seo_es'];
                $seo_en                    = $_POST['seo_en'];
                $seo_de                    = $_POST['seo_de'];
                $des_es                    = $_POST['des_es'];
     			$des_en                    = $_POST['des_en'];
                $des_de                    = $_POST['des_de'];
                $date_published            = date("d-m-Y");
               
               
//11 datos a insertar

                //////////////////////INSERT USUARIO
            mysqli_set_charset($connection, "utf8");
            $sql_service="INSERT INTO services (published,tit_es,tit_en,tit_de,seo_es,seo_en,seo_de,des_es,des_en,des_de,date_published) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $resultado_service=mysqli_prepare($connection, $sql_service);
           	mysqli_stmt_bind_param($resultado_service, "sssssssssss",$published,$tit_es,$tit_en,$tit_de,$seo_es,$seo_en,$seo_de,$des_es,$des_en,$des_de,$date_published);
            mysqli_stmt_execute($resultado_service);
            mysqli_stmt_close($resultado_service);            

//////////////////////INSERT USUARIO CIERRO
mysqli_close($connection)

?>


