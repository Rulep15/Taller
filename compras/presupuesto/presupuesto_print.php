<?php

include '../../librerias/tcpdf/tcpdf.php';
require '../../conexion.php';

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
$pdf->SetAuthor('LUCAS');
$pdf->SetTitle('REPORTE DE PRESUPUESTO COMPRA');
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
$pdf->SetFont('times', 'B', 14);

// AGREGAR PAGINA
$pdf->AddPage('L', 'LEGAL');
//celda para titulo
$pdf->Cell(0, 0, "REPORTE DE PRESUPUESTO COMPRAS", 0, 1, 'C');
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





//consulta a la base de datos
$presupuestos = consultas::get_datos("select * from v_presupuesto "
                . "where id_presu=" . $_REQUEST['vidpresupuesto'] . " order by id_presu");

if (!empty($presupuestos)) {

    foreach ($presupuestos as $presupuesto) {
        $pdf->SetFont('', 'B', 10);
        //columnas

        $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(20, 5, '# ', 0, 0, 'C', 1);
            $pdf->Cell(40, 5, 'USUARIO',0 , 0, 'C', 1);
            $pdf->Cell(40, 5, 'PEDIDO',0 , 0, 'C', 1);
            $pdf->Cell(40, 5, 'PROVEEDOR', 0, 0, 'C', 1);
            $pdf->Cell(40, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(40, 5, 'ESTADO', 0, 0, 'C', 1);
            $pdf->Cell(40, 5, 'TOTAL', 0, 0, 'C', 1);

  $pdf->Ln();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('', '', 10);
        $pdf->Cell(20, 5, $presupuesto['id_presu'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $presupuesto['empleado'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $presupuesto['id_pedido']." - ". $presupuesto['fecha_pedido'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $presupuesto['prv_razon_social']." - ". $presupuesto['prv_cod'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $presupuesto['fechac'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $presupuesto['estado'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $presupuesto['total'], 0, 0, 'C', 1);
//           
        $pdf->Ln();
        $pdf->Ln();

        $detalles = consultas::get_datos("select * from v_detalle_presupuesto "
                        . "where id_presu=" . $presupuesto['id_presu'] . " order by id_presu");
        if (!empty($detalles)) {

            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(188, 188, 188);
              
             $pdf->Cell(20, 5, '#', 1, 0, 'C', 1);
            $pdf->Cell(80, 5, 'INSUMO', 1, 0, 'C', 1);
            $pdf->Cell(40, 5, 'CANTIDAD', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'PRECIO', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'SUBTOTAL', 1, 0, 'C', 1);
       
            $pdf->Ln(); //salto

            $pdf->SetFont('', '', 10);
            $pdf->SetFillColor(255, 255, 255);



            foreach ($detalles as $detalle) {

      $pdf->Cell(20, 5, $detalle['id_presu'], 1, 0, 'C', 1);
            
                $pdf->Cell(80, 5, $detalle['pro_descri'], 1, 0, 'C', 1);
                $pdf->Cell(40, 5, $detalle['cantidad'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, $detalle['precio_unit'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, $detalle['subtotal'], 1, 0, 'C', 1);
                $pdf->Ln();
            }
        } else {
            $pdf->SetFont('times', 'B', '14');
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(255, 0, 0);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
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
$pdf->Output('reporte_presupuesto_compra.pdf', 'I');
?>
