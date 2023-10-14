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
                                <h3 class="box-title">Agregar Proveedores</h3>
                                <div class="box-tools">
                                    <a href="proveedor_index.php" class="btn btn-toolbar pull-right">
                                        <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="proveedor_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <div class="row">
                                        <input type="hidden" name="voperacion" value="1">
                                        <input type="hidden" name="vcodigo" value="0" />



                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Ciudad</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                                <div class="input-group">
                                                    <?php $ciudad = consultas::get_datos("SELECT * FROM ref_ciudad ORDER BY id_ciudad"); ?>
                                                    <select class="select2" name="vciudad" required="" style="width: 320px;">
                                                        <?php
                                                        if (!empty($ciudad)) {
                                                            foreach ($ciudad as $ciu) {
                                                        ?>
                                                                <option value="<?php echo $ciu['id_ciudad']; ?>"> <?php echo $ciu['ciu_descri']; ?> </option>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos una ciudad</option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-toolbar btn-flat" type="button" data-toggle="modal" data-target="#registrar_ciudad">
                                                            <i style="color: #465F62" class="fa fa-plus"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Razon Social</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input maxlength="30" class="form-control" type="text" name="vrazon" required="" placeholder="Ingresar Razon Social">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">RUC</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input maxlength="15" class="form-control" onkeypress="return soloNumero(event)" type="number" name="vruc" required="" min="0">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Direccion</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input maxlength="100" class="form-control" type="text" name="vdireccion" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Telefono</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input maxlength="30" class="form-control" onkeypress="return soloNumero(event)" type="number" name="vtelefono" required="" min="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer" style="text-align: center;">
                                    <button class="fa fa-save btn btn-success pull-right" type="submit"> Guardar</button>
                                </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--MODAL DE CIUDAD-->
        <div class="modal fade" id="registrar_ciudad" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Registrar Ciudad</strong></h4>
                    </div>
                    <form action="proveedor_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                        <input name="voperacion" value="4" type="hidden">
                        <input name="vcodigo" value="0" type="hidden">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">Ciudad</label>
                                <input class="form-control" type="text" name="vciudescri" required="" style="width: 500px;" onkeypress="return soloLetras(event);" autofocus="" maxlength="30">
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">País</label>
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
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="reset" data-dismiss="modal" class="fa fa-remove btn btn-danger" id="cerrar_ciudad"> Cerrar</button>
                            <button type="submit" class="fa fa-save btn btn-success pull-right"> Guardar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--MODAL DE CIUDAD-->



    </div>
    </div>
    <?php require '../../estilos/pie.ctp'; ?>
</BODY>
<?php require '../../estilos/js_lte.ctp'; ?>
<script>
    /*MENSAJE DE INSERT ciudad, CARGO,. ETC*/
    $("#mensaje").delay(1000).slideUp(200, function() {
        $(this).alert('close');
    });
    /*Focus en el primer input de ciudad*/
    $(document).ready(function() {
        $('#registrar_ciudad').on('shown.bs.modal', function() {
            $('#vpaisdescri, #vciudescri').focus();
        });
    });
    /*limpiar campos al cerrar nuestro modal persona*/
    $("#cerrar_ciudad").click(function() {
        $('#vpaisdescri, #vciudescri').val("");
    });
</script>
<script>
    //LETRAS
    function soloLetras(e) {
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

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            //alert("Ingresar solo letras");
            return false;
        }
    }
</script>
<script>
    function soloNumero(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toString();
        letras = "0123456789-";

        especiales = [];
        tecla_especial = false
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            //alert("Ingresar solo letras");
            return false;
        }
    }
</script>

</HTML>