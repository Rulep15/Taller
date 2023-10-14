<?php session_start();

$gru = $_REQUEST['vidpresupuesto'];
?>
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
    <div id="wrapper" style="background-color: #1E282C;">
        <?php require '../../estilos/cabecera.ctp'; ?>
        <?php require '../../estilos/izquierda.ctp'; ?>
        <div class="content-wrapper" style="background-color: #1E282C;">
            <div class="content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-edit"></i>
                                <h3 class="box-title">Anular Pedido</h3>
                                <div class="box-tools">
                                    <a href="presupuesto_index.php?vpre=<?php echo $gru; ?>" class="btn btn-toolbar pull-right">
                                        <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="presupuesto_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <?php $resultado = consultas::get_datos("SELECT * FROM v_presupuesto WHERE id_presu =" . $_REQUEST['vidpresupuesto']); ?>
                                    <div class="form-group">
                                        <input class="form-control" type="hidden" name="voperacion" value="3">
                                        <input class="form-control" type="hidden" name="vidproveedor" value="3">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">N° de Pedido</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vidpedido" readonly="" value="<?php echo $resultado[0]['id_pedido']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-8">
                                                <input class="form-control" type="hidden" name="vusuario" readonly="" value="<?php echo $resultado[0]['usu_cod']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">N° de Presupuesto</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vidpresupuesto" readonly="" value="<?php echo $resultado[0]['id_presu']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Fecha</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vfecha" readonly="" value="<?php echo $resultado[0]['fecha']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Proveedor</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vidproveedore" readonly="" value="<?php echo $resultado[0]['prv_razon_social']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Validez</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vvalidez" readonly="" value="<?php echo $resultado[0]['validez']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Total Presupuesto</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vtotal" readonly="" value="<?php echo $resultado[0]['total']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            
                                            <div class="col-lg-8">
                                                <input class="form-control" type="hidden" name="vestado" readonly="" value="<?php echo $resultado[0]['estado']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer" style="text-align: right;">
                                    <button class="fa fa-remove btn btn-danger" type="submit">Anular</button>
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