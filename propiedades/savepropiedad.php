<?php
include('../includes/conexion_nueva.php'); 


$tipoProp       =$_POST['tipoProp'];
$tipoProp2      =$_POST['tipoProp2'];
$estado1        =$_POST['estado1'];
$propietario    =$_POST['propietario'];


mysqli_set_charset($connection, "utf8");
$sql = "SELECT sellerName1 FROM owners WHERE ID='$propietario'";
$resultado= mysqli_query($connection, $sql); 
$fila=mysqli_fetch_array($resultado);

$name_owner = $fila['sellerName1'];

/*PARTE DEL MAPA*/
$direccion              =$_POST['direccion'];
$poblacion              =$_POST['poblacion'];
$latitud                =$_POST['latitud'];
$longitud               =$_POST['longitud'];
$zona                   =$_POST['zona'];
$mostrarDireccion       =$_POST['mostrarDireccion'];
if ($zona=="") {
  $location=$poblacion.":0";
}else{
  $location=$poblacion.":".$zona;
}
$linkmap=$latitud.",".$longitud;

/*PARTE DEL MAPA*/



/*SECCION DETALLES GENERALES*/

/*****DATOS DE ALQUILERES SOLAMENTE (6 DATOS)*/
$rentalType       =$_POST['rentalType'];
$propSleepsFrom   =$_POST['propSleepsFrom'];
$propSleepsTo     =$_POST['propSleepsTo'];
$propETV          =$_POST['propETV'];
$propETVnum       =$_POST['propETVnum'];
$avantio          =$_POST['avantio'];
/*****DATOS DE ALQUILERES SOLAMENTE*/

//$refVenta        =' ';// VARIABLE BORRADA AL SER ID AUTOINCREMENTABLE PERO SE NECESITA PARA NO DEJAR NULL EL CAMPO
$precioVenta       =$_POST['precioVenta'];

if (!empty($_POST['clasifEnergia'])) {
    $clasifEnergia     =$_POST['clasifEnergia'];
}

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




/*SECCION DETALLES Distribución*/
$habSimple             =$_POST['habSimple'];
$habDoble              =$_POST['habDoble'];
$banos_extra           =$_POST['banos'];
$aseos                 =$_POST['aseos'];
/*SECCION DETALLES Distribución*/




/*SECCION DE CHECKBOX*/
$destacada             =$_POST['destacada'];
$lujo                  =$_POST['lujo'];
$nueva                 =$_POST['nueva'];
$portada               =$_POST['portada'];
/*SECCION DE CHECKBOX*/
$id_extra                            =  $_POST['id_extra'];



/*SECCION DE DETALLES ADICIONALES ENTORNO DISTANCIA FALTA< VER TABLA*/

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


/*SECCION DE DETALLES ADICIONALES ENTORNO DISTANCIA FALTA< VER TABLA*/

/*SECCION DE NOTAS PRIVADAS*/
$notas                =$_POST['notas'];

/*SECCION DE NOTAS PRIVADAS*/

/*INSERTAR 32 DATOS*/

if ($tipoProp=='venta') {
$sql22 = "SELECT yourRef FROM properties ORDER BY ID DESC LIMIT 1";
$result = mysqli_query($connection, $sql22);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row3 = mysqli_fetch_assoc($result)) {
		$ref_ok = intval(preg_replace('/[^0-9]+/', '', $row3['yourRef']), 10) +1; 
	   //$ref_ok=$row3['ID']+1001;
       $refVenta=trim($ref_ok."V");	
       $idCasa = trim($ref_ok);
	}}
    //////////////////////INSERT USUARIO
            mysqli_set_charset($connection, "utf8");
            $active= 1;
            $sql_propiedad="INSERT INTO properties (ID,yourRef,SellerID,NameOwner,active,propLocation,propStatus,propFeatured,propNameES,propNameEN,propNameDE,propAddress,propLinkMap,mostrarDireccion,propType,propPrice,propDescripES,propDescripEN,propDescripDE,propHouseM2,propTerraceM2,propLandM2,propTotalM2,propBedSingle,propBedDouble,propBathroom,propToilet,esLujo,esNueva,clasifEnergia,slider,propNotesPrivate) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $result_propiedad=mysqli_prepare($connection, $sql_propiedad);
            mysqli_stmt_bind_param($result_propiedad, "ssssssssssssssssssssssssssssssss",$idCasa,$refVenta,$propietario,$name_owner,$active,$location,$estado1,$destacada,$tituloES,$tituloEN,$tituloDE,$direccion,$linkmap,$mostrarDireccion,$tipoProp2,$precioVenta,$descripES,$descripEN,$descripDE,$supUtil,$supTerraza,$supTerreno,$supTotal,$habSimple,$habDoble,$banos_extra,$aseos,$lujo,$nueva,$clasifEnergia,$portada,$notas);
            mysqli_stmt_execute($result_propiedad);
            $idventa = mysqli_insert_id($connection);//CODIGO PARA EL ID
            mysqli_stmt_close($result_propiedad);

