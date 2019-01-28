<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set('Europe/London');



define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','webstyle_mallorcapanel2');

//application address
define('DIR','http://localhost/xcontrolpro/');
define('SITEEMAIL','info@villasplanet.com');
define('DIRVP','http://localhost/xcontrolpro/');

//define('DIR','http://localhost/httpdocs/xcontrolpro/');
//define('SITEEMAIL','info@villasplanet.com');
//define('DIRVP','http://localhost/httpdocs/xcontrolpro/');
try {

	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";charset=utf8mb4;dbname=".DBNAME, DBUSER, DBPASS);
    //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);//Suggested to uncomment on production websites
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Suggested to comment on production websites
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch(PDOException $e) {
	//show error
    echo '<p class="uk-alert-danger">'.$e->getMessage().'</p>';
    exit;
}
function getIP()
{
$ip;

if (getenv("HTTP_CLIENT_IP")) $ip = getenv("HTTP_CLIENT_IP");
else if(getenv("HTTP_X_FORWARDED_FOR")) $ip = getenv("HTTP_X_FORWARDED_FOR");
else if(getenv("REMOTE_ADDR")) $ip = getenv("REMOTE_ADDR");
else $ip = "UNKNOWN";

return $ip;

}
//include the user class, pass in the database connection
include('../classes/user.php');
include('../classes/phpmailer/mail.php');
$user = new User($db);
$ROOT="";
function tipo_propiedad ($text){
switch ($text) {
case "Townhouse":
echo "Casas de pueblo";
break;
case "Apartment":
echo "Pisos y apartamentos";
break;
case "Commercial":
echo "Negocio";
break;
case "Plot":
echo "Solares y parcelas";
break;
case "Country house":
echo "Casas y fincas rústicas";
break;
case "Villa":
echo "Chalets y villas";
break;
}}
function limpia($texto) {

$no_permitidas= array ("á","é","í","ó","ú","�?","É","�?","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã��?","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã�?","Ã„","Ã‹","ä","ë","ï","ö","ü","Ä","Ë","�?","Ö","Ü");
$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E","a","e","i","o","u","A","E","I","O","U");
$texto = str_replace($no_permitidas, $permitidas ,$texto);
	$texto = preg_replace('/\'/', '', $texto);
	$texto = str_replace('\\', '', $texto);
$texto = str_replace("","",$texto);
$texto = str_replace(",","",$texto);
$texto = str_replace("-"," ",$texto);
$texto = str_replace(".","-",$texto);
$texto = str_replace("/","-",$texto);
$texto = str_replace("/","-",$texto);
	$texto = str_replace("  "," ",$texto);
$texto = str_replace(" ","-",$texto);
	$texto = str_replace("ß","z",$texto);



$texto = rtrim($texto,"-");
$texto  = strtolower($texto);
return $texto;

}
function limpiaimagen($texto) {

$no_permitidas= array ("á","é","í","ó","ú","�?","É","�?","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã��?","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã�?","Ã„","Ã‹","ä","ë","ï","ö","ü","Ä","Ë","�?","Ö","Ü");
$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E","a","e","i","o","u","A","E","I","O","U");
$texto = str_replace($no_permitidas, $permitidas ,$texto);
	$texto = preg_replace('/\'/', '', $texto);
	$texto = str_replace('\\', '', $texto);
$texto = str_replace("","",$texto);
$texto = str_replace(",","",$texto);
$texto = str_replace("-"," ",$texto);
$texto = str_replace("/","-",$texto);
$texto = str_replace("/","-",$texto);
	$texto = str_replace("  "," ",$texto);
$texto = str_replace(" ","-",$texto);
	$texto = str_replace("ß","z",$texto);



$texto = rtrim($texto,"-");
$texto  = strtolower($texto);
return $texto;

}
$meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio',
               'Agosto','Septiembre','Octubre','Noviembre','Diciembre');
function lista($nombre, $meses){
	$array = $meses;
	$txt= "<select name='$nombre' id='$nombre' class='simple'>";
     $txt.="<option> -Clasificar por mes-</option>";
	for ($i=0; $i<sizeof($array); $i++){
	$txt .= "<option value='$i'>". $array[$i] . '</option>';
	}
	$txt .= '</select>';
	return $txt;
}

?>
