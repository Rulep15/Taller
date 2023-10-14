<?php

include '../../../librerias/tcpdf/tcpdf.php';
require '../../../conexion.php';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    // Page footer
    public function Footer() {
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
$pdf->SetAuthor('Lucas');
$pdf->SetTitle('REPORTE DE NOTAS DE DEBITO');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
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
$pdf->SetFont('times', 'B', 18);
// AGREGAR PAGINA
$pdf->AddPage('L', 'LEGAL');
//celda para titulo
$pdf->Cell(0, 0, "REPORTE DE NOTA DE DEBITO", 0, 1, 'C');

//SALTO DE LINEA
$pdf->Ln();
//COLOR DE TABLA
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);
//$pdf->Ln(); //salto
$pdf->SetFont('', '');
$pdf->SetFillColor(255, 255, 255);

if ($_REQUEST['vopcion'] == '1') {
    $fechainicial = $_REQUEST['vdesde'];
    $fechafinal = $_REQUEST['vhasta'];
    $pedidoss = consultas::get_datos("SELECT * FROM v_nota_debito WHERE tim_vencimiento BETWEEN $fechainicial AND $fechafinal ");
    if (!empty($pedidoss)) {
        foreach ($pedidoss as $pedidos) {
            $pdf->SetFont('', 'B', 14);
            //columnas
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(20, 7, '', 0, 0, 'C');
            $pdf->Cell(20, 7, 'Codigo:', 0, 0, 'C');
            $pdf->Cell(20, 7, $pedidos['id_compra'], 0, 0, 'L');
            $pdf->Cell(50, 7, '', 0, 0, 'C');
            $pdf->Cell(50, 7, '', 0, 0, 'C');
            $pdf->Cell(50, 7, '', 0, 0, 'C');
            $pdf->Cell(50, 7, '', 0, 0, 'C');
            $pdf->Cell(22, 7, 'USUARIO:', 0, 0, 'C');
            $pdf->Cell(30, 7, $pedidos['usu_nick'], 0, 0, 'C');

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(20, 7, '', 0, 0, 'C');
            $pdf->Cell(20, 7, 'FECHA: ', 0, 0, 'L');
            $pdf->SetFont('', 'N', 14);
            $pdf->Cell(30, 7, $pedidos['fecha_sistema'], 0, 0, 'L');
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(20, 7, '', 0, 0, 'C');
            $pdf->SetFont('', 'B', 14);
            $pdf->Cell(40, 7, 'PROVEEDOR: ', 0, 0, 'L');
            $pdf->SetFont('', 'N', 14);
            $pdf->Cell(40, 7, $pedidos['prv_razon_social'], 0, 0, 'L');

            $pdf->Ln();
            $pdf->Ln();

            $pdf->SetFont('times', 'B', 12);
            $pdf->Cell(290, 3, 'DETALLE DE NOTA DE DEBITO NRO.:  ' . $pedidos['id_debito'], 0, 0, 'C', 0);
            $pdf->Ln();
            $pdf->Ln();

            $detalles = consultas::get_datos("select * from v_detalle_debito where id_debito=" . $pedidos['id_debito']);
            if (!empty($detalles)) {
                $pdf->SetFont('', 'B', 13);
                $pdf->SetFillColor(188, 188, 188);
                $pdf->Cell(20, 7, '', 0, 0, 'C');
                $pdf->Cell(110, 7, 'ARTICULO', 1, 0, 'C', 1);
                $pdf->Cell(110, 7, 'PRECIO UNIT', 1, 0, 'C', 1);
                $pdf->Cell(60, 7, 'CANTIDAD', 1, 0, 'C', 1);
                $pdf->Ln(); //salto

                $pdf->SetFont('', '', 12.5);
                $pdf->SetFillColor(255, 255, 255);

                foreach ($detalles as $detalle) {
                    $pdf->Cell(20, 7, '', 0, 0, 'C');
                    $pdf->Cell(110, 7, $detalle['pro_descri'], 1, 0, 'C', 1);
                    $pdf->Cell(110, 7, number_format($detalle['subtotal'], 0, ',', '.'), 1, 0, 'C', 1);
                    $pdf->Cell(60, 7, $detalle['cantidad'], 1, 0, 'C', 1);
                    $pdf->Ln();
                }
                $pdf->Ln();
                $pdf->SetFillColor(112, 174, 221);
                $pdf->SetTextColor(3, 26, 47);
                $pdf->Cell(19, 7, '', 0, 0, 'C');
                $pdf->Cell(350, 0, '-----------------------------------------------------------------------------------------------------------------------------'
                        . '------------------------------------------------------------------', 0, 1, 'L');
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
            }
        }
    } else {
        $pdf->SetFont('times', 'B', '14');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
    }
//SALIDA AL NAVEGADOR
}
$pdf->Output('reporte_notadebito.pdf', 'I');
?>
