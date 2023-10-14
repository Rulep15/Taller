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
            <div class="content-wrapper" style="background-color: #1E282C">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-trash-b"></i>
                                    <h3 class="box-title">Borrar Sucursal</h3>
                                    <div class="box-tools">
                                        <a href="sucursal_index.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="sucursal_control.php" method="POST"  accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("SELECT * FROM v_ref_sucursal WHERE id_sucursal =" . $_GET['vidsucursal']); ?>
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion"  value="3">
                                            <input type="hidden" name="vcodigo" value="<?php echo $resultado[0]['id_sucursal']; ?>"/> 
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Ciudad</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" readonly="" name="vsucursal" required="" value="<?php echo $resultado[0]['id_ciudad']; ?>">
                                                </div>
                                            </div>
                                             
                                             <div class="form-group">
                                                <label class="col-lg-2 control-label">Sucursal</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" readonly="" name="vsucursal" required="" value="<?php echo $resultado[0]['suc_descri']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Telefono</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="number"  readonly="" name="vtelefono" required="" min="0" value="<?php echo $resultado[0]['suc_telefono']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Direccion</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" readonly="" name="vdireccion" required="" value="<?php echo $resultado[0]['suc_direccion']; ?>">
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