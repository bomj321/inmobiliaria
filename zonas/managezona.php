<?php require('../includes/config2.php'); 
$ref=$_POST['ref'];
$add=$_POST['add'];
$deletezona=$_POST['deletezona'];
$nomlocalidad=$_POST['nombre'];
$accion=$_POST['accion'];
$activar=$_POST['activar'];
$cp=$_POST['cp'];
$descripcion=$_POST['descripcion'];
$descripcionDE=$_POST['descripcionDE'];
$descripcionEN=$_POST['descripcionEN'];
$interes=$_POST['interes'];
$interesDE=$_POST['interesDE'];
$interesEN=$_POST['interesEN'];
$latitud=$_POST['latitud'];
$longitud=$_POST['longitud'];
$ocio=$_POST['ocio'];
$ocioDE=$_POST['ocioDE'];
$ocioEN=$_POST['ocioEN'];

$titleTown=$_POST['titleTown'];
$titleTownDE=$_POST['titleTownDE'];
$titleTownEN=$_POST['titleTownEN'];
$town=$_POST['town'];
$town=strtoupper($town);
$coordenadas=$latitud."-".$longitud;
if (($add=="si") and ($nomlocalidad!="")) { 
$stmt6998 = $db->prepare("SELECT localidades_asociadas FROM sys_towns where ID='$ref' order by Town ASC");
$stmt6998->setFetchMode(PDO::FETCH_ASSOC);
$stmt6998->execute();
while ($row6998 = $stmt6998->fetch()){
if ($deletezona=="si") {
$deletearr=array();
$arrloc=explode(',',$row6998['localidades_asociadas']);
$nomlocalidad=strtolower($nomlocalidad);
foreach ($arrloc as $deletevalue){
if ($deletevalue!=$nomlocalidad) {
array_push($deletearr, $deletevalue);	
}	
	
}
$arraylocalidad = implode(",",$deletearr);
$arraylocalidad=addslashes($arraylocalidad);	
} else {
$arrloc=explode(',',$row6998['localidades_asociadas']);
array_push($arrloc,strtolower($nomlocalidad));	
$arraylocalidad = implode(",",$arrloc);
$arraylocalidad=addslashes($arraylocalidad);	
}
$locupdate = "UPDATE sys_towns SET  localidades_asociadas='$arraylocalidad' where sys_towns.ID='$ref'";	
$db->exec($locupdate);?>
<?php $stmt6999 = $db->prepare("SELECT localidades_asociadas FROM sys_towns where ID='$ref'");
		
$stmt6999->setFetchMode(PDO::FETCH_ASSOC);
$stmt6999->execute();
while ($row6999 = $stmt6999->fetch()){?>
		
<?php $list2=explode(',',$row6999['localidades_asociadas']);
 asort($list2);			
				
				?>
									  
				
        <a class="uk-accordion-title grey-titles" href="#" style="font-size:14px; color: #959595 !important;"><strong>Zonas asociadas a la población</strong></a>
        <div class="uk-accordion-content">
		<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            
        </tr>
    </thead>
    <tbody>
		<tr style="font-size:13px;"><td style="padding-bottom: 0px;"><div class="uk-grid">
			<div class="uk-width-1-3" style="padding-top: 8px;">
				AÑADIR NUEVA</div>
			<div class="uk-width-2-3">
				<input class="uk-input" value="" id="addZona2" name="nueva-area" type="text" placeholder="" style="display:inline;width:70%;"><button onclick="addZona('<?php echo $ref?>')" class="uk-button uk-button-primary" type="button" style="display:inline;width:30%; text-align:center;padding:0 3px; height:33px;line-height:10px;">Agregar</button>
				<p id="reloadlocalidad"></p></div>
			
			</div></td><td style="text-align:right; float:right; "><div class="uk-grid uk-grid-small">
				
				<td style="text-align:right; float:right; "><div class="uk-grid uk-grid-small">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div></td>
				</div></td></tr>
		<?php foreach ($list2 as $loc) { if ($loc!="") {?>
        <tr style="font-size:13px;">
            <td><?php echo ucwords($loc);?></td>
           
            <td style="text-align:right; float:right; "><div class="uk-grid uk-grid-small">
				
				<a href="<?php echo DIR;?>zonas/zona?accion=edit&ref=<?php echo $ref?>" style="color:#959595 !important"><span uk-icon="icon:pencil;ratio:1" uk-tooltip="Editar"></span></a>
				
				
				<a onclick="deleteZona('<?php echo strtolower($loc)?>')" style="color:#959595 !important"><span uk-icon="icon:trash;ratio:1" uk-tooltip="Eliminar"></span></a>
				
				
				</div></td>
		</tr>
		<?php }}}?>
<?php }		


}else {
if ($accion=="delete") {
$delete = "DELETE from sys_towns where ID='$ref'";
$db->exec($delete);
$json['delete1']="<h3><span class='green' style='padding:30px; font-size:18px; display:block'><strong><span uk-icon='icon:check;'></i> Zona eliminada con éxito.</strong><br>Puede volver a crear o editar desde la zona de gestión de zonas.</span></h3>";	
}	
if (isset($ref) and (!empty($ref))) {
if (isset($town) and (!empty($town))) {
if ($accion=="nuevo") {
$zonainsert = "INSERT INTO `sys_towns`(`ID`, `active`, `Country`, `Province`, `Area`, `Town`, `Location`, `PC`, `Link`, `townDescripES`, `townDescripEN`, `townDescripDE`, `longlatpobla`, `longlatlocation`, `titleTown`, `titleTownEN`, `titleTownDE`, `interesTown`, `interesTownEN`, `interesTownDE`, `ocioTown`, `ocioTownEN`, `ocioTownDE`) VALUES('".$ref."','".$activar."','1','1','1','".$town."','0','".$cp."','-','".$descripcion."','".$descripcionEN."','".$descripcionDE."','".$coordenadas."','','".$titleTown."','".$titleTownEN."','".$titleTownDE."','".$interes."','".$interesEN."','".$interesDE."','".$ocio."','".$ocioEN."','".$ocioDE."')";
$db->exec($zonainsert);	} 
if ($accion=="edit") {
$zonainsert = "UPDATE sys_towns SET  active='$activar',Country=1,Province='1',Area='1',Town='$town',Location='0',PC='$cp',Link='-',townDescripES='$descripcion',townDescripEN='$descripcionEN',townDescripDE='$descripcionDE',longlatpobla='$coordenadas',longlatlocation='',titleTown='$titleTown',titleTownEN='$titleTownEN',titleTownDE='$titleTownDE',interesTown='$interes',interesTownEN='$interesEN',interesTownDE='$interesDE',ocioTown='$ocio',ocioTownEN='$ocioEN',ocioTownDE='$ocioDE' where sys_towns.ID='$ref'";
$db->exec($zonainsert);	}
}else {$json['messageERROR']="<h3><span class='red' style='padding:30px; font-size:18px; display:block'><strong>El campo de población no puede estar vacío.</strong><br>Revise los datos y vuelva a intentarlo.</span></h3>";}} else {$json['messageERROR']="<h3><span class='red' style='padding:30px; font-size:18px; display:block'><strong>No se ha registrado la referencia.</strong><br>Revise los datos y vuelva a intentarlo.</span></h3>";}
$json['messageERROR']="<h3><span class='green' style='padding:30px; font-size:18px; display:block'><strong><span uk-icon='icon:check;'></i> La zona se ha guardado con éxito.</strong><br>Puede volver a editarla desde la zona de gestión de zonas.</span></h3>";
echo json_encode($json);}
?>
