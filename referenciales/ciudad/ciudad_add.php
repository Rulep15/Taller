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
                            <?php if (!empty($_SESSION['mensaje'])) { ?>
                                <?php
                                $mensaje = explode("_/_", $_SESSION['mensaje']);
                                if (($mensaje[0] == 'NOTICIA')) {
                                    $class = "success";
                                } else {
                                    $class = "danger";
                                }
                                ?>
                                <div class="alert alert-<?= $class; ?>" role="alert" id="mensaje">
                                    <i class="ion ion-information-circled"></i>
                                    <?php
                                    echo $mensaje[1];
                                    $_SESSION['mensaje'] = '';
                                    ?>
                                </div>
                            <?php } ?>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Agregar Ciudad</h3>
                                    <div class="box-tools">
                                        <a href="ciudad_index.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="ciudad_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class="row">
                                            <input type="hidden" name="voperacion"  value="1">
                                            <input type="hidden" name="vidciudad" value="0"/> 
                                            <!--CIUDAD-->
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Ciudad</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="text" name="vciudescri" required="" style="width: 500px;" onkeypress="return soloLetras(event);" 
                                                           autofocus="" maxlength="30">
                                                </div>
                                            </div>
                                            <!--PAIS-->
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">País</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $pais = consultas::get_datos("SELECT * FROM ref_pais ORDER BY id_pais"); ?>
                                                        <select class="select2" name="vidpais" required="" style="width: 500px;">
                                                            <?php
                                                            if (!empty($pais)) {
                                                                foreach ($pais as $p) {
                                                                    ?>
                                                                    <option value="<?php echo $p['id_pais']; ?>"><?php echo $p['pai_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos un pais</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-toolbar btn-flat btn-sm" type="button" data-toggle="modal" data-target="#registrar_pais">
                                                                <i style="color: #465F62" class="fa fa-plus"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: center;">
                                        <button class=" fa fa-save btn btn-success  pull-right" type="submit"> Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--MODAL DE PAIS-->
                <div class="modal fade" id="registrar_pais" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Registrar Pais</strong></h4>
                            </div>
                            <form action="ciudad_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input name="voperacion" value="4" type="hidden">
                                <input name="vidpais" value="0" type="hidden" id="vidmarca">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Descripcion</label>
                                        <div class="col-xs-10 col-md-10 col-lg-10">
                                            <input type="text" class="form-control" name="vciudescri" required="" autofocus="" id="descripcion" maxlength="30" onkeypress="return soloLetras(event);">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="reset" data-dismiss="modal" class="fa fa-close btn btn-danger" id="cerrar_agregar1"> Cerrar</button>
                                    <button type="submit" class="fa fa-save btn btn-success pull-right"> Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

        </div>
    </div>
    <?php require '../../estilos/pie.ctp'; ?>
</BODY>
<?php require '../../estilos/js_lte.ctp'; ?>
<script>
    /*MENSAJE DE INSERT MARCAS, TIPO,. ETC*/
    $("#mensaje").delay(1000).slideUp(200, function () {
        $(this).alert('close');
    });

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

    //focus en el primer input pais
    $(document).ready(function () {
        $('#registrar_pais').on('shown.bs.modal', function () {
            $('#descripcion').focus();
        });
    });

    //LIMPIAR AUTOMÁTICO pais
    $("#cerrar_agregar, #cerrar_agregar1").click(function () {
        $('#descripcion').val("");
    });
</script>
</HTML>
