<?php require('../includes/config2.php'); 
$reload=$_POST['reload'];
if ($reload=='si') {?>
 <select placeholder="-Seleccionar-"   onchange="" class="box-gallery">
<?php $refauto2 = $db->prepare("SELECT ID,sellerName1 FROM owners ORDER BY ID DESC LIMIT 1");
			   $refauto2->setFetchMode(PDO::FETCH_ASSOC);
$refauto2->execute();
while ($refauto12 = $refauto2->fetch()){ ?>

	 <option value="<?php echo $refauto12['ID'];?>" selected><?php echo $refauto12['sellerName1'];?></option>

 	
	
	 

 <?php 
				$ultimoref=	$refauto12['ID'];
					
			   $clientes2 = $db->prepare("SELECT DISTINCT sellerName1 FROM owners where active='1' and ID!='$ultimoref' order by sellerName1 Asc");
			   $clientes2->setFetchMode(PDO::FETCH_ASSOC);
$clientes2->execute();
while ($row22 = $clientes2->fetch()){?>
			   <option value="<?php echo $row22['ID'];?>"><?php echo $row22['sellerName1'];?></option>
			<?php  }?><?php }?>

</select> <script type="text/javascript">
        $(document).ready(function () {
			$('.box-gallery').SumoSelect({search: true, searchText: 'Escribir aquí...',selectAll:false,noMatch: 'No hay resultadao para "{0}"',captionFormat:'{0} Seleccionados', 
    captionFormatAllSelected:'{0} todos seleccionados',locale: ['OK', 'Cancelar', 'Seleccionar todo']});
			
		});</script><?php }else {

/*VARIABLES*/
$dateAdded               = date("Y-m-d H:i:s");

$nombre                  =$_POST['nombre'];
$apellidos               =$_POST['apellidos'];
$sellerDNI               =$_POST['sellerDNI'];
$sellerNationality       =$_POST['sellerNationality'];
$population              = $_POST['population'];
$postal_code             = $_POST['postal_code'];

$sellerLang              =$_POST['sellerLang'];
$telefono                =$_POST['telefono'];
$sellerMob               =$_POST['sellerMob'];
$sellerContact           =$_POST['sellerContact'];



$sellerFax               =$_POST['sellerFax'];
$email                   =$_POST['email'];
$sellerAddress           =$_POST['sellerAddress'];
$propType                =$_POST['propType'];



$add_sessionID           =$_POST['add_sessionID'];
$OfficeID                =$_POST['OfficeID'];
$EmployeeID              =$_POST['EmployeeID'];
$SSMA_TimeStamp          =$_POST['SSMA_TimeStamp'];
$comment                 = $_POST['comment'];



/*VARIABLES*/




$refauto = $db->prepare("SELECT ID FROM owners ORDER BY ID DESC LIMIT 1");
$refauto->setFetchMode(PDO::FETCH_ASSOC);
$refauto->execute();
while ($refauto1 = $refauto->fetch()){ 
$ref_ok=$refauto1['ID']+1;
if ($accion=="edit"){$ref_ok=$refedit;}}
$nombrecompleto=$nombre." ".$apellidos;
if (isset($nombre) and (!empty($nombre))) {
if (isset($email) and (!empty($email))) {
//20 variables CON ID

$ownersimpleinsert = "INSERT INTO `owners`(`ID`,`propType`,`active`,`dateAdded`,`add_sessionID`,`OfficeID`,`EmployeeID`,`sellerName1`,`sellerContact`,`sellerNationality`,`sellerLang`,`sellerAddress`,`sellerTel`,`sellerMob`,`sellerFax`,`sellerEmail`,`sellerDNI`,`comment`,`postal_code`,`population`,`SSMA_TimeStamp`) VALUES('".$ref_ok."','".$propType."','1','".$dateAdded."','".$add_sessionID."','".$OfficeID."','".$EmployeeID."','".$nombrecompleto."','".$sellerContact."','".$sellerNationality."','".$sellerLang."','".$sellerAddress."','".$telefono."','".$sellerMob."','".$sellerFax."','".$email."','".$sellerDNI."','".$comment."','".$postal_code."','".$population."','".$SSMA_TimeStamp."')";




$db->exec($ownersimpleinsert);		
}else{$json['messageERROR']="<h3><span class='red' style='padding:30px; font-size:18px; display:block'><strong>No se ha registrado el propietario.Debe introducir un nombre.</strong><br>Revise los datos y vuelva a intentarlo.</span></h3>";}	
}else{$json['messageERROR']="<h3><span class='red' style='padding:30px; font-size:18px; display:block'><strong>No se ha registrado el propietario.Debe introducir un email.</strong><br>Revise los datos y vuelva a intentarlo.</span></h3>";}
$json['messageERROR']="<h3><span class='green' style='padding:30px; font-size:18px; display:block'><strong>Nuevo propietario guardado con éxito.</strong></span></h3>";		
	
echo json_encode($json);}?>
