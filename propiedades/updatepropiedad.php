<?php
include('../includes/conexion_nueva.php'); 

mysqli_set_charset($connection,"utf8");

/*SECCION DETALLES Distribución*/
$habSimple             =$_POST['habSimple'];
$habDoble              =$_POST['habDoble'];
$banos_extra           =$_POST['propBathroom'];
$aseos                 =$_POST['aseos'];

/*SECCION DETALLES Distribución*/

$active         =$_POST['active'];
$id_venta       =$_POST['id_venta'];
$tipoProp       =$_POST['tipoProp'];
$tipoProp2      =$_POST['tipoProp2'];
$estado1        =$_POST['estado1'];
$propietario    =$_POST['propietario'];

/*PARTE DEL MAPA*/
$direccion              =$_POST['direccion'];
$poblacion              =$_POST['poblacion'];
$latitud                =$_POST['latitud'];
$longitud               =$_POST['longitud'];
$zona                   =$_POST['zona'];
$mostrarDireccion       =$_POST['mostrarDireccion'];
if (empty($zona)) {
  $location=$poblacion.":Ninguna";
}else{
  $location=$poblacion.":".$zona;
}
$linkmap=$latitud.",".$longitud;

/*PARTE DEL MAPA*/



/*SECCION DETALLES GENERALES*/
$refVenta        =$_POST['refVenta'];
$precioVenta     =$_POST['precioVenta'];
$clasifEnergia   =$_POST['clasifEnergia'];

/*SECCION DETALLES GENERALES*/



/*SECCION EDITOR*/
$tituloES     =$_POST['tituloES'];
$descripES    =$_POST['descripES'];
$tituloEN     =$_POST['tituloEN'];
$descripEN    =$_POST['descripEN'];
$tituloDE     =$_POST['tituloDE'];
$descripDE    =$_POST['descripDE'];

/*SECCION EDITOR*/



/*SECCION DETALLES Medidas*/
$supUtil       =$_POST['supUtil'];
$supTerraza    =$_POST['supTerraza'];
$supTerreno    =$_POST['supTerreno'];
$supTotal      =$_POST['supTotal'];
/*SECCION DETALLES Medidas*/




/*SECCION DE CHECKBOX*/
$destacada             =$_POST['destacada'];
$lujo                  =$_POST['lujo'];
$nueva                 =$_POST['nueva'];
$portada               =$_POST['portada'];
/*SECCION DE CHECKBOX*/




/*SECCION DE DETALLES ADICIONALES ENTORNO DISTANCIA FALTA< VER TABLA*/
/*
$destacada             =$_POST['destacada'];
$lujo                  =$_POST['lujo'];
$nueva                 =$_POST['nueva'];
$portada               =$_POST['portada'];*/
/*SECCION DE DETALLES ADICIONALES ENTORNO DISTANCIA FALTA< VER TABLA*/

/*SECCION DE NOTAS PRIVADAS*/
$notas              =$_POST['notas'];

/*SECCION DE NOTAS PRIVADAS*/
/*DISTRIBUCION*/
if($_POST['extra1']){
    $dist=$_POST['extra1'];
    $distribucion = implode(",", $dist); 
} else {
  $distribucion=null;
}
$ex1cat=$_POST['extra1Cat'];
/*DISTRIBUCION*/


/*BAÑOS*/
if($_POST['extra2']){
    $ban=$_POST['extra2'];
    $banos = implode(",", $ban); 
} else {
  $banos=null;
}
$ex2cat=$_POST['extra2Cat'];
/*BAÑOS*/


/*ACCESORIOS Y EQUIPAMIENTO*/
if($_POST['extra3']){
    $acc=$_POST['extra3'];
    $accesorios = implode(",", $acc); 
} else {
  $accesorios=null;
}
$ex3cat=$_POST['extra3Cat'];
/*ACCESORIOS Y EQUIPAMIENTO*/

/*JARDIN*/
if($_POST['extra4']){
    $jar=$_POST['extra4'];
    $jardin = implode(",", $jar); 
} else {
  $jardin=null;
}
$ex4cat=$_POST['extra4Cat'];
/*JARDIN*/

