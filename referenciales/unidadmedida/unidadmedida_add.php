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
        <div id= wrapper style="background-color: #1E282C;">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color: #1E282C">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion-plus"></i>
                                    <h3 class="box-title">Agregar Unidad de Medida</h3>
                                    <div class="box-tools">
                                        <a href="unidadmedida_index.php" class="btn btn-toolbar pull-right">
                                        <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="unidadmedida_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion" value="1">
                                            <input type="hidden" name="vcodigo" value="0">
                                            <label class="col-lg-2 control-label">Unidad de Medida</label>
                                            <div class="col-lg-8">
                                                <input maxlength="30" class="form-control" type="text" name="vnombre" required="" autofocus="" onkeypress="return soloLetras(event);">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
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
    </body>
    <?php require '../../estilos/js_lte.ctp'; ?>
    <script>
    //LETRAS
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
</html>
