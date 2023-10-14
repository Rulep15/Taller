<?php
session_start();
require '../../conexion.php';
$idpedido = $_REQUEST['vidpresupuesto'];
$compradetalle = consultas::get_datos("SELECT * FROM v_compras_pedidos_detalle WHERE id_pedido = $idpedido");
?>
<div id="detalles_fact" class="box-body no-padding">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <?php
        if (!empty($compradetalle)) {
            ?>
            <div class="table-responsive">
                <h3 style="text-align: center"><i class="fa fa-navicon"></i> Detalle de Pedido</h3>
                <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Deposito</th>
                            <th class="text-center">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($compradetalle AS $dtc) { ?>
                            <tr>
                                <td class="text-center"> <?php echo $dtc['pro_descri']; ?></td>
                                <td class="text-center"> <?php echo $dtc['dep_descri']; ?></td>
                                <td class="text-center"> <?php echo $dtc['cantidad']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger flat">
                <span class="glyphicon glyphicon-info-sign"></span> El Pedido no tiene detalles...
            </div>
        <?php } ?>
    </div>
</div>