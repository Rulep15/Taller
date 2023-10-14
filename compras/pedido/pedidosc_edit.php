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
    <div id="wrapper">
        <?php require '../../estilos/cabecera.ctp'; ?>
        <?php require '../../estilos/izquierda.ctp'; ?>
        <div class="content-wrapper" style="background-color: #1E282C;">
            <div class="content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-edit"></i>
                                <h3 class="box-title">Modificar Pedido</h3>
                                <div class="box-tools">
                                    <a href="pedidosc_index.php" class="btn btn-toolbar pull-right">
                                        <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="pedidosc_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <?php $resultado = consultas::get_datos("SELECT * FROM v_compras_pedido WHERE id_pedido =" . $_GET['vidpedido']); ?>
                                    <div class="form-group">
                                        <input class="form-control" type="hidden" name="voperacion" value="2">
                                        <input class="form-control" name="vidpedido" type="hidden" value="<?php echo $resultado[0]['id_pedido']; ?>">
                                        <input class="form-control" name="vusuario" type="hidden" value="<?php echo $resultado[0]['usu_cod']; ?>">
                                        <input class="form-control" name="vfecha" type="hidden" value="<?php echo $resultado[0]['fechac']; ?>">
                                        <input class="form-control" name="vestado" type="hidden" value="<?php echo $resultado[0]['estado']; ?>">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Descripcion</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vdescri" required="" value="<?php echo $resultado[0]['descri']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer" style="text-align: right;">
                                    <button class="fa fa-save btn btn-success" type="submit"> Guardar</button>
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