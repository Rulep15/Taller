<?php session_start() ?>

<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=devicewidth, initial-scale=1, maximum-scalable=no"name="viewport">
    </head>
    <?php
    include '../../conexion.php';
    require '../../estilos/css_lte.ctp';
    ?>
    <body class="hold-transition skin-purple sidebar-mini">
        <div id= wrapper style="background-color: #1E282C">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color: #1E282C;">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-trash-b"></i>
                                    <h3 class="box-title">Borrar Unidad de Medida</h3>
                                    <div class="box-tools">
                                        <a href="unidadmedida_index.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="unidadmedida_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <?php $resultado = consultas::get_datos("SELECT * FROM ref_unidadmedida WHERE id_um=" . $_GET['vid_unidad']); ?>
                                            <input type="hidden" name="voperacion" value="3">
                                            <input type="hidden" name="vcodigo" value="<?php echo $resultado[0]['id_um'];?>"/>
                                            <label class="col-lg-2 control-label">Nombre</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vnombre" required="" value="<?php echo $resultado[0]['descripcion']; ?>"
                                                       disabled="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
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
    </body>
    <?php require '../../estilos/js_lte.ctp'; ?>
</html>