/*OTROS*/
if($_POST['extra5']){
    $otr=$_POST['extra5'];
    $otros = implode(",", $otr); 
} else {
  $otros=null;
}
$ex5cat=$_POST['extra5Cat'];
/*OTROS*/


/*DISTANCIAS*/
if($_POST['distancia']){
    $dista=$_POST['distancia'];
    $distancias = implode(",", $dista); 
} else {
  $distancias=null;
}
$idunidad=$_POST['idDist'];
$unidad  =$_POST['unidad'];
/*DISTANCIAS*/


/*ACTUALIZACION 30 DATOS*/

mysqli_set_charset($connection, "utf8");
    $sql="UPDATE properties SET active=?,SellerID=?, propLocation= ?, propStatus= ?, propFeatured= ?, propNameES= ?, propNameEN= ?, propNameDE= ?,propAddress= ?, propLinkMap=?, mostrarDireccion=?,propType=?,propPrice=?,propDescripES=?,propDescripEN=?,propDescripDE=?,propHouseM2=?,propTerraceM2=?,propLandM2=?,propTotalM2=?,propBedSingle=?,propBedDouble=?,propBathroom=?,propToilet=?,esLujo=?,esNueva=?,clasifEnergia=?,slider=?,propNotesPrivate=?  WHERE ID=?";
    $resultado=mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($resultado, "ssssssssssssssssssssssssssssss",$active,$propietario,$location,$estado1,$destacada,$tituloES,$tituloEN,$tituloDE,$direccion,$linkmap,$mostrarDireccion,$tipoProp2,$precioVenta,$descripES,$descripEN,$descripDE,$supUtil,$supTerraza,$supTerreno,$supTotal,$habSimple,$habDoble,$banos_extra,$aseos,$lujo,$nueva,$clasifEnergia,$portada,$notas,$id_venta);
    mysqli_stmt_execute($resultado);       
    mysqli_stmt_close($resultado);

/*BORRAR TODOS LOS REGISTROS PRIMERAMENTE DE AMBAS TABLAS YA QUE NO PUEDO HACER UN UPDATE PORQUE NO EXISTEN NINGUNA RELACION CON LAS TABLAS*/
mysqli_set_charset($connection, "utf8");
$sql_borrar="DELETE FROM extras_assign WHERE idCasa=?";
$resultado_borrar=mysqli_prepare($connection, $sql_borrar);
mysqli_stmt_bind_param($resultado_borrar, "s",$id_venta);
mysqli_stmt_execute($resultado_borrar); 
mysqli_stmt_close($resultado_borrar);

mysqli_set_charset($connection, "utf8");
$sql_borrar_dist="DELETE FROM distancias_assign WHERE idCasa=?";
$resultado_borrar_dist=mysqli_prepare($connection, $sql_borrar_dist);
mysqli_stmt_bind_param($resultado_borrar_dist, "s",$id_venta);
mysqli_stmt_execute($resultado_borrar_dist); 
mysqli_stmt_close($resultado_borrar_dist);
/*BORRAR TODOS LOS REGISTROS PRIMERAMENTE DE AMBAS TABLAS YA QUE NO PUEDO HACER UN UPDATE PORQUE NO EXISTEN NINGUNA RELACION CON LAS TABLAS*/

/*********DISTRIBUCION***********/
        if ($distribucion) {
                            

                $w1=0;
                    foreach ($dist as $extraassign1) {
                        $extraCat1=$ex1cat[$w1];
                        $tipo_1 = 'distribucion';

                        $propertassign1 ="INSERT INTO extras_assign (idCasa,idExtra,extraCat,pertenece) VALUES (?,?,?,?)";

                        $result_assign1=mysqli_prepare($connection, $propertassign1);
                        mysqli_stmt_bind_param($result_assign1, "ssss",$id_venta, $extraassign1,$extraCat1,$tipo_1);
                        mysqli_stmt_execute($result_assign1);
                        mysqli_stmt_close($result_assign1);
                       
                        $w1++;  
                    }
        
        }   
