<?php
require('../includes/config2.php');
$idcasa = $_GET['id'];
include('fpdf_plantilla_casas.php');
class PDF_AutoPrint extends PDF
{
   function AutoPrint($printer='')
    {
        // Open the print dialog
        if($printer)
        {
            $printer = str_replace('\\', '\\\\', $printer);
            $script = "var pp = getPrintParams();";
            $script .= "pp.interactive = pp.constants.interactionLevel.full;";
            $script .= "pp.printerName = '$printer'";
            $script .= "print(pp);";
        }
        else
            $script = 'print(true);';
        $this->IncludeJS($script);
    }
}

/*VARIALES DE SIMBOLOS*/
define('EURO',chr(128));
/*VARIALES DE SIMBOLOS*/
/////////////////////////////////////////DESCUENTO//////////////////////////////////
$image1 = "../images/villas-planet-logo.png";
$stmt = $db->prepare("SELECT * FROM properties WHERE yourRef='$idcasa'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();

$id_casa_bbdd = $row['ID'];

$stmt_image = $db->prepare("SELECT medium FROM image_properties WHERE ref='$id_casa_bbdd'");
$stmt_image->setFetchMode(PDO::FETCH_ASSOC);
$stmt_image->execute();
$row_image = $stmt_image->fetch();


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

/*CIERRO MULTIPLES CONSULTAS*/
$pdf = new PDF_AutoPrint('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 15);

/*Header*/
$pdf->SetX(55);
$pdf->Image($image1,60,10,90);
$pdf->SetLineWidth(2);
$pdf->Line(30,35,180,35);
$pdf->SetTextColor(244,187,63);
$pdf->SetFillColor(0,0,0);
$pdf->SetXY(150, 35);
$pdf->Cell(30.5,15,'Ref. 1628V',1,1,'C',true);
/*Header*/

/*Titulo*/
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 20);
$pdf->SetTextColor(216, 112, 21);
$pdf->SetX(40);
$pdf->MultiCell(125, 6, utf8_decode($titulo_casa), 0, 'C', 0);
/*Titulo*/

/*IMAGEN GRANDE*/
$pdf->Image($imagen_casa,30,85,150,70);
/*IMAGEN GRANDE*/

/*IMAGEN PEQUEÑA*/
$pdf->Image($imagen_casa,30,160,75);
/*IMAGEN PEQUEÑA*/

/*TEXTO DESCRIPCION*/
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(244,187,63);
$pdf->SetFillColor(0,0,0);
$pdf->SetXY(110, 160);
$pdf->Cell(69,5,utf8_decode('Descripción básica'),1,1,'L',true);

/*CUERPO DESCRIPCION*/
$pdf->SetDrawColor(201,199,197);
$pdf->SetLineWidth(1);
$pdf->Line(110,155,179.5,155);

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(140, 139, 138);
$pdf->SetXY(108,167);
$pdf->Cell(69,15,utf8_decode('Superfície terreno:'.$total_metros),0,0,'L');


$pdf->SetFont('Arial', 'B', 20);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(244,187,63);
$pdf->SetFillColor(0,0,0);
$pdf->SetXY(110, 180);
$pdf->Cell(69,15,$total_precio,1,1,'C');
/*CUERPO DESCRIPCION*/
/*TEXTO DESCRIPCION*/

/*DIRECCION Y NUMERO DE CONTACTO*/
$pdf->Ln(25);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetX(40);
$pdf->MultiCell(125, 6, utf8_decode('Dirreción: '.$direccion), 0, 'L', 0);

$pdf->Ln(0.5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetX(40);
$pdf->MultiCell(125, 6, utf8_decode('Tel: 0034 971 54 54 11 Email: info@villasplanet.com'), 0, 'C', 0);
/*DIRECCION Y NUMERO DE CONTACTO*/

/*CONDICIONES DE USO*/
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 5);
$pdf->SetTextColor(140, 139, 138);
$pdf->SetX(30);
$pdf->MultiCell(151.2,2, utf8_decode('Esta publicación es propiedad intelectual exclusiva de VILLAS PLANET y no debe ser copiada, reproducida o transmitida de ninguna manera enteramente o en parte sin el consentimiento escrito de VILLAS PLANET. La información contenida en ésta publicaciónes meramente informativa y ha sido obtenida de la propiedad y/o de fuentes consideradas generalmente fiables pero no garantiza la exactitud ni veracidad de dicha información. Consecuentemente, VILLAS PLANET no se responsabiliza por la negligencia de terceros , daños o pérdidas sufridas por cualquiera de las partes debido a la información proporcionada en ésta publicación.'), 0, 'L', 0);
/*CONDICIONES DE USO*/


$pdf->AutoPrint();
$pdf->Output();
mysqli_close($connection);
?>