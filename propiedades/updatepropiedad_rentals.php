<?php
include('../includes/conexion_nueva.php'); 

$active         =$_POST['active'];
$id_venta       =$_POST['id_venta'];
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
  $location=$poblacion.":Ninguna";
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



//$refVenta        =$_POST['refVenta'];
$precioVenta     =$_POST['precioVenta'];

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

/*OTROS EXTRAS*/

/*OTROS EXTRAS*/
/*EXTRAS EQUIPAMIENTO*/
$extra_equipamiento = $_POST['equipamiento'];
/*EXTRAS EQUIPAMIENTO*/

/*ACTUALIZACION 36 DATOS*/

mysqli_set_charset($connection, "utf8");
    $sql="UPDATE rentals SET active=?,SellerID=?,NameOwner=?, propLocation= ?, propStatus= ?, propFeatured= ?, propNameES= ?, propNameEN= ?, propNameDE= ?,propAddress= ?, propLinkMap=?, mostrarDireccion=?,propType=?,propPrice=?,propDescripES=?,propDescripEN=?,propDescripDE=?,propHouseM2=?,propTerraceM2=?,propLandM2=?,propTotalM2=?,propBedSingle=?,propBedDouble=?,propBathroom=?,propToilet=?,esLujo=?,esNueva=?,slider=?,propNotesPrivate=?,rentalType=?,propSleepsFrom=?,propSleepsTo=?,propETV=?,propETVnum=?,avantio=?  WHERE ID=?";
    $resultado=mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($resultado, "ssssssssssssssssssssssssssssssssssss", $active,$propietario,$name_owner,$location,$estado1,$destacada,$tituloES,$tituloEN,$tituloDE,$direccion,$linkmap,$mostrarDireccion,$tipoProp2,$precioVenta,$descripES,$descripEN,$descripDE,$supUtil,$supTerraza,$supTerreno,$supTotal,$habSimple,$habDoble,$banos_extra,$aseos,$lujo,$nueva,$portada,$notas,$rentalType,$propSleepsFrom,$propSleepsTo,$propETV,$propETVnum,$avantio,$id_venta);
    mysqli_stmt_execute($resultado);       
    mysqli_stmt_close($resultado);

/*BORRAR TODOS LOS REGISTROS PRIMERAMENTE DE LA TABLA EXTRAS EQUIPAMIENTO YA QUE NO PUEDO HACER UN UPDATE PORQUE NO EXISTEN NINGUNA RELACION CON LAS TABLAS*/
mysqli_set_charset($connection, "utf8");
$sql_borrar="DELETE FROM extras_alquileres_equipamiento WHERE id_rentals=?";
$resultado_borrar=mysqli_prepare($connection, $sql_borrar);
mysqli_stmt_bind_param($resultado_borrar, "s",$id_venta);
mysqli_stmt_execute($resultado_borrar); 
mysqli_stmt_close($resultado_borrar);

mysqli_set_charset($connection, "utf8");
$sql_borrar_dist="DELETE FROM distancias_assign_rentals WHERE idCasa=?";
$resultado_borrar_dist=mysqli_prepare($connection, $sql_borrar_dist);
mysqli_stmt_bind_param($resultado_borrar_dist, "s",$id_venta);
mysqli_stmt_execute($resultado_borrar_dist); 
mysqli_stmt_close($resultado_borrar_dist);

/*BORRAR TODOS LOS REGISTROS PRIMERAMENTE DE LA TABLA EXTRAS EQUIPAMIENTO YA QUE NO PUEDO HACER UN UPDATE PORQUE NO EXISTEN NINGUNA RELACION CON LAS TABLAS*/  

/*INSERT DE EXTRAS DE EQUIPAMIENTO ES UN ARRAY SE RECORRE*/

