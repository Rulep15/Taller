<?php

include '../../librerias/tcpdf/tcpdf.php';
require '../../conexion.php';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 0, 'Pag. ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document // CODIFICACION POR DEFECTO ES UTF-8
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('T.A');
$pdf->SetTitle('SERVICIOS REALIZADOS');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//set margins POR DEFECTO
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetMargins(8,10, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//set auto page breaks SALTO AUTOMATICO Y MARGEN INFERIOR
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// ---------------------------------------------------------
// TIPO DE LETRA
$pdf->SetFont('times', 'B', 14);
// AGREGAR PAGINA
$pdf->AddPage('L', 'LEGAL');
//celda para titulo
$pdf->Cell(0, 0, "SERVICIOS REALIZADOS", 0, 1, 'C');

//COLOR DE TABLA
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);
//$pdf->Ln(); //salto
$pdf->SetFont('', '');
$pdf->SetFillColor(255, 255, 255);

$compras = consultas::get_datos("select * from v_servicios where id_servicio=" . $_REQUEST['vidservicio'] . "");
if (!empty($compras)) {
    foreach ($compras as $compra) {
        $pdf->SetFont('', 'B', 10);

        $pdf->Ln(); //salto 


        $detalles = consultas::get_datos("select * from v_detalle_servicio where id_servicio=" . $compra['id_servicio'] . " order by id_servicio");

        $pdf->SetFont('', 'B', 10);
        $pdf->SetFillColor(188, 188, 188);
        $pdf->Cell(60, 5, 'CHOFER', 1, 0, 'C', 1);
        $pdf->Cell(220, 5, 'SERVICIO', 1, 0, 'C', 1);
        $pdf->Cell(50, 5, 'TOTAL', 1, 0, 'C', 1);
        $pdf->Ln(); //salto

        $pdf->SetFont('', '', 10);
        $pdf->SetFillColor(255, 255, 255);

        foreach ($detalles as $detalle) {
            $pdf->Cell(60, 5, $detalle['nombre'], 1, 0, 'C', 1);
            $pdf->Cell(220, 5, $detalle['servicio'], 1, 0, 'C', 1);
            $pdf->Cell(50, 5, number_format($detalle['total'], 0, ',', '.'), 1, 0, 'C', 1);
            $pdf->Ln();
        }
        $pdf->Ln();
        $pdf->Cell(350, 0, '----------------------------------------------------------------------------------------------------------------------------------------'
            . '-----------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'L');
        $pdf->Ln();
    }
} else {
    $pdf->SetFont('times', 'B', '14');
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
}
//SALIDA AL NAVEGADOR
$pdf->Output('servicios_realizados.pdf', 'I');
