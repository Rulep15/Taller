<?php

include '../../../librerias/tcpdf/tcpdf.php';
require '../../../conexion.php';

class MYPDF extends TCPDF {

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 0, 'T.A.                                                                                                                                                                                                     '
                . '' . ' Pag. ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }

}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, TRUE, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Lucas');
$pdf->SetTitle('Reporte de Proveedor');
$pdf->SetSubject('TCPDF TUTORIAL');
$pdf->SetKeywords('TCDPDF, PDF, example');
$pdf->SetPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->SetHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->SetFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//Se repite porque uno es del margen y otro es del salto automatico
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//tipo de letra 
$pdf->SetFont('times', 'B', 16);
//Agregar pagina
$pdf->AddPage('L', 'LEGAL');
//Formato de titulo
$pdf->SetFillColor(180, 180, 180);
$pdf->Cell(0, 0, "Reporte de Proveedor", 0, 1, 'C');
$pdf->Ln();
$pdf->Cell(60, 5, "Nombre", 1, 0, 'C', 1);
$pdf->Cell(50, 5, "Ciudad", 1, 0, 'C', 1);
$pdf->Cell(70, 5, "RUC", 1, 0, 'C', 1);
$pdf->Cell(100, 5, "Direccion", 1, 0, 'C', 1);
$pdf->Cell(50, 5, "Telefono", 1, 0, 'C', 1);
//Salto de linea 
$pdf->Ln();
//tabla
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(255, 255, 255);

if ($_REQUEST['vopcion'] == '1') {
    $sqls = consultas::get_datos("SELECT * FROM v_ref_proveedor WHERE id_ciudad=" . $_REQUEST['vciudad'] . "ORDER BY prv_cod");
    if (!empty($sqls)) {
        foreach ($sqls AS $sql) {
            $pdf->Cell(60, 5, $sql['prv_razon_social'], 1, 0, 'C', 1);
            $pdf->Cell(50, 5, $sql['ciu_descri'], 1, 0, 'C', 1);
            $pdf->Cell(70, 5, $sql['prv_ruc'], 1, 0, 'C', 1);
            $pdf->Cell(100, 5, $sql['prv_direccion'], 1, 0, 'C', 1);
            $pdf->Cell(50, 5, $sql['prv_tel'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
    } else {
        $pdf->SetFont('times', '', '10');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
    }
}
//Salida al navegador
$pdf->Output('Reporte_proveedor.pdf', 'I');
?>
