<?php require('../includes/config2.php');

  $accion=$_POST['accion'];
  $activo=$_POST['activo'];
  $tipoProp=$_POST['tipoProp'];
  $tipoProp2=$_POST['tipoProp2'];
  $estado1=$_POST['estado1'];
  $propietario=$_POST['propietario'];
  $direccion=$_POST['direccion'];
  $poblacion=$_POST['poblacion'];
  $cp=$_POST['cp'];
  $latitud=$_POST['latitud'];
  $longitud=$_POST['longitud'];
$linkmap=$latitud.",".$longitud;
  $zona=$_POST['zona']; 
  if ($zona=="") {$location=$poblacion.":0";} else {$location=$poblacion.":".$zona;}
$mostrarDireccion=$_POST['mostrarDireccion'];
if ($mostrarDireccion=="si") {$mostrarDireccion=$mostrarDireccion;} else {$mostrarDireccion="no";}
  $destacada=$_POST['destacada']; 
if ($destacada=="si") {$destacada=$destacada;} else {$destacada="no";}
  $refVenta=$_POST['refVenta'];
  $refAlquiler=$_POST['refAlquiler'];
  $precioAlquiler=$_POST['precioAlquiler'];
  $precioAlquilerTiempo=$_POST['precioAlquilerTiempo'];
  $precioAlquilerOferta2=$_POST['precioAlquilerOferta2'];
  $precioAlquilerOfertaTiempo=$_POST['precioAlquilerOfertaTiempo'];
  $precioVenta=$_POST['precioVenta'];
  $precioVentaOferta=$_POST['precioVentaOferta']; 
 if ($precioVentaOferta=="si") {$precioVentaOferta=$precioVentaOferta;} else {$precioVentaOferta="no";}	  
  $precioVentaOferta2=$_POST['precioVentaOferta2'];
  $tituloES=$_POST['tituloES'];
  $descripES=$_POST['descripES'];
  $tituloEN=$_POST['tituloEN'];
  $descripEN=$_POST['descripEN'];
  $tituloDE=$_POST['tituloDE'];
  $descripDE=$_POST['descripDE'];
  $supUtil=$_POST['supUtil'];
  $supTerraza=$_POST['supTerraza'];
  $supTerreno=$_POST['supTerreno'];
  $supTotal=$_POST['supTotal'];
  $habSimple=$_POST['habSimple'];
  $habDoble=$_POST['habDoble'];
  $banos=$_POST['banos'];
  $aseos=$_POST['aseos'];
  $controlDist=$_POST['controlDist'];
  $notas=$_POST['notas'];
 $lujo=$_POST['lujo']; 
 if ($lujo=="si") {$lujo=$lujo;} else {$lujo="no";}	
$nueva=$_POST['nueva']; 
 if ($nueva=="si") {$nueva=$nueva;} else {$nueva="no";}	
$portada=$_POST['portada']; 
 if ($portada=="si") {$portada=$portada;} else {$portada="no";}	
