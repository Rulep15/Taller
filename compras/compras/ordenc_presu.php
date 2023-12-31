<?php
session_start();
require '../../conexion.php';
$idpedido = $_REQUEST['vidorden'];
$presupuestodetalle = consultas::get_datos("SELECT * FROM v_det_orden_compra WHERE nro_orden = $idpedido");

?>

<?php
if ($idpedido == 0) {
    echo '';
} else {



    if (!empty($presupuestodetalle)) {
?>
        <div class="table-responsive">
            <h3 style="text-align: center"><i class="fa fa-navicon"></i> Detalle de Orden de Compra</h3>
            <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Producto</th>
                        <th class="text-center">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($presupuestodetalle as $pcd) { ?>
                        <tr>
                            <td class="text-center" id="prod"> <?php echo $pcd['pro_descri']; ?></td>
                            <td class="text-center" id="canti"> <?php echo $pcd['cantidad']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger flat">
            <span class="glyphicon glyphicon-info-sign"></span> La Orden de Compra no tiene detalles...
        </div>
    <?php } ?>
<?php } ?>