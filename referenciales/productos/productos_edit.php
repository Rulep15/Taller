<?php session_start(); ?>
<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta content="width=devicewidth, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        include '../../conexion.php';
        require '../../estilos/css_lte.ctp';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-purple sidebar-mini">
        <div class="wrapper" style="background-color:#1e282c;">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color: #1E282C;">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-edit"></i>
                                    <h3 class="box-title">Modificar Producto</h3>
                                    <div class="box-tools">
                                        <a href="productos_index.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="productos_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("SELECT * FROM v_ref_producto WHERE pro_cod =" . $_GET['vidproducto']); ?>
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion"  value="2">
                                            <input type="hidden" name="vidproducto" value="<?php echo $resultado[0]['pro_cod']; ?>"/> 
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Codigo B.</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="number" name="vcodigob" required="" value="<?php echo $resultado[0]['codigo_barra']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Descripcion</label>
                                                <div class="col-lg-8">
                                                    <input maxlength="250" class="form-control" type="text" name="vdescripcion" required=""  onkeypress="return soloLetras(event);" value="<?php echo $resultado[0]['pro_descri']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Precio Compra</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="number" name="vprecioc" required="" value="<?php echo $resultado[0]['precio_costo']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Precio Venta</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="number" name="vpreciov" required="" value="<?php echo $resultado[0]['precio_venta']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">Marcas</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $marcas = consultas::get_datos("SELECT * FROM ref_marca ORDER BY mar_cod"); ?>
                                                        <select class="select2" name="vidmarca" required="" style="width: 320px;">  
                                                            <?php
                                                            if (!empty($marcas)) {
                                                                foreach ($marcas as $m) {
                                                                    ?>
                                                                    <option value="<?php echo $m['mar_cod']; ?>"><?php echo $m['mar_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos una marca</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">Tipo</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $tipoprod = consultas::get_datos("SELECT * FROM ref_tipo_producto ORDER BY id_tipro"); ?>
                                                        <select class="select2" name="vidtipro" required="" style="width: 320px;">
                                                            <?php
                                                            if (!empty($tipoprod)) {
                                                                foreach ($tipoprod as $tp) {
                                                                    ?>
                                                                    <option value="<?php echo $tp['id_tipro']; ?>"><?php echo $tp['tipro_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos un tipo</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">Impuesto</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $tipoimp = consultas::get_datos("SELECT * FROM ref_tipo_impuesto ORDER BY id_timp"); ?>
                                                        <select class="select2" name="vidtimp" required="" style="width: 320px;">
                                                            <?php
                                                            if (!empty($tipoimp)) {
                                                                foreach ($tipoimp as $tim) {
                                                                    ?>
                                                                    <option value="<?php echo $tim['id_timp']; ?>"><?php echo $tim['descripcion']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos un tipo</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">U.Medida</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $Unidad = consultas::get_datos("SELECT * FROM ref_unidadmedida ORDER BY id_um"); ?>
                                                        <select class="select2" name="vidum" required="" style="width: 320px;">
                                                            <?php
                                                            if (!empty($Unidad)) {
                                                                foreach ($Unidad as $um) {
                                                                    ?>
                                                                    <option value="<?php echo $um['id_um']; ?>"><?php echo $um['descripcion']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos un tipo</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Imagen</label>
                                                <div class="col-lg-8">
                                                    <input maxlength="100" class="form-control" type="file" name="vimagen" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: center;">
                                        <button class="fa fa-save btn btn-success pull-right" type="submit"> Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require '../../estilos/pie.ctp'; ?>
    </BODY>
    <?php require '../../estilos/js_lte.ctp'; ?>
    <script>
             function soloLetras(e)
    {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toString();
        letras = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzáéíóú";

        especiales = [8, 13, 32];
        tecla_especial = false
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial)
        {
            //alert("Ingresar solo letras");
            return false;
        }
    }
    </script>
</HTML>