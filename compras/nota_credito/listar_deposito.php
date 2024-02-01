<?php
session_start();

require '../../conexion.php';
$idproducto = $_REQUEST['vidproducto'];
$productos = consultas::get_datos("SELECT * FROM v_detalle_compras WHERE pro_cod = " . $idproducto);

?>

<?php if (!empty($productos)) { ?>
    <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Deposito</label>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
        <input type="hidden" required="" readonly placeholder="Deposito" name="vdeposito" class="form-control" value="<?php echo $productos[0]['id_depo'] ?>">
        <input type="text" required="" readonly placeholder="Deposito" class="form-control" value="<?php echo $productos[0]['dep_descri'] ?>" id="iddeposito" style="width: 300px;">
    </div>
<?php } else { ?>
    <?php echo 'ERROR EN ASIGNACION DEL DEPOSITO'; ?>
<?php } ?>