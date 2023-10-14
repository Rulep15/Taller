<?php
session_start();
require '../../conexion.php';
$idpedido = $_REQUEST['vidpedido'];
$detalleorden = consultas::get_datos("SELECT * FROM v_orden_detalle WHERE nro_orden = $idpedido");
?>
<div id="presu_detalle" class="box-body no-padding">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <?php
        
        if (!empty($detalleorden)) {
            ?>
            <div class="table-responsive">
                <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Cantidad</th> 
                            <th class="text-center">Subtotal</th> 
                            <th class="text-center">Iva 5%</th> 
                            <th class="text-center">Iva 10%</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detalleorden AS $dtc) { ?>
                            <tr>
                                <td class="text-center" id="prod"> <?php echo $dtc['pro_descri']; ?></td>
                                <td class="text-center" id="precio"> <?php echo $dtc['precioc']; ?></td>
                                <td class="text-center" id="canti"> <?php echo $dtc['cantidad']; ?></td>
                                <td class="text-center" id="subtotal"> <?php echo $dtc['subtotal']; ?></td>
                                <td class="text-center" id="iva5"> <?php echo $dtc['iva5']; ?></td>
                                <td class="text-center" id="iva10"> <?php echo $dtc['iva10']; ?></td>
                           </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger flat">
                <span class="glyphicon glyphicon-info-sign"></span> La Orden no tiene detalles...
            </div>
        <?php } ?>
    </div>
</div>