if (!empty($extra_equipamiento)) {


                for ($i=0; $i<count($extra_equipamiento); $i++) { 

                         $id_equipamiento = $extra_equipamiento[$i];

                         //////////////////////INSERT EXTRAS DE EQUIPAMIENTO
                            mysqli_set_charset($connection, "utf8");
                            $sql_extra_equipamiento="INSERT INTO extras_alquileres_equipamiento (id_rentals,id_extra) VALUES (?,?)";
                            $resultado_extra_equipamiento=mysqli_prepare($connection, $sql_extra_equipamiento);
                            mysqli_stmt_bind_param($resultado_extra_equipamiento, "ii",$id_venta,$id_equipamiento);
                            mysqli_stmt_execute($resultado_extra_equipamiento);
                            mysqli_stmt_close($resultado_extra_equipamiento);         

                      //////////////////////INSERT EXTRAS DE EQUIPAMIENTO CIERRO

            }

}






/*INSERT DE EXTRAS DE EQUIPAMIENTO ES UN ARRAY SE RECORRE*/  

if (isset($_POST['id_extra']) AND !empty($_POST['id_extra'])) {

         $id_extra                           = $_POST['id_extra'];

        /************EDITAR EXTRAS*******/
             for ($x=0; $x < count($id_extra); $x++) {
        /*SECCION DE EXTRAS NUEVOS*/
                        $name_es                            = $_POST['name_es'.$x];

                        $aplica                             = $_POST['aplica'.$x];

                        $cantidad_ocupantes_1               = $_POST['cantidad_ocupantes_1'.$x];
                        $cantidad_ocupantes_2               = $_POST['cantidad_ocupantes_2'.$x];
                        $cantidad_ocupantes                = $cantidad_ocupantes_1.'-'.$cantidad_ocupantes_2;
                        

                        $temporadas                         = $_POST['temporadas'.$x];
                        $start_temporada                    = $_POST['start_temporada'.$x];
                        $end_temporada                      = $_POST['end_temporada'.$x];


                        $cantidad                           = $_POST['cantidad'.$x];
                        $max_cantidad                       = $_POST['max_cantidad'.$x];


                        $precio_incluido                    = $_POST['precio_incluido'.$x];
                        $a_que_precio_1                     = $_POST['a_que_precio_1'.$x];
                        $a_que_precio_2                     = $_POST['a_que_precio_2'.$x];
                        $a_que_precio                       = $a_que_precio_1.'-'.$a_que_precio_2;


                        $iva                                = $_POST['iva'.$x];
                        $cuando_se_paga                     = $_POST['cuando_se_paga'.$x];
                        $que_dia_aplica                     = $_POST['que_dia_aplica'.$x];
                        $proveedores                        = $_POST['proveedores'.$x];

        // 15 datos para actualizar
        /*SECCION DE EXTRAS NUEVOS*/
        mysqli_set_charset($connection, "utf8");
            $sql_extra="UPDATE extras_alquileres_rentals SET name_es=?, aplica= ?, cantidad_ocupantes= ?, temporadas= ?, start_temporada= ?, end_temporada= ?, cantidad= ?,max_cantidad= ?, precio_incluido=?, a_que_precio=?,iva=?,cuando_se_paga=?,que_dia_aplica=?,proveedores=? WHERE id_extra_alquileres_rentals=?";
            $resultado_extra=mysqli_prepare($connection, $sql_extra);
            mysqli_stmt_bind_param($resultado_extra, "sssssssssssssss", $name_es,$aplica,$cantidad_ocupantes,$temporadas,$start_temporada,$end_temporada,$cantidad,$max_cantidad,$precio_incluido,$a_que_precio,$iva,$cuando_se_paga,$que_dia_aplica,$proveedores,$id_extra[$x]);
            mysqli_stmt_execute($resultado_extra);       
            mysqli_stmt_close($resultado_extra);

                    }  
}

/************EDITAR EXTRAS*******/

