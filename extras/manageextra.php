<?php require('../includes/config2.php'); 
$id=$_POST['id'];
$accion=$_POST['accion'];
if (isset($_POST['extraActivo'])){$extraActivo=$_POST['extraActivo'];}else{$extraActivo="no";};
$extraNombre=$_POST['extraNombre'];
$extraNombreEN=$_POST['extraNombreEN'];
$extraNombreDE=$_POST['extraNombreDE'];
$extraOptions ="";
$extraOptionsEN ="";
$extraOptionsDE ="";
$category=$_POST['category'];
$compareNameinput=limpia($extraNombre);
$existe="";
$stmt288 = $db->prepare("SELECT extraNombre FROM extras_properties");
$stmt288->setFetchMode(PDO::FETCH_ASSOC);
$stmt288->execute();
while ($row288 = $stmt288->fetch()){
$compareNameoutput=limpia($row288['extraNombre']);
if ($compareNameoutput==$compareNameinput) {$existe="yes";}
}
if(isset($_POST['extraOptions']) && is_array($_POST['extraOptions'])){
    $extraOptions = implode(",", $_POST['extraOptions']); 
}
if(isset($_POST['extraOptionsEN']) && is_array($_POST['extraOptionsEN'])){
    $extraOptionsEN = implode(",", $_POST['extraOptionsEN']); 
}
if(isset($_POST['extraOptionsDE']) && is_array($_POST['extraOptionsDE'])){
    $extraOptionsDE = implode(",", $_POST['extraOptionsDE']); 
}
if(isset($_POST['extraTipoProp']) && is_array($_POST['extraTipoProp'])){
    $extraTipoProp = implode(",", $_POST['extraTipoProp']); 
}

if ($accion=="delete") {
$delete = "DELETE from extras_properties where id='$id'";
$db->exec($delete);
$json['delete1']="<h3><span class='green' style='padding:30px; font-size:18px; display:block'><strong><span uk-icon='icon:check;'></i> Extra/equipamiento eliminado con éxito.</strong><br>Puede volver a crear o editar desde la zona de gestión de extras/distancias.</span></h3>";	
}

if ((isset($extraNombre) and (!empty($extraNombre))) and (isset($extraNombreEN) and (!empty($extraNombreEN))) and (isset($extraNombreDE) and (!empty($extraNombreDE))) ){
if ($accion=="edit") {
$extrasup ="UPDATE extras_properties SET extraActivo='$extraActivo',extraNombre='$extraNombre',extraNombreEN='$extraNombreEN',extraNombreDE='$extraNombreDE',extraOptions='$extraOptions',extraOptionsEN='$extraOptionsEN',extraOptionsDE='$extraOptionsDE',extraTipoProp='$extraTipoProp',extraCat='$category' WHERE extras_properties.id='$id'";
$db->exec($extrasup);	
$json['messageERROR']="<h3><span class='green' style='padding:30px; font-size:18px; display:block'><strong><span uk-icon='icon:check;'></i> Extra/equipamiento guardado con éxito.</strong><br>Puede volver a editarlo desde la zona de gestión de extras/distancias.</span></h3>";	
}
if ($accion=="nuevo") {
if ($existe!="yes") {	
$extrasins ="INSERT INTO `extras_properties`(`id`, `extraActivo`, `extraNombre`, `extraNombreEN`, `extraNombreDE`, `extraOptions`, `extraOptionsEN`, `extraOptionsDE`, `extraTipoProp`, `extraCat`) VALUES ('".$ref."','".$extraActivo."','".$extraNombre."','".$extraNombreEN."','".$extraNombreDE."','".$extraOptions."','".$extraOptionsEN."','".$extraOptionsDE."','".$extraTipoProp."','".$category."')";
$db->exec($extrasins);
$json['messageERROR']="<h3><span class='green' style='padding:30px; font-size:18px; display:block'><strong><span uk-icon='icon:check;'></i> Extra/equipamiento guardado con éxito.</strong><br>Puede volver a editarlo desde la zona de gestión de extras/distancias.</span></h3>";	
} else{
$json['messageERROR']="<h3><span class='red' style='padding:30px; font-size:18px; display:block'><strong><span uk-icon='icon:check;'></i> El extra/equipamiento que intenta crear ya existe.</strong><br>Revise los datos y vuelva a intentarlo.</span></h3>";	}	
}	
		} else {$json['messageERROR']="<h3><span class='red' style='padding:30px; font-size:18px; display:block'><strong>El campo nombre principal no puede estar vacío.</strong><br>Revise los datos y vuelva a intentarlo.</span></h3>";}

	
echo json_encode($json);
?>