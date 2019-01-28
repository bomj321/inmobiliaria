<?php require('../includes/config2.php'); 
$id=$_POST['id'];
$accion=$_POST['accion'];
if (isset($_POST['distanciaActivo'])){$distanciaActivo=$_POST['distanciaActivo'];}else{$distanciaActivo="no";};
$distanciaNombre=$_POST['distanciaNombre'];
$distanciaNombreEN=$_POST['distanciaNombreEN'];
$distanciaNombreDE=$_POST['distanciaNombreDE'];
$compareNameinput=limpia($distanciaNombre);
$existe="";
$stmt288 = $db->prepare("SELECT distanciaNombre FROM distancias_properties");
$stmt288->setFetchMode(PDO::FETCH_ASSOC);
$stmt288->execute();
while ($row288 = $stmt288->fetch()){
$compareNameoutput=limpia($row288['distanciaNombre']);
if ($compareNameoutput==$compareNameinput) {$existe="yes";}
}
if(isset($_POST['distanciaTipoProp']) && is_array($_POST['distanciaTipoProp'])){
    $distanciaTipoProp = implode(",", $_POST['distanciaTipoProp']); 
}
if ($accion=="delete") {
$delete = "DELETE from distancias_properties where id='$id'";
$db->exec($delete);
$json['delete1']="<h3><span class='green' style='padding:30px; font-size:18px; display:block'><strong><span uk-icon='icon:check;'></i> Extra/equipamiento eliminado con éxito.</strong><br>Puede volver a crear o editar desde la zona de gestión de extras/distancias.</span></h3>";	
}	
if ((isset($distanciaNombre) and (!empty($distanciaNombre))) and (isset($distanciaNombreEN) and (!empty($distanciaNombreEN))) and (isset($distanciaNombreDE) and (!empty($distanciaNombreDE))) ){
if ($accion=="edit") {
$distanciasup ="UPDATE distancias_properties SET distanciaActivo='$distanciaActivo',distanciaNombre='$distanciaNombre',distanciaNombreEN='$distanciaNombreEN',distanciaNombreDE='$distanciaNombreDE',distanciaTipoProp='$distanciaTipoProp' WHERE distancias_properties.id='$id'";
$db->exec($distanciasup);
	$json['messageERROR']="<h3><span class='green' style='padding:30px; font-size:18px; display:block'><strong><span uk-icon='icon:check;'></i> Distancia/entorno guardado con éxito.</strong><br>Puede volver a editarlo desde la zona de gestión de distancias.</span></h3>";	
}
if ($accion=="nuevo") {
if ($existe!="yes") {	
$distanciasins ="INSERT INTO `distancias_properties`(`id`, `distanciaActivo`, `distanciaNombre`, `distanciaNombreEN`, `distanciaNombreDE`, `distanciaTipoProp`) VALUES ('".$ref."','".$distanciaActivo."','".$distanciaNombre."','".$distanciaNombreEN."','".$distanciaNombreDE."','".$distanciaTipoProp."')";
$db->exec($distanciasins);
	$json['messageERROR']="<h3><span class='green' style='padding:30px; font-size:18px; display:block'><strong><span uk-icon='icon:check;'></i> Distancia/entorno guardado con éxito.</strong><br>Puede volver a editarlo desde la zona de gestión de distancias.</span></h3>";	
} else{
$json['messageERROR']="<h3><span class='red' style='padding:30px; font-size:18px; display:block'><strong><span uk-icon='icon:check;'></i> La distancia/entorno que intenta crear ya existe.</strong><br>Revise los datos y vuelva a intentarlo.</span></h3>";	}}		
	} else {$json['messageERROR']="<h3><span class='red' style='padding:30px; font-size:18px; display:block'><strong>El campo nombre principal no puede estar vacío.</strong><br>Revise los datos y vuelva a intentarlo.</span></h3>";}
	
echo json_encode($json);
?>