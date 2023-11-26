<?php
session_start();

require '../../conexion.php';
$idproducto = $_REQUEST['vidpedido'];
$productos = consultas::get_datos("SELECT * FROM v_orden_de_compra WHERE orden_estado = 'CONFIRMADO' AND prv_cod = " . $idproducto);
?>

<?php if (!empty($productos)) { ?>
    <div class="form-group">
        <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Orden de compra</label>
        <div class="col-lg-4 col-sm-4 col-xs-4">
            <select class="form-control" name="vordenes" id="pedido" onchange="obtenerord();ver_boton_registrar()" onclick="obtenerord();ver_boton_registrar()">
                <option id="valor" value="">Debe seleccionar una Orden</option>
                <?php
                if (!empty($productos)) {
                    foreach ($productos as $m) {
                ?>
                        <option value="<?php echo $m['nro_orden']; ?>"><?php echo $m['nro_orden']; ?><?php echo ' | '; ?><?php echo $m['fecha']; ?></option>
                    <?php
                    }
                } else {
                    ?>
                <?php }
                ?>
            </select>
        </div>
    </div>
<?php } else { ?>
    <div id="detalles_fact" class="box-body no-padding">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="alert alert-danger flat">
                <span class="glyphicon glyphicon-info-sign"></span> El proveedor no tiene registros de orden.
            </div>
        </div>
    </div>
    <input type="hidden" id="presupuesto" value=0 onchange="obtenerpresu()" />
<?php } ?>