$distanciaget="distancia";
$unidadget="unidad";
$IDdistanciaget="idDist";
$idDist=array();
$distancias=array();
$fecha=date('Y-m-d');
for ($x = 0; $x < $controlDist; $x++) {
array_push($distancias,$_POST[$distanciaget.$x]." ".$_POST[$unidadget.$x]);	
array_push($idDist,$_POST[$IDdistanciaget.$x]);		
}
$ex1=$_POST['extra1'];
if($ex1){
    $prueba = implode(",", $ex1); 
} else {$prueba="no";}
$ex1cat=$_POST['extra1Cat'];
if($ex1cat){
    $pruebaCat = implode(",", $ex1cat); 
} else {$pruebaCat="no";}
$ex2=$_POST['extra2'];
if($ex2){
    $prueba2 = implode(",", $ex2); 
} else {$prueba2="no";}
$ex2cat=$_POST['extra2Cat'];
if($ex2cat){
    $pruebaCat2 = implode(",", $ex2cat); 
} else {$pruebaCat2="no";}
$ex3=$_POST['extra3'];
if($ex3){
    $prueba3 = implode(",", $ex3); 
} else {$prueba3="no";}
$ex3cat=$_POST['extra3Cat'];
if($ex3cat){
    $pruebaCat3 = implode(",", $ex3cat); 
} else {$pruebaCat3="no";}
$ex4=$_POST['extra4'];
if($ex4){
    $prueba4 = implode(",", $ex4); 
} else {$prueba4="no";}
$ex4cat=$_POST['extra4Cat'];
if($ex4cat){
    $pruebaCat4 = implode(",", $ex4cat); 
} else {$pruebaCat4="no";}
$ex5=$_POST['extra5'];
if($ex5){
    $prueba5 = implode(",", $ex5); 
} else {$prueba5="no";}
$ex5cat=$_POST['extra5Cat'];
if($ex5cat){
    $pruebaCat5 = implode(",", $ex5cat); 
} else {$pruebaCat5="no";}
if ($accion=="nuevo") {

if ($tipoProp=="venta") {
$ref = $db->prepare("SELECT ID FROM properties ORDER BY ID DESC LIMIT 1");
			   $ref->setFetchMode(PDO::FETCH_ASSOC);
$ref->execute();

while ($row3 = $ref->fetch()){ 
$ref_ok=$row3['ID']+1;
}	
$propertyins ="INSERT INTO `properties` (`ID`,`yourRef`,`active`,`propLocation`,`SellerID`,`propStatus`,`propFeatured`,`propNameES`,`propNameEN`,`propNameDE`,`propAddress`,`propLinkMap`,`mostrarDireccion`,`propType`,`propPrice`,`esOferta`,`precioOferta`,`propDescripES`,`propDescripEN`,`propDescripDE`,`propHouseM2`,`propTerraceM2`,`propLandM2`,`propTotalM2`,`propBedSingle`,`propBedDouble`,`propBathroom`,`propToilet`,`esLujo`,`esNueva`,`slider`,`propNotesPrivate`,`dateAdded`) VALUES ('".$ref_ok."','".$refVenta."','".$activo."','".$location."','".$propietario."','".$estado1."','".$destacada."','".$tituloES."','".$tituloEN."','".$tituloDE."','".$direccion."','".$linkmap."','".$mostrarDireccion."','".$tipoProp2."','".$precioVenta."','".$precioVentaOferta."','".$precioVentaOferta2."','".$descripES."','".$descripEN."','".$descripDE."','".$supUtil."','".$supTerraza."','".$supTerreno."','".$supTotal."','".$habSimple."','".$habDoble."','".$banos."','".$aseos."','".$lujo."','".$nueva."','".$portada."','".$notas."','".$fecha."')";
$db->exec($propertyins);
$t=0;
foreach ($distancias as $distanciasassign1) {
$distassign1=$idDist[$t];
$distanciaassign1 ="INSERT INTO `distancias_assign` (`idCasa`,`idExtra`,`extraDist`) VALUES ('".$refVenta."','".$distassign1."','".$distanciasassign1."')";
$db->exec($distanciaassign1);		
$t++;}
if ($prueba!="no") {
$w=0;
foreach ($ex1 as $extraassign1) {
$extraCat11=$ex1cat[$w];

$propertassign1 ="INSERT INTO `extras_assign` (`idCasa`,`idExtra`,`extraCat`,`pertenece`) VALUES ('".$refVenta."','".$extraassign1."','".$extraCat11."','distribucion')";
$db->exec($propertassign1);	
$w++;	
}
	
}

if ($prueba2!="no") {
$w2=0;
foreach ($ex2 as $extraassign2) {
$extraCat22=$ex2cat[$w2];

$propertassign2 ="INSERT INTO `extras_assign` (`idCasa`,`idExtra`,`extraCat`,`pertenece`) VALUES ('".$refVenta."','".$extraassign2."','".$extraCat22."','banos')";
$db->exec($propertassign2);	
$w2++;	
}
	
}	
if ($prueba3!="no") {
$w3=0;
foreach ($ex3 as $extraassign3) {
$extraCat33=$ex3cat[$w3];

$propertassign3 ="INSERT INTO `extras_assign` (`idCasa`,`idExtra`,`extraCat`,`pertenece`) VALUES ('".$refVenta."','".$extraassign3."','".$extraCat33."','equipamiento')";
$db->exec($propertassign3);	
$w3++;	
}
	
}	
if ($prueba4!="no") {
$w4=0;
foreach ($ex4 as $extraassign4) {
$extraCat44=$ex4cat[$w4];

$propertassign4 ="INSERT INTO `extras_assign` (`idCasa`,`idExtra`,`extraCat`,`pertenece`) VALUES ('".$refVenta."','".$extraassign4."','".$extraCat44."','jardin')";
$db->exec($propertassign4);	
$w4++;	
}
	
}	
if ($prueba5!="no") {
$w5=0;
foreach ($ex5 as $extraassign5) {
$extraCat55=$ex5cat[$w5];

$propertassign5 ="INSERT INTO `extras_assign` (`idCasa`,`idExtra`,`extraCat`,`pertenece`) VALUES ('".$refVenta."','".$extraassign5."','".$extraCat55."','otros')";
$db->exec($propertassign5);	
$w5++;	
}
	
}	
echo "<h3><span class='green' style='padding:30px; font-size:18px; display:block'><strong><span uk-icon='icon:check;'></i> La propiedad se ha guardado con éxito.</strong><br>Puede volver a editarla desde la zona de gestión de propiedades.</span></h3>";
}

	
}

?>