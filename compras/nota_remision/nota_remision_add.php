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
                                <h3 class="box-title">Agregar Nota de Remision</h3>
                                <div class="box-tools">
                                    <a href="nota_remision_index.php" class="btn btn-toolbar pull-right">
                                        <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="nota_remision_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <div class="row">
                                        <input type="hidden" name="voperacion" value="1">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">N° Remision</label>
                                            <?php $pc = consultas::get_datos("SELECT COALESCE(MAX(id_remision),0)+1 AS ultimo FROM nota_remision") ?>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input class="form-control" type="text" name="vidremision" readonly="" value="<?php echo $pc[0]['ultimo']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Fecha</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input class="form-control" type="date" name="vfecha" readonly="" value="<?php echo date("Y-m-d"); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Nro de Timbrado</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input class="form-control" required="" type="text" name="vtimbrado" placeholder="INSERTE O DIGITE 8  DIGITOS" minlength="8" maxlength="8" value="" onkeypress="return soloNumero(event);">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Validez</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input class="form-control" type="date" onkeypress="return soloNum(event)" name="vvalidez" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Nro de Fact</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input class="form-control" type="text" placeholder=" FORMATO: 000-000-0000000" pattern="[0-9]{3}-[0-9]{3}-[0-9]{7}" title="Debe coincidir con el formato xxx-xxx-xxxxxxx" onkeypress="return SoloNum(event)" name="vnrofactura" required="">
                                            </div>
                                        </div>
                                        <input class="form-control" type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>" />
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Conductor</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input class="form-control" required="" type="text" name="vconductor" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Cedula</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input class="form-control" required="" type="text" onkeypress="return SoloNum(event)" name="vcedula" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Chapa</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input class="form-control" required="" type="text" name="vchapa" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Color</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input class="form-control" required="" type="text" onkeypress="soloLetras(event)" name="vcolor" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Modelo</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input class="form-control" required="" type="text" name="vmodelo" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Orden de Compra</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <?php $marcas = consultas::get_datos("SELECT * FROM orden_de_compra WHERE orden_estado = 'CONFIRMADO' ORDER BY nro_orden"); ?>
                                                <select class="form-control" id="factura" name="vorden" required="" onchange="tiposelect();obtenercomp();" onclick="obtenercomp();">
                                                    <option value="">Seleccione una Orden</option>>
                                                    <?php
                                                    if (!empty($marcas)) {
                                                        foreach ($marcas as $m) {
                                                    ?>
                                                            <option value="<?php echo $m['nro_orden']; ?>"><?php echo $m['nro_orden']; ?><?php echo '-'; ?><?php echo $m['orden_fecha']; ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value="">Debe seleccionar al menos una Orden</option>
                                                    <?php }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="box-body" id="fact_detalle">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <div class="box-header" style="text-align: center;">
                                                </div>

                                                <div id="notacomp">
                                                </div>
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

<script>
    function obtenercomp() {
        var dat = $('#factura').val().split("_");
        if (parseInt($('#factura').val()) > 0) {
            $.ajax({
                type: "GET",
                url: "/Taller/compras/nota_remision/nota_remision_orden.php?vidnota=" + dat[0],
                cache: false,
                beforeSend: function() {},
                success: function(msg) {
                    $('#notacomp').html(msg);
                }
            });
        }
    }
</script>
<script>
    function tiposelect() {
        if (document.getElementById('factura').value > 0) {
            detalle1 = document.getElementById('fact_detalle');
            detalle1.style.display = '';
        } else {

            //DETALLES
            detalle1 = document.getElementById('fact_detalle');
            detalle1.style.display = 'none';

        }
    }
    window.onload = tiposelect();
</script>

<script>
    function LetraNum(e) {
        var key = e.keyCode || e.which,
            tecla = String.fromCharCode(key).toLowerCase(),
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz0123456789-",
            especiales = [8],
            tecla_especial = false;

        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
    }

    function SoloNum(e) {
        var key = e.keyCode || e.which,
            tecla = String.fromCharCode(key).toLowerCase(),
            letras = "0123456789-",
            especiales = [8],
            tecla_especial = false;

        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
    }
</script>
<script>
    function soloLetras(event) {
        const inputTeclado = event.key;
        const expresionRegular = /^[a-zA-Z\s]*$/;
        // Permite teclas especiales como 'backspace', 'delete', 'arrow keys', etc.
        if (
            inputTeclado.length === 1 &&
            (expresionRegular.test(inputTeclado) || event.code.startsWith('Key'))
        ) {
            return true;
        } else {
            event.preventDefault();
            return false;
        }
    }
</script>

</HTML>