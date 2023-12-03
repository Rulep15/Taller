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
                                <h3 class="box-title">Agregar Nota de Credito</h3>
                                <div class="box-tools">
                                    <a href="nota_credito_index.php" class="btn btn-toolbar pull-right">
                                        <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="nota_debito_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <div class="row">
                                        <input type="hidden" name="operacion" value="1">
                                        <div class="form-group">
                                            <label class="control-label col-lg-3 col-sm-2 col-xs-2">N° Nota Debito</label>
                                            <?php $pc = consultas::get_datos("SELECT COALESCE(MAX(id_debito),0)+1 AS ultimo FROM nota_debito") ?>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" name="videbito" readonly="" value="<?php echo $pc[0]['ultimo']; ?>">
                                            </div>
                                        </div>
                                        <input class="form-control" type="hidden" name="vfechasis" readonly="" value="<?php echo date("Y-m-d"); ?>">
                                        <div class="form-group">
                                            <label class="control-label col-lg-3 col-sm-2 col-xs-2">Fecha</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="date" name="vfechareci" value="<?php echo date("Y-m-d"); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Nro. de factura</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" placeholder=" FORMATO: 000-000-0000000" pattern="[0-9]{3}-[0-9]{3}-[0-9]{7}" title="Debe coincidir con el formato xxx-xxx-xxxxxxx" onkeypress="return SoloNum(event)" name="vnrofactura" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-3 col-sm-2 col-xs-2">Personal</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" readonly="" name="vusuario" value="Lucas Vietsky" />
                                                <input class="form-control" type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>" />
                                                <input class="form-control" type="hidden" name="vusunick" readonly="" value="<?php echo $_SESSION['usu_nick']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-3 col-sm-2 col-xs-2">Motivo</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <?php $productos = consultas::get_datos("SELECT * FROM motivo_nota WHERE id_tipo_n = 1") ?>
                                                <select class="form-control" name="vidmotivo" required="">
                                                    <option value="0">Seleccione un Motivo</option>
                                                    <?php
                                                    if (!empty($productos)) {
                                                        foreach ($productos as $producto) {
                                                    ?>
                                                            <option value="<?php echo $producto['id_moti']; ?>"><?php echo $producto['descripcion']; ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value="">Debe insertar registros...</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-3 col-sm-2 col-xs-2">Monto</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" required="" type="number" name="vmonto" min="1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Timbrado</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" maxlength="8" minlength="8" placeholder="INSERTE 8 DIGITOS" onkeypress="return SoloNum(event)" name="vtimbrado" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Validez timbrado</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="date" onkeypress="return SoloNum(event)" name="vvalidez" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Seleccione una Fact de Compra: </label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <?php $marcas = consultas::get_datos("SELECT * FROM v_compras ORDER BY id_compra"); ?>
                                                <select class="form-control" name="vcompra" id="factura" required="" onchange="tiposelect();obtenercomp();" onclick="obtenercomp();">
                                                    <option value="">Seleccione una Factura de Compra</option>>

                                                    <?php
                                                    if (!empty($marcas)) {
                                                        foreach ($marcas as $m) {
                                                    ?>
                                                            <option value="<?php echo $m['id_compra']; ?>"><?php echo $m['com_nro_factura']; ?><?php echo ' - ' ?><?php echo $m['prv_razon_social']; ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value="">Debe seleccionar al menos un Nro de Compra</option>
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
    /*MENSAJE DE INSERT MARCAS, TIPO,. ETC*/
    $("#mensaje").delay(1000).slideUp(200, function() {
        $(this).alert('close')
    })

    function tiposelect() {
        if (document.getElementById('factura').value > 0) {
            detalle1 = document.getElementById('fact_detalle');
            detalle1.style.display = '';
        } else {

            detalle1 = document.getElementById('fact_detalle');
            detalle1.style.display = 'none';


        }
    }
    window.onload = tiposelect();
</script>
<script>
    function obtenercomp() {
        var dat = $('#factura').val().split("_");
        if (parseInt($('#factura').val()) > 0) {
            $.ajax({
                type: "GET",
                url: "/Taller/compras/nota_credito/notacre_comp.php?videbito=" + dat[0],
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

</HTML>