//////////////////////INSERT USUARIO CIERRO

/*BORRAR REGISTRO HUERFANOS EN RESERVAS SI LOS HUBIERA*/
mysqli_set_charset($connection, "utf8");
$sql_borrar_dist="DELETE FROM distancias_assign WHERE idCasa=?";
$resultado_borrar_dist=mysqli_prepare($connection, $sql_borrar_dist);
mysqli_stmt_bind_param($resultado_borrar_dist, "s",$idventa);
mysqli_stmt_execute($resultado_borrar_dist); 
mysqli_stmt_close($resultado_borrar_dist);
/*BORRAR REGISTRO HUERFANOS EN RESERVAS SI LOS HUBIERA*/


/*********DISTRIBUCION***********/
        if ($distribucion) {
                $w1=0;
                    foreach ($dist as $extraassign1) {
                        $extraCat1=$ex1cat[$w1];
                        $tipo_1 = 'distribucion';

                        $propertassign1 ="INSERT INTO extras_assign (idCasa,idExtra,extraCat,pertenece) VALUES (?,?,?,?)";

                        $result_assign1=mysqli_prepare($connection, $propertassign1);
                        mysqli_stmt_bind_param($result_assign1, "ssss",$idventa, $extraassign1,$extraCat1,$tipo_1);
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
                        mysqli_stmt_bind_param($result_assign2, "ssss",$idventa, $extraassign2,$extraCat2,$tipo_2);
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
                        mysqli_stmt_bind_param($result_assign3, "ssss",$idventa, $extraassign3,$extraCat3,$tipo_3);
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
                        mysqli_stmt_bind_param($result_assign4, "ssss",$idventa, $extraassign4,$extraCat4,$tipo_4);
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
                        mysqli_stmt_bind_param($result_assign5, "ssss",$idventa, $extraassign5,$extraCat5,$tipo_5);
                        mysqli_stmt_execute($result_assign5);
                        mysqli_stmt_close($result_assign5);
                       
                        $w5++;  
                    }
        
        }   
/*********OTROS***********/


/*********DISTANCIAS***********/
        if ($distancias) {
                $wd=0;

                    foreach ($dista as $distassign) {

                        if (!empty($distassign)) {          
                                $id_unidad    = $idunidad[$wd];
                                $unidad_dist  = $distassign.' '.$unidad[$wd];

                                $sql_distancia ="INSERT INTO distancias_assign (idCasa,idExtra,extraDist) VALUES (?,?,?)";

                                $result_distancia=mysqli_prepare($connection, $sql_distancia);
                                mysqli_stmt_bind_param($result_distancia, "sss",$idventa, $id_unidad,$unidad_dist);
                                mysqli_stmt_execute($result_distancia);
                                mysqli_stmt_close($result_distancia);
                               }
                                $wd++;  
                    }
        
        }   
/*********DISTANCIAS***********/
mysqli_close($connection);

}else{
$sql22 = "SELECT yourRef FROM rentals ORDER BY ID DESC LIMIT 1";
$result = mysqli_query($connection, $sql22);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row3 = mysqli_fetch_assoc($result)) {		
		$ref_ok = intval(preg_replace('/[^0-9]+/', '', $row3['yourRef']), 10) +1; 
	   //$ref_ok=$row3['ID']+1001;
       $refVenta=trim($ref_ok."A");
       $idCasa = trim($ref_ok);		
		//$ref_ok=$row3['ID']+1001;
		// $refVenta=$ref_ok."A";	
	}}	
    //////////////////////INSERT USUARIO
            mysqli_set_charset($connection, "utf8");
            $active= 1;
            $sql_propiedad="INSERT INTO rentals (ID,yourRef,SellerID,NameOwner,active,propLocation,propStatus,propFeatured,propNameES,propNameEN,propNameDE,propAddress,propLinkMap,mostrarDireccion,propType,propPrice,propDescripES,propDescripEN,propDescripDE,propHouseM2,propTerraceM2,propLandM2,propTotalM2,propBedSingle,propBedDouble,propBathroom,propToilet,esLujo,esNueva,slider,propNotesPrivate,rentalType,propSleepsFrom,propSleepsTo,propETV,propETVnum,avantio) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $result_propiedad=mysqli_prepare($connection, $sql_propiedad);
            mysqli_stmt_bind_param($result_propiedad, "sssssssssssssssssssssssssssssssssssss",$idCasa,$refVenta,$propietario,$name_owner,$active,$location,$estado1,$destacada,$tituloES,$tituloEN,$tituloDE,$direccion,$linkmap,$mostrarDireccion,$tipoProp2,$precioVenta,$descripES,$descripEN,$descripDE,$supUtil,$supTerraza,$supTerreno,$supTotal,$habSimple,$habDoble,$banos_extra,$aseos,$lujo,$nueva,$portada,$notas,$rentalType,$propSleepsFrom,$propSleepsTo,$propETV,$propETVnum,$avantio);
            mysqli_stmt_execute($result_propiedad);
             $idventa = mysqli_insert_id($connection);//CODIGO PARA EL ID
            mysqli_stmt_close($result_propiedad);