/*********DISTRIBUCION***********/


/*********BAÑOS***********/
        if ($banos) {
                $w2=0;
                    foreach ($ban as $extraassign2) {
                        $extraCat2=$ex2cat[$w2];
                        $tipo_2 = 'banos';

                        $propertassign2 ="INSERT INTO extras_assign (idCasa,idExtra,extraCat,pertenece) VALUES (?,?,?,?)";

                        $result_assign2=mysqli_prepare($connection, $propertassign2);
                        mysqli_stmt_bind_param($result_assign2, "ssss",$id_venta, $extraassign2,$extraCat2,$tipo_2);
                        mysqli_stmt_execute($result_assign2);
                        mysqli_stmt_close($result_assign2);
                       
                        $w2++;  
                    }
        
        }   
/*********BAÑOS***********/


/*********ACCESORIOS Y EQUIPAMIENTO***********/
        if ($accesorios) {
                $w3=0;
                    foreach ($acc as $extraassign3) {
                        $extraCat3=$ex3cat[$w3];
                        $tipo_3 = 'equipamiento';

                        $propertassign3 ="INSERT INTO extras_assign (idCasa,idExtra,extraCat,pertenece) VALUES (?,?,?,?)";

                        $result_assign3=mysqli_prepare($connection, $propertassign3);
                        mysqli_stmt_bind_param($result_assign3, "ssss",$id_venta, $extraassign3,$extraCat3,$tipo_3);
                        mysqli_stmt_execute($result_assign3);
                        mysqli_stmt_close($result_assign3);
                       
                        $w3++;  
                    }
        
        }   
/*********ACCESORIOS Y EQUIPAMIENTO***********/


/*********JARDIN***********/
        if ($jardin) {
                $w4=0;
                    foreach ($jar as $extraassign4) {
                        $extraCat4=$ex4cat[$w4];
                        $tipo_4 = 'jardin';

                        $propertassign4 ="INSERT INTO extras_assign (idCasa,idExtra,extraCat,pertenece) VALUES (?,?,?,?)";

                        $result_assign4=mysqli_prepare($connection, $propertassign4);
                        mysqli_stmt_bind_param($result_assign4, "ssss",$id_venta, $extraassign4,$extraCat4,$tipo_4);
                        mysqli_stmt_execute($result_assign4);
                        mysqli_stmt_close($result_assign4);
                       
                        $w4++;  
                    }
        
        }   
/*********JARDIN***********/


/*********OTROS***********/
        if ($otros) {
                $w5=0;
                    foreach ($otr as $extraassign5) {
                        $extraCat5=$ex5cat[$w5];
                        $tipo_5 = 'otros';

                        $propertassign5 ="INSERT INTO extras_assign (idCasa,idExtra,extraCat,pertenece) VALUES (?,?,?,?)";

                        $result_assign5=mysqli_prepare($connection, $propertassign5);
                        mysqli_stmt_bind_param($result_assign5, "ssss",$id_venta, $extraassign5,$extraCat5,$tipo_5);
                        mysqli_stmt_execute($result_assign5);
                        mysqli_stmt_close($result_assign5);
                      
                        $w5++;  
                    }
        
        }   
/*********OTROS***********/


/*********DISTANCIAS***********/
        if ($dista) {
                $wd=0;
                    foreach ($dista as $distassign) {

                        if (!empty($distassign)) {  

                                $id_unidad    = $idunidad[$wd];
                                $unidad_dist  = $distassign.' '.$unidad[$wd];

                                $sql_distancia ="INSERT INTO distancias_assign (idCasa,idExtra,extraDist) VALUES (?,?,?)";

                                $result_distancia=mysqli_prepare($connection, $sql_distancia);
                                mysqli_stmt_bind_param($result_distancia, "sss",$id_venta, $id_unidad,$unidad_dist);
                                mysqli_stmt_execute($result_distancia);
                                mysqli_stmt_close($result_distancia);

                            }
                       
                        $wd++;  
                    }
        
        }   
/*********DISTANCIAS***********/    


?>