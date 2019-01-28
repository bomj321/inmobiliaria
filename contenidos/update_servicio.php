<?php 
include('../includes/conexion_nueva.php'); 


// ESTABLECER ZONA HORARIA DE ESPAÑA
date_default_timezone_set('Europe/Madrid');
// ESTABLECER ZONA HORARIA DE ESPAÑA

                $id_services               = $_POST['id_services'];
                $tit_es                    = $_POST['tit_es'];
                $tit_en                    = $_POST['tit_en'];
                $tit_de                    = $_POST['tit_de'];                   
                $seo_es                    = $_POST['seo_es'];
                $seo_en                    = $_POST['seo_en'];
                $seo_de                    = $_POST['seo_de'];
                $des_es                    = $_POST['des_es'];
                $des_en                    = $_POST['des_en'];
                $des_de                    = $_POST['des_de'];

//10 datos a actualizar

                mysqli_set_charset($connection, "utf8");
    $sql="UPDATE services SET tit_es=?, tit_en= ?, tit_de= ?, seo_es= ?, seo_en= ?, seo_de= ?, des_es= ?, des_en= ?,des_de= ? WHERE id_services=?";
    $resultado=mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($resultado, "ssssssssss",$tit_es,$tit_en,$tit_de,$seo_es,$seo_en,$seo_de,$des_es,$des_en,$des_de,$id_services);
        mysqli_stmt_execute($resultado);              
        mysqli_stmt_close($resultado);




?>