/*BORRAR REGISTRO HUERFANOS EN RESERVAS SI LOS HUBIERA*/
mysqli_set_charset($connection, "utf8");
$sql_borrar_dist="DELETE FROM distancias_assign_rentals WHERE idCasa=?";
$resultado_borrar_dist=mysqli_prepare($connection, $sql_borrar_dist);
mysqli_stmt_bind_param($resultado_borrar_dist, "s",$idventa);
mysqli_stmt_execute($resultado_borrar_dist); 
mysqli_stmt_close($resultado_borrar_dist);
/*BORRAR REGISTRO HUERFANOS EN RESERVAS SI LOS HUBIERA*/


                $id_extra                           = $_POST['id_extra'];



            for ($i=0; $i < count($id_extra); $i++) {
/*SECCION DE EXTRAS NUEVOS*/
                $name_es                            = $_POST['name_es'.$i];

                $aplica                             = $_POST['aplica'.$i];

                $cantidad_ocupantes_1               = $_POST['cantidad_ocupantes_1'.$i];
                $cantidad_ocupantes_2               = $_POST['cantidad_ocupantes_2'.$i];
                $cantidad_ocupantes                = $cantidad_ocupantes_1.'-'.$cantidad_ocupantes_2;
                

                $temporadas                         = $_POST['temporadas'.$i];
                $start_temporada                    = $_POST['start_temporada'.$i];
                $end_temporada                      = $_POST['end_temporada'.$i];


                $cantidad                           = $_POST['cantidad'.$i];
                $max_cantidad                       = $_POST['max_cantidad'.$i];


                $precio_incluido                    = $_POST['precio_incluido'.$i];
                $a_que_precio_1                     = $_POST['a_que_precio_1'.$i];
                $a_que_precio_2                     = $_POST['a_que_precio_2'.$i];
                $a_que_precio                       = $a_que_precio_1.'-'.$a_que_precio_2;


                $iva                                = $_POST['iva'.$i];
                $cuando_se_paga                     = $_POST['cuando_se_paga'.$i];
                $que_dia_aplica                     = $_POST['que_dia_aplica'.$i];
                $proveedores                        = $_POST['proveedores'.$i];

/*SECCION DE EXTRAS NUEVOS*/


                //16 datos a insertar

                //////////////////////INSERT EXTRAS
                            mysqli_set_charset($connection, "utf8");
                            $sql_extra="INSERT INTO extras_alquileres_rentals (id_rentals,id_extra,name_es,aplica,cantidad_ocupantes,temporadas,start_temporada,end_temporada,cantidad,max_cantidad,precio_incluido,a_que_precio,iva,cuando_se_paga,que_dia_aplica,proveedores) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado_extra=mysqli_prepare($connection, $sql_extra);
                            mysqli_stmt_bind_param($resultado_extra, "ssssssssssssssss",$idventa,$id_extra[$i],$name_es,$aplica,$cantidad_ocupantes,$temporadas,$start_temporada,$end_temporada,$cantidad,$max_cantidad,$precio_incluido,$a_que_precio,$iva,$cuando_se_paga,$que_dia_aplica,$proveedores);
                            mysqli_stmt_execute($resultado_extra);
                            mysqli_stmt_close($resultado_extra);
            

                //////////////////////INSERT EXTRAS CIERRO

            }   

    /*********DISTANCIAS***********/
        if ($dista) {
                $wd=0;
                    foreach ($dista as $distassign) {

                        if (!empty($distassign)) {                              
                          
                                $id_unidad    = $idunidad[$wd];
                                $unidad_dist  = $distassign.' '.$unidad[$wd];

                                $sql_distancia ="INSERT INTO distancias_assign_rentals (idCasa,idExtra,extraDist) VALUES (?,?,?)";

                                $result_distancia=mysqli_prepare($connection, $sql_distancia);
                                mysqli_stmt_bind_param($result_distancia, "sss",$idventa, $id_unidad,$unidad_dist);
                                mysqli_stmt_execute($result_distancia);
                                mysqli_stmt_close($result_distancia);

                        }
                       
                        $wd++;  
                    }
        
        }   
/*********DISTANCIAS***********/


//////////////////////INSERT USUARIO CIERRO
}
         



?>


