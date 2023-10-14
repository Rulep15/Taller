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
        <div class="wrapper" style="background-color:#1e282c">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color: #1E282C;">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-trash-b"></i>
                                    <h3 class="box-title">Borrar Producto</h3>
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
                                            <input type="hidden" name="voperacion"  value="3">
                                            <input type="hidden" name="vidproducto" value="<?php echo $resultado[0]['pro_cod']; ?>"/> 
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Codigo Barra</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <input class="form-control" type="text" name="codigob" required="" disabled="" value="<?php echo $resultado[0]['codigo_barra']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Nombre</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <input class="form-control" type="text" name="vnombre" required="" disabled="" value="<?php echo $resultado[0]['pro_descri']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Marca</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <input class="form-control" type="text" name="vidmarca" required="" disabled="" value="<?php echo $resultado[0]['mar_descri']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Tipo</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <input class="form-control" type="text" name="vidtipro" required="" disabled="" value="<?php echo $resultado[0]['tipro_descri']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: center;">
                                        <button class="fa fa-trash btn btn-danger pull-right" type="submit"> Borrar</button>
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
</HTML>