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

/*CONSULTAS*/
$image1 = "../images/villas-planet-logo.png";
$stmt = $db->prepare("SELECT * FROM rentals WHERE yourRef='$idcasa'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();

$id_casa_bbdd = $row['ID'];
$id_cliente = $row['SellerID'];

$stmt_image = $db->prepare("SELECT medium FROM image_properties_rentals WHERE ref='$id_casa_bbdd'");
$stmt_image->setFetchMode(PDO::FETCH_ASSOC);
$stmt_image->execute();
$row_image = $stmt_image->fetch();



$clientes = $db->prepare("SELECT * FROM owners WHERE ID='$id_cliente'");
$clientes->setFetchMode(PDO::FETCH_ASSOC);
$clientes->execute();
$row_clientes = $clientes->fetch();



$distancias = $db->prepare("SELECT distancias_assign_rentals.*,distancias_properties.distanciaNombre as distancia_nombre FROM distancias_assign_rentals INNER JOIN distancias_properties ON (distancias_properties.id = distancias_assign_rentals.idExtra) WHERE distancias_assign_rentals.idCasa = '$id_casa_bbdd'");
$distancias->setFetchMode(PDO::FETCH_ASSOC);
$distancias->execute();
$cuenta_filas_distancias = $distancias->rowCount();




$equipamiento = $db->prepare("SELECT extras_alquileres_equipamiento.*,extras_properties.extraNombre as extraNombre FROM extras_alquileres_equipamiento INNER JOIN extras_properties ON (extras_properties.id = extras_alquileres_equipamiento.id_extra) WHERE extras_alquileres_equipamiento.id_rentals = '$id_casa_bbdd'");
$equipamiento->setFetchMode(PDO::FETCH_ASSOC);
$equipamiento->execute();
$cuenta_filas = $equipamiento->rowCount();


$extras = $db->prepare("SELECT extras_alquileres_equipamiento.*,extras_properties.extraNombre as extraNombre FROM extras_alquileres_equipamiento INNER JOIN extras_properties ON (extras_properties.id = extras_alquileres_equipamiento.id_extra) WHERE extras_alquileres_equipamiento.id_rentals = '$id_casa_bbdd'");
$extras->setFetchMode(PDO::FETCH_ASSOC);
$extras->execute();
$extras_filas = $extras->rowCount();
/*CONSULTAS*/

require_once ('condicional_informacion_alquileres.php');



$pdf = new PDF_AutoPrint('P', 'mm',array(215,315));
//$pdf = new PDF;
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 15);

/*Header*/
$pdf->SetX(55);
$pdf->Image($image1,75,10,60);
$pdf->SetLineWidth(2);
$pdf->Line(30,25,180,25);
$pdf->SetTextColor(244,187,63);
$pdf->SetFillColor(0,0,0);
$pdf->SetXY(150, 25);
$pdf->Cell(30.5,15,utf8_decode('Ref. '.$row['yourRef']),1,1,'C',true);
/*Header*/

/*Titulo*/
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 20);
$pdf->SetTextColor(216, 112, 21);
$pdf->SetX(35);
$pdf->MultiCell(125, 6, utf8_decode($titulo_casa), 0, 'C', 0);
/*Titulo*/

/*IMAGEN GRANDE*/
$pdf->Image($imagen_casa,30,65,150,50);
/*IMAGEN GRANDE*/

/*LINEA DESCRIPCION*/
$pdf->SetDrawColor(201,199,197);
$pdf->SetLineWidth(1);
$pdf->Line(30,120,180,120);
/*LINEA DESCRIPCION*/


/**************DESCRIPCION***********/
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(244,187,63);
$pdf->SetFillColor(0,0,0);
$pdf->SetXY(30, 125);
$pdf->Cell(50,5,utf8_decode('Descripción General'),0,0,'L',true);

$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetX(30);
$pdf->Cell(80,15,utf8_decode('Tipo de Casa: '.$tipo_casa),0,0,'L');
$pdf->Ln(5);
$pdf->SetX(30);
$pdf->Cell(80,15,utf8_decode('Propietario: '.$propietario),0,0,'L');
$pdf->Ln(5);
$pdf->SetX(30);
$pdf->Cell(80,15,'Precio: '.$total_precio,0,0,'L');
/**************DESCRIPCION***********/

