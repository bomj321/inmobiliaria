<?php 


/*IMAGEN CASA*/
if (!empty($row_image['medium']) AND $row_image['medium'] != '') {
	$imagen_casa = $row_image['medium'];
}else{
	$imagen_casa = "../images/villas-planet-logo.png";
}
/*IMAGEN CASA*/

/*TITULO*/
if (!empty($row['propNameES']) AND $row['propNameES'] != '') {
	$titulo_casa = $row['propNameES'];
}else{
	$titulo_casa = 'No Disponible';
}
/*TITULO*/

/*TOTAL METROS*/
if (!empty($row['propTotalM2']) AND $row['propTotalM2'] != '') {
	$total_metros = $row['propTotalM2'].' m2';
}else{
	$total_metros = 'No Disponible';
}
/*TOTAL METROS*/

/*PRECIO*/
if (!empty($row['propPrice']) AND $row['propPrice'] != '' AND $row['propPrice'] != '0') {

$precio = number_format((float)$row['propPrice'], 0, ',', '.');

    $total_precio=$precio.' '.EURO;
}else{
	$total_precio = 'No Disponible';
}
/*PRECIO*/

/*DIRECCION*/
if (!empty($row['propAddress']) AND $row['propAddress'] != '') {
	$direccion = $row['propAddress'];
}else{
	$direccion = 'No Disponible';
}
/*DIRECCION*/

/*TIPO INMUEBLE*/

if (!empty($row['propType']) AND $row['propType'] != '') {

		if ($row['propType'] == 'Apartment') {

			$tipo_casa = 'Pisos y apartamentos';

		}elseif($row['propType'] == 'Villa'){

			$tipo_casa = 'Chalet y villas';

		}elseif ($row['propType'] == 'Country house') {

			$tipo_casa = 'Casas y fincas rústicas';

		}elseif ($row['propType'] == 'Townhouse') {

			$tipo_casa = 'Casas de pueblo';

		}elseif($row['propType'] == 'Plot'){

			$tipo_casa = 'Solares y parcelas';

		}
		
}else{
	$tipo_casa = 'No Disponible';
}

/*TIPO INMUEBLE*/

/*MEDIDAS*/
if (!empty($row['propHouseM2']) AND $row['propHouseM2'] != '') {
	$metro_utiles = trim($row['propHouseM2']).' m2';
}else{
	$metro_utiles = 'No Disponible';
}

if (!empty($row['propTerraceM2']) AND $row['propTerraceM2'] != '') {
	$superficie_terraza = trim($row['propTerraceM2']).' m2';
}else{
	$superficie_terraza = 'No Disponible';
}

if (!empty($row['propLandM2']) AND $row['propLandM2'] != '') {
	$superficie_terreno = trim($row['propLandM2']).' m2';
}else{
	$superficie_terreno = 'No Disponible';
}

if (!empty($row['propTotalM2']) AND $row['propTotalM2'] != '') {
	$metro_utiles = trim($row['propTotalM2']).' m2';
}else{
	$metro_utiles = 'No Disponible';
}
/*MEDIDAS*/



/*******DISTRIBUCION***********/
if (!empty($row['propBedSingle']) AND $row['propBedSingle'] != '') {
	$hab_simple = $row['propBedSingle'];
}else{
	$hab_simple = 'No Disponible';
}

if (!empty($row['propBedDouble']) AND $row['propBedDouble'] != '') {
	$hab_doble = $row['propBedDouble'];
}else{
	$hab_doble = 'No Disponible';
}

if (!empty($row['propBathroom']) AND $row['propBathroom'] != '') {
	$banos = $row['propBathroom'];
}else{
	$banos = 'No Disponible';
}

if (!empty($row['propToilet']) AND $row['propToilet'] != '') {
	$aseos = $row['propToilet'];
}else{
	$aseos = 'No Disponible';
}

/***** *DISTRIBUCION************/





/*Propietario*/
if (!empty($row_clientes['sellerName1']) AND $row_clientes['sellerName1'] != '') {
	$propietario = $row_clientes['sellerName1'];
}else{
	$propietario = 'No Disponible';
}
/*Propietario*/



/*TITULO*/
if (!empty($row['propNameES']) AND $row['propNameES'] != '') {
	$titulo_casa = $row['propNameES'];
}else{
	$titulo_casa = 'No Disponible';
}
/*TITULO*/

/*TOTAL METROS*/
if (!empty($row['propTotalM2']) AND $row['propTotalM2'] != '') {
	$total_metros = $row['propTotalM2'].' m2';
}else{
	$total_metros = 'No Disponible';
}
/*TOTAL METROS*/

/*PRECIO*/
if (!empty($row['propPrice']) AND $row['propPrice'] != '') {
	$total_precio = $row['propPrice'].' '.EURO;
}else{
	$total_precio = 'No Disponible';
}
/*PRECIO*/

/*DIRECCION*/
if (!empty($row['propAddress']) AND $row['propAddress'] != '') {
	$direccion = $row['propAddress'];
}else{
	$direccion = 'No Disponible';
}
/*DIRECCION*/





 ?>