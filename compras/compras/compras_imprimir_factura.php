<?php
include '../../librerias/tcpdf/tcpdf.php';
include_once '../../conexion.php';

$sqlcompras = "select *,(select sp_numero_letras(com_total::numeric)) as total_letra from v_compras where id_compra = " . $_REQUEST ['vidcompra'] . " order by 1";
$rscompras = consultas::get_datos($sqlcompras);

$pdf = new TCPDF('P', 'mm', 'A4');
$pdf->SetMargins(15, 15, 18);
$pdf->SetTitle('FACTURA COMPRA');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

$pdf->AddPage();

$pdf->Ln(5);
$pdf->SetFont('Times', 'B', 18);
$pdf->Cell(85, 1, 'T.A', 0, 0, 'C',null,null,1);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(85, 1, 'COMPRAS Y SERVICIOS', 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFont('Times', '', 12);
$pdf->Cell(95, 1, 'Dirección: Juan Pablo II N°151 c/Mcal. Estigarribia', 0, 0, 'L');
$pdf->Cell(85, 1, 'Factura de Compra', 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(85, 1, 'Teléfono: 0991 781 666', 0, 0, 'C');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(50, 1, '   Nro: ', 0, 0, 'C');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(70, 1, $rscompras[0]['id_compra'],0, 0,'L');

$pdf->SetFont('Times', '', 12);
$pdf->Ln(5);
$pdf->Cell(85, 1, 'Timbrado N°: ' . '1', 0, 0, 'C');
$pdf->Cell(50, 1, '   Factura N°: ', 0, 0, 'C');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(70, 1, $rscompras[0]['com_nro_factura'],0, 0,'L');
$pdf->Ln(5);
$pdf->Cell(85, 1, 'Vigencia: ' . '30-09-2022', 0, 0, 'C');

$style6 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0));

$pdf->RoundedRect(15, 12, 90, 42, 6.0, '1111', '', $style6, array(200, 200, 200));
$pdf->RoundedRect(105, 12, 87, 42, 6.0, '1111', '', $style6, array(200, 200, 200));


$pdf->RoundedRect(15, 55, 177, 20, 5.0, '1111', '', $style6, array(200, 200, 200));

//datos de cabecera
$pdf->Ln(15);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, '   FECHA: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/90, /*2*/1, /*3*/$rscompras[0]['com_fecha'], /*4*/0, /*5*/1, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
$pdf->Ln(3);

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, '   PROVEEDOR: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/90, /*2*/1, /*3*/$rscompras[0]['prv_razon_social'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 1, 'RUC o CI: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(90, 1, $rscompras[0]['prv_cod'], 0, 1, 'L');

//cuadro de detalles
$pdf->RoundedRect(15, 75, 178, 155, 5.0, '1111', '', $style6, array(200, 200, 200));

$pdf->Ln(10);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(15, 1, '#', 0, 0, 'C');
$pdf->Cell(30, 1, 'Descripcion', 0, 0, 'L');
$pdf->Cell(15, 1, 'Cant.', 0, 0, 'C');
$pdf->Cell(25, 1, 'Precio Unit', 0, 0, 'R');
$pdf->Cell(20, 1, 'Subtotal', 0, 0, 'R');
$pdf->Cell(20, 1, 'IVA 5', 0, 0, 'R');
$pdf->Cell(20, 1, 'IVA 10', 0, 0, 'R');
$pdf->Cell(20, 1, 'Exentas', 0, 0, 'R');
$pdf->Ln(5);

$consultas = "select * from v_detalle_compras where id_compra=".$_REQUEST ['vidcompra'];
$detcompras = consultas::get_datos($consultas);

foreach ($detcompras as $report) {
    $pdf->SetFont('Times', '', 10);
    $pdf->Cell(15, 1, $report['pro_cod'], 0, 0, 'C');
    $pdf->Cell(30, 1, /*3*/$report['pro_descri'], 0, 0,'L',null,null,1,null,null,null);
    $pdf->Cell(15, 1,$report['cantidad'] , 0, 0, 'C');
    $pdf->Cell(22, 1, number_format(($report['precio_unit']),0,',','.'), 0, 0, 'R');
    $pdf->Cell(22, 1, number_format(($report['subtotal']),0,',','.'), 0, 0, 'R');
    $pdf->Cell(18, 1, number_format(($report['iva5']),0,',','.'), 0, 0, 'R');
    $pdf->Cell(22, 1, number_format(($report['iva10']),0,',','.'), 0, 0, 'R');
    $pdf->Cell(18, 1, number_format(($report['exentas']),0,',','.'), 0, 1, 'R');
}
$posicion = $pdf->GetY();
$pdf->Line(190,230,15,$posicion);

$pdf->RoundedRect(15, 230, 177, 30, 4.0, '1111', '', $style6, array(200, 200, 200));

$pdf->SetFont('Times', '', 10);
$pdf->Text(18, 235, 'TOTAL IVA');
$pdf->SetFont('Times', '', 10);
$pdf->Text(165, 235, 'Gs. '.($rscompras[0]['com_totaliva']));

$pdf->SetFont('Times', 'B', 10);
$pdf->Text(18, 243, 'TOTAL GENERAL');
$pdf->SetFont('Times', '', 10);
$pdf->Text(165, 243, 'Gs. '.($rscompras[0]['com_total']));

$pdf->SetFont('Times', 'B', 10);
$pdf->Text(18, 251, 'TOTAL EN LETRAS');
$pdf->SetFont('Times', '', 10);
$pdf->Text(55, 251, 'Son Gs. '.
        ucfirst(strtolower ($rscompras[0]['total_letra'])));

$pdf->Output('facturacompras.pdf', 'I');
