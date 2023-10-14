<?php
session_start();
require '../../conexion.php';
$idpedido = $_REQUEST['vidpedido'];
$presupuestodetalle = consultas::get_datos("SELECT * FROM v_orden_de_compra WHERE estado = 'CONFIRMADO' AND prv_cod = $idpedido");
?>

<?php
if (!empty($presupuestodetalle)) {
    ?>
    <div class="form-group">
        <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Orden de Compra</label>
        <div class="col-lg-4 col-sm-4 col-xs-4">
            <select  class="form-control"  name="vordenes" id="presupuesto" required="" onclick="obtenerpresu(); mostrarboton()" >
                <option id="valor" value="">Seleccione una Orden de Compra</option>
                <?php
                if (!empty($presupuestodetalle)) {
                    foreach ($presupuestodetalle as $m) {
                        ?>
                        <option value="<?php echo $m['nro_orden']; ?>"><?php echo $m['nro_orden']; ?><?php echo ' - '; ?><?php echo $m['fecha']; ?><?php echo '  '; ?></option>
                        <?php
                    }
                } else {
                    ?>
                    <option value="0">Debe seleccionar al menos un Presupuesto</option>             
                <?php }
                ?>
            </select>
        </div>
    </div> 
<?php } else { ?>
    <div class="form-group">
        <label class="  col-lg-3 col-sm-2 col-xs-2"></label>
        <div class="col-lg-4 col-sm-4 col-xs-4">
            <div class="alert alert-danger flat">
                <span class="glyphicon glyphicon-info-sign"></span> No contiene Orden de Compra...
            </div>
        </div>
    </div>
<?php } ?>