/****************INSERTAR EXTRAS NUEVOS***************/
if (isset($_POST['id_extranot']) AND !empty($_POST['id_extranot'])) {
    # code...


$id_extra_not                           = $_POST['id_extranot'];



            for ($i=0; $i < count($id_extra_not); $i++) {
/*SECCION DE EXTRAS NUEVOS*/
				
if($_POST['aplicanot'.$i] != 0)	{			
                $name_es_not                            = $_POST['name_esnot'.$i];

                $aplica_not                             = $_POST['aplicanot'.$i];

                $cantidad_ocupantes_1_not               = $_POST['cantidad_ocupantes_1not'.$i];
                $cantidad_ocupantes_2_not               = $_POST['cantidad_ocupantes_2not'.$i];
                $cantidad_ocupantes_not                 = $cantidad_ocupantes_1_not.'-'.$cantidad_ocupantes_2_not;
                

                $temporadas_not                         = $_POST['temporadasnot'.$i];
                $start_temporada_not                    = $_POST['start_temporadanot'.$i];
                $end_temporada_not                      = $_POST['end_temporadanot'.$i];


                $cantidad_not                           = $_POST['cantidadnot'.$i];
                $max_cantidad_not                       = $_POST['max_cantidadnot'.$i];


                $precio_incluido_not                    = $_POST['precio_incluidonot'.$i];
                $a_que_precio_1_not                     = $_POST['a_que_precio_1not'.$i];
                $a_que_precio_2_not                     = $_POST['a_que_precio_2not'.$i];
                $a_que_precio_not                       = $a_que_precio_1_not.'-'.$a_que_precio_2_not;


                $iva_not                                = $_POST['ivanot'.$i];
                $cuando_se_paga_not                     = $_POST['cuando_se_paganot'.$i];
                $que_dia_aplica_not                     = $_POST['que_dia_aplicanot'.$i];
                $proveedores_not                        = $_POST['proveedoresnot'.$i];

/*SECCION DE EXTRAS NUEVOS*/


                //16 datos a insertar

                //////////////////////INSERT EXTRAS
                            mysqli_set_charset($connection, "utf8");
                            $sql_extra_not="INSERT INTO extras_alquileres_rentals (id_rentals,id_extra,name_es,aplica,cantidad_ocupantes,temporadas,start_temporada,end_temporada,cantidad,max_cantidad,precio_incluido,a_que_precio,iva,cuando_se_paga,que_dia_aplica,proveedores) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado_extra_not=mysqli_prepare($connection, $sql_extra_not);
                            mysqli_stmt_bind_param($resultado_extra_not, "ssssssssssssssss",$id_venta,$id_extra_not[$i],$name_es_not,$aplica_not,$cantidad_ocupantes_not,$temporadas_not,$start_temporada_not,$end_temporada_not,$cantidad_not,$max_cantidad_not,$precio_incluido_not,$a_que_precio_not,$iva_not,$cuando_se_paga_not,$que_dia_aplica_not,$proveedores_not);
                            mysqli_stmt_execute($resultado_extra_not);
                            mysqli_stmt_close($resultado_extra_not);
            
                //////////////////////INSERT EXTRAS CIERRO
}
            }  
	
	
}

/****************INSERTAR EXTRAS NUEVOS***************/

/*********DISTANCIAS***********/
        if ($dista) {
                $wd=0;
                    foreach ($dista as $distassign) {

                        if (!empty($distassign)) {                              
                          
                                $id_unidad    = $idunidad[$wd];
                                $unidad_dist  = $distassign.' '.$unidad[$wd];

                                $sql_distancia ="INSERT INTO distancias_assign_rentals (idCasa,idExtra,extraDist) VALUES (?,?,?)";

                                $result_distancia=mysqli_prepare($connection, $sql_distancia);
                                mysqli_stmt_bind_param($result_distancia, "sss",$id_venta, $id_unidad,$unidad_dist);
                                mysqli_stmt_execute($result_distancia);
                                mysqli_stmt_close($result_distancia);

                        }
                       
                        $wd++;  
                    }
        
        }   
/*********DISTANCIAS***********/


mysqli_close($connection);

?>