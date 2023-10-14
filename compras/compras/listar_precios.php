<?php

session_start();
require '../../conexion.php';
$idproducto = $_REQUEST['vidproducto'];
$productos = consultas::get_datos("SELECT * FROM ref_producto WHERE pro_cod =" . $idproducto);
?>

<?php if (!empty($productos)) { ?>
    <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Precio</label>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
        <input type="number" required="" min="5000" max="10000000" placeholder="Precio del Articulo" class="form-control" name="vprecio" value="<?php echo $productos[0]['precio_costo'] ?>" id="idprecio1" min="1" style="width: 300px;">
    </div>
<?php } else { ?>
    <?php echo 'ERROR EN PRECIO'; ?>
<?PHP } ?>