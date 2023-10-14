<?php
session_start();
require '../../conexion.php';
$idpedido = $_REQUEST['vidpedido'];
$presupuestodetalle = consultas::get_datos("SELECT * FROM v_presupuesto WHERE estado = 'CONFIRMADO' AND prv_cod = $idpedido");
?>

<?php
if (!empty($presupuestodetalle)) {
    ?>
    <div class="form-group">
        <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Presupuesto</label>
        <div class="col-lg-4 col-sm-4 col-xs-4">
            <?php $marcas = consultas::get_datos("SELECT * FROM v_presupuesto WHERE estado = 'CONFIRMADO' ORDER BY prv_cod "); ?>
            <select  class="form-control"  name="vidpresupuesto" id="presupuesto" required="" onclick="obtenerpresu(); mostrarboton();" >
                <option id="valor" value="0"></option>
                <?php
                if (!empty($marcas)) {
                    foreach ($marcas as $m) {
                        ?>
                        <option value="<?php echo $m['id_presu']; ?>"><?php echo $m['id_presu']; ?><?php echo ' - '; ?><?php echo $m['fecha']; ?><?php echo '  '; ?><?php echo $m['descri']; ?></option>
                        <?php
                    }
                } else {
                    ?>
                    <option value="">Debe seleccionar al menos un Presupuesto</option>             
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
                <span class="glyphicon glyphicon-info-sign"></span> No contiene Presupuesto...
            </div>
        </div>
    </div>
<?php } ?>
