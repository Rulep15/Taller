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
        <div id="wrapper" style="background-color: #1E282C">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color: #1E282C;">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-trash-b"></i>
                                    <h3 class="box-title">Borrar Cliente</h3>
                                    <div class="box-tools">
                                        <a href="cliente_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="cliente_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("SELECT * FROM v_ref_cliente WHERE id_cliente =" . $_GET['vidcliente']); ?>
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion"  value="3">
                                            <input type="hidden" name="vcodigo" value="<?php echo $resultado[0]['id_cliente']; ?>"/> 
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Persona</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" name="vci"  readonly="" required="" value="<?php echo $resultado[0]['id_persona']; ?>">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="col-lg-2 control-label">CI</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" name="vci"  readonly="" required="" value="<?php echo $resultado[0]['cli_ci']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Nombre</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" name="vnombre" readonly="" required="" min="0" value="<?php echo $resultado[0]['nombres']; ?>">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: center;">
                                        <button class="fa fa-remove btn btn-danger pull-right" type="submit"> Inhabilitar</button>
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