<?php
include '../../librerias/tcpdf/tcpdf.php';
require '../../conexion.php';

class MYPDF extends TCPDF{
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 0, 'Pag. '. $this->getAliasNumPage(). '/'.
            $this->getAliasNbPages(), 0, false, 'R',0, '', 0, false, 'T','M');
    }
}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, TRUE, 'UTF-8', FALSE);
$pdf->setCreator(PDF_CREATOR);
$pdf->SetAuthor('Lucas');
$pdf->SetTitle('REPORTE DE MARCA');
$pdf->SetSubject('TCPDF TUTORIAL');
$pdf->SetKeywords('TCPDF, PDF, example');
$pdf->setPrintHeader(false);
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT );
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);
//SE REPITE POR QUE UNO ES DE MARGEN Y EL OTRO ES DE SALTO AUTOMATICO
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//TIPO DE LETRAS
$pdf->SetFont('times', 'B', 14);
//AGREGAR UNA PAGINA
$pdf->AddPage('P', 'LEGAL');
//FORMATO DE TITULO
$pdf->Cell(0, 0, "REPORTE DE MARCA", 0, 1, 'C');
//SALTO DE LINEA
$pdf->ln();
//TABLA 
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(255, 255, 255);
//CONSULTA LA BASE DE DATOS
$sqls=  consultas::get_datos("SELECT * FROM ref_marca ORDER BY mar_cod");
foreach ($sqls AS $sql){
    $pdf->Cell(80, 5, $sql['mar_cod'], 1, 0, 'C', 1);
    $pdf->Cell(80, 5, $sql['mar_descri'], 1, 0, 'C', 1);
    $pdf->Ln();
}
//SALIDA AL NAVEGADOR
$pdf->Output('reporte_marca.pdf', 'I');
?>

