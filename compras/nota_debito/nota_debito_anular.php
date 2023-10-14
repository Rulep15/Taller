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
                                    <h3 class="box-title">Anular Nota de Debito</h3>
                                    <div class="box-tools">
                                        <a href="nota_debito_index.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="nota_debito_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("SELECT * FROM v_nota_debito WHERE id_debito =" . $_GET['vidnota']); ?>
                                        <div class="form-group">
                                            <input class="form-control" type="hidden" name="voperacion" value="2">

                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Codigo de Nota de Debito</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" name="videbito" readonly="" value="<?php echo $resultado[0]['id_debito']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Fecha de Recibido</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" name="vfechareci" readonly="" value="<?php echo $resultado[0]['fecha_recibido']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php $usuario = consultas::get_datos("SELECT * FROM ref_usuario WHERE usu_cod=" . $resultado[0]['usu_cod']); ?>
                                                <label class="col-lg-2 control-label">Usuario</label>
                                                <div class="col-lg-8">
                                                    <input type="hidden" name="vusuario" value="<?php echo $usuario[0]['usu_cod']; ?>">

                                                    <input class="form-control" type="text" name="vusuarionick" readonly="" value="<?php echo $usuario[0]['usu_nick']; ?>">
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