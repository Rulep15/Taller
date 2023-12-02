<?php
session_start();

require '../../conexion.php';
$idproducto = $_REQUEST['vidpedido'];
$productos = consultas::get_datos("SELECT * FROM v_nota_remision WHERE estado = 'CONFIRMADO' ORDER BY id_remision"); ?>

<?php if (!empty($productos)) { ?>
    <div class="form-group">
        <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Nota de Remision</label>
        <div class="col-lg-4 col-sm-4 col-xs-4">
            <select class="form-control" name="vidremision" id="notarda" onchange=" obtenernota();ver_boton_registrar1()" onclick="obtenernota();ver_boton_registrar1()">
                <option id="notes" value="">Debe seleccionar una Nota de Remision</option>
                <?php
                if (!empty($productos)) {
                    foreach ($productos as $m) {
                ?>
                        <option value="<?php echo $m['id_remision']; ?>"><?php echo $m['id_remision']; ?><?php echo ' | '; ?><?php echo $m['fecha']; ?></option>
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