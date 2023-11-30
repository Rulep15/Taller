<?php
session_start();
require '../../conexion.php';
$idpedido = $_REQUEST['vidnota'];
$compradetalle = consultas::get_datos("SELECT * FROM v_det_orden_compra WHERE nro_orden = $idpedido");
?>
<div id="detalles_fact" class="box-body no-padding">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <?php
        if (!empty($compradetalle)) {
        ?>
            <div class="table-responsive">
                <h3 style="text-align: center"><i class="fa fa-navicon"></i> Detalle de Orden de Compra</h3>
                <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">SubTotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($compradetalle as $dtc) { ?>
                            <tr>
                                <td class="text-center"> <?php echo $dtc['pro_descri']; ?></td>
                                <td class="text-center"> <?php echo $dtc['cantidad']; ?></td>
                                <td class="text-center"> <?php echo $dtc['precio_unit']; ?></td>
                                <td class="text-center"> <?php echo $dtc['cantidad'] * $dtc['precio_unit']; ?></td>
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