/**************MEDIDAS***************/
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(244,187,63);
$pdf->SetFillColor(0,0,0);
$pdf->SetXY(120, 125);
$pdf->Cell(60,5,utf8_decode('Medidas'),0,0,'L',true);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(120,125);
$pdf->Cell(80,15,utf8_decode('Sup. Terraza: '.trim($superficie_terraza)),0,0,'L');
$pdf->SetXY(120,130);
$pdf->Cell(80,15,utf8_decode('Sup. Terreno: '.trim($superficie_terreno)),0,0,'L');
$pdf->SetXY(120,135);
$pdf->Cell(80,15,utf8_decode('Sup. Total: '.trim($metro_utiles)),0,0,'L');
/**************MEDIDAS***************/

/********DISTRIBUCION******************/
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(244,187,63);
$pdf->SetFillColor(0,0,0);
$pdf->SetXY(120, 150);
$pdf->Cell(60,5,utf8_decode('Distribución'),0,0,'L',true);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(120,150);
$pdf->Cell(80,15,utf8_decode('#N Hab. Individuales: '.trim($hab_simple)),0,0,'L');
$pdf->SetXY(120,155);
$pdf->Cell(80,15,utf8_decode('#N Hab. Dobles: '.trim($hab_doble)),0,0,'L');
$pdf->SetXY(120,160);
$pdf->Cell(80,15,utf8_decode('#N Baños: '.trim($banos)),0,0,'L');
$pdf->SetXY(120,165);
$pdf->Cell(80,15,utf8_decode('#N Aseos: '.trim($aseos)),0,0,'L');

/********DISTRIBUCION******************/

/*DISTANCIA Y ENTORNO*/
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(244,187,63);
$pdf->SetFillColor(0,0,0);
$pdf->SetXY(30, 150);
$pdf->Cell(50,5,utf8_decode('Distancia y Entorno'),0,0,'L',true);

$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0, 0, 0);

if ($cuenta_filas_distancias) {
        while ($distancias1 = $distancias->fetch()) {
        $pdf->SetX(30);
        $pdf->Cell(80,15,utf8_decode($distancias1['distancia_nombre'].': '.$distancias1['extraDist']),0,0,'L');
        $pdf->Ln(5);   
    }

}else{
        $pdf->SetX(30);
        $pdf->Cell(80,15,utf8_decode('No Disponible'),0,0,'L');
}

/*DISTANCIA Y ENTORNO*/

/*EQUIPAMIENTO*/
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(244,187,63);
$pdf->SetFillColor(0,0,0);
$pdf->SetXY(120, 180);
$pdf->Cell(50,5,utf8_decode('Equipamiento'),0,0,'L',true);

$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0, 0, 0);

if ($cuenta_filas) {
    while ($equipamiento_row = $equipamiento->fetch()) {
    $pdf->SetX(120);
    $pdf->Cell(80,15,utf8_decode($equipamiento_row['extraNombre']),0,0,'L');
    $pdf->Ln(5);   
    }
}else{  

    $pdf->SetX(120);
    $pdf->Cell(80,15,utf8_decode('No Disponible'),0,0,'L');
    $pdf->Ln(5); 
}

/*EQUIPAMIENTO*/



/*DIRECCION Y NUMERO DE CONTACTO*/

$pdf->Ln(0.5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(40,240);
$pdf->MultiCell(125, 6, utf8_decode('Tel: 0034 971 54 54 11 Email: info@villasplanet.com'), 0, 'C', 0);
/*DIRECCION Y NUMERO DE CONTACTO*/

/*CONDICIONES DE USO*/
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 5);
$pdf->SetTextColor(140, 139, 138);
$pdf->SetX(30);
$pdf->MultiCell(151.2,2, utf8_decode('Esta publicación es propiedad intelectual exclusiva de VILLAS PLANET y no debe ser copiada, reproducida o transmitida de ninguna manera enteramente o en parte sin el consentimiento escrito de VILLAS PLANET. La información contenida en ésta publicaciónes meramente informativa y ha sido obtenida de la propiedad y/o de fuentes consideradas generalmente fiables pero no garantiza la exactitud ni veracidad de dicha información. Consecuentemente, VILLAS PLANET no se responsabiliza por la negligencia de terceros , daños o pérdidas sufridas por cualquiera de las partes debido a la información proporcionada en ésta publicación.'), 0, 'L', 0);
/*CONDICIONES DE USO*/


$pdf->AutoPrint();
$pdf->Output();
mysqli_close($connection);
?>