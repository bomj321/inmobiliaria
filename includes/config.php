<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set('Europe/London');

//database credentials
//define('DBHOST','localhost');
//define('DBUSER','2108miq');
//define('DBPASS','A9jew2*1');
//define('DBNAME','webstyle_mallorcapanel2');

//define('DBHOST','localhost');
//define('DBUSER','root');
//define('DBPASS','');
//define('DBNAME','inmobiliaria');

define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','webstyle_mallorcapanel2');

//application address
define('DIR','http://localhost/xcontrolpro/');
define('SITEEMAIL','aitor@webstylemallorca.com');
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
include('./classes/user.php');
include('./classes/phpmailer/mail.php');
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
?>
