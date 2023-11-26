<?php
session_start();
require '../../conexion.php';
$idpedido = $_REQUEST['vidorden'];
if ($idpedido > 0) {
    $orden = consultas::get_datos("SELECT * FROM v_detalle_remision WHERE id_remision = $idpedido");
} else {
    $orden = 0;
}
?>
<?php
if ($idpedido == 0) {
    echo '';
} else {
    if (!empty($presupuestodetalle)) {
?>
        <div class="table-responsive">
            <h3 style="text-align: center"><i class="fa fa-navicon"></i> Detalle de Nota de Remision</h3>
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
            <span class="glyphicon glyphicon-info-sign"></span> La Nota de Remision no tiene detalles...
        </div>
    <?php } ?>
<?php } ?>