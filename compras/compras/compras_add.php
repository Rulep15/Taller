<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximun-scale=1">
    <?php
    include '../../conexion.php';
    require '../../estilos/css_lte.ctp';
    ?>
</head>
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

<BODY class="hold-transition skin-purple sidebar-mini">
    <div id="wrapper" style="background-color: #1E282C;">
        <?php require '../../estilos/cabecera.ctp' ?>
        <?php require '../../estilos/izquierda.ctp' ?>

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
                        <div class="box box_primary">
                            <div class="box-header">
                                <i class="ion ion-plus"></i>
                                <h3 class="box-title"> Agregar Compra</h3>
                                <div class="box-tools">
                                    <a href="compra_index.php" class="btn btn-toolbar">
                                        <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                    </a>

                                </div>

                            </div>
                            <form action="compra_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="hidden" name="voperacion" value="1">
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Codigo de compra</label>
                                            <?php $compra = consultas::get_datos("SELECT COALESCE(MAX(id_compra),0)+1 AS ultimo FROM compra;") ?>
                                            <div class="col-xs-8 col-sm-4 col-xs-4 ">
                                                <input class="form-control" type="text" name="vidcompra" readonly="" value="<?php echo $compra[0]['ultimo']; ?>" required="">
                                                <input type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>">
                                                <input type="hidden" name="vsucursal" value="<?php echo $_SESSION['id_sucursal']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Fecha</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" name="vfecha" readonly="" value="<?php echo date("Y-m-d"); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Nro. de factura</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" placeholder=" FORMATO: 000-000-0000000" pattern="[0-9]{3}-[0-9]{3}-[0-9]{7}" title="Debe coincidir con el formato xxx-xxx-xxxxxxx" onkeypress="return SoloNum(event)" name="vnrofactura" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Timbrado</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" maxlength="8" minlength="8" placeholder="INSERTE 8 DIGITOS" onkeypress="return SoloNum(event)" name="vnrotimp" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Validez timbrado</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="date" onkeypress="return SoloNum(event)" name="vetimp" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Condicion</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <select class="form-control" name="vcondicion" id="vcondi" onchange="condicion();">
                                                    <option value="CONTADO">CONTADO</option>
                                                    <option value="CREDITO">CREDITO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Cant. cuota</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input type="hidden" class="form-control" name="vcantidadcuota" value="1">
                                                <input class="form-control" type="number" value="1" min="1" max="36" name="vcantidadcuota" id="vcancuota">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Intervalo</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input type="hidden" class="form-control" name="vintervalo" value="15">
                                                <select class="form-control" name="vintervalo" id="vintervalo">
                                                    <option value="30">30</option>
                                                    <option value="15">15</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--PROVEEDOR-->
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Proveedor</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">

                                                <?php $proveedors = consultas::get_datos("SELECT * FROM proveedor ORDER BY prv_cod"); ?>
                                                <select class="form-control" id="idprovi" name="vidproveedor" required="" onclick="obtenernotarem();obtenerpedido();ver_boton();" onchange="obtenernotarem();obtenerpedido();ver_boton()">
                                                    <option value="">Debe seleccionar un proveedor</option>
                                                    <?php
                                                    if (!empty($proveedors)) {
                                                        foreach ($proveedors as $p) {
                                                    ?>
                                                            <option value="<?php echo $p['prv_cod']; ?>"><?php echo $p['prv_razon_social']; ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>

                                                    <?php }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                        <!--PROVEEDOR-->
                                        <div class="form-group" id="botoncito" style="display: none">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2"></label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <label id="one">
                                                    <input required="" type="checkbox" onclick="tiposelect()" onchange="tiposelect();obtenerord();habilitar_registro()" name="Pedido" value="pedido" id="pedi" /> Orden de compra
                                                </label>
                                            </div>
                                            <br><br>
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2"></label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <label id="two">
                                                    <input required="" type="checkbox" onclick="tiposelect(); obtener_nota();" onchange="tiposelect();obtenernota();habilitar_registro()" name="Nota de remision " value="nota" id="nota" /> Nota de remision
                                                </label>

                                            </div>
                                            <div class="box-body" id="pedi_detalle" style="display: none">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <div class="box-header" style="text-align: center;">
                                                    </div>
                                                    <div id="pedidos">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body" id="pedi_detalle1" style="display: none">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <div class="box-header" style="text-align: center;">
                                                    </div>
                                                    <div id="notita">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body" id="pedi_detalle2" style="display: none">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <div class="box-header" style="text-align: center;">
                                                    </div>
                                                    <div id="pedid">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body" id="pedi_detalle3" style="display: none">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <div class="box-header" style="text-align: center;">
                                                    </div>
                                                    <div id="notas">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: right;">
                                        <button id="registro" class="fa fa-save btn btn-success" type="submit"> Guardar</button>
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
    $("#mensaje").delay(1000).slideUp(200, function() {
        $(this).alert('close');
    });

    function condicion() {
        if (document.getElementById('vcondi').value === "CONTADO") {
            document.getElementById('vcancuota').setAttribute('disabled', 'true');
            document.getElementById('vcancuota').value = '1';
            document.getElementById('vintervalo').setAttribute('disabled', 'true');
        } else {
            document.getElementById('vcancuota').removeAttribute('disabled');
            document.getElementById('vcancuota').value = '1';
            document.getElementById('vintervalo').removeAttribute('disabled');

        }
    }
    window.onload = condicion();

    function tiposelect() {
        if (document.getElementById('pedi').checked) {

            proveedor = document.getElementById('idprovi');
            proveedor.setAttribute('disabled', 'true');

            detalle1 = document.getElementById('pedi_detalle2');
            detalle1.style.display = '';

            detalle1 = document.getElementById('pedi_detalle');
            detalle1.style.display = '';

            registro = document.getElementById('registro');
            registro.style.display = 'none';

            notas = document.getElementById('two');
            notas.style.display = 'none';

            ORDEN = document.getElementById('pedido');
            ORDEN.setAttribute('required', 'true');


            $("#valor").val('0');
        } else {
            if (document.getElementById('nota').checked) {

                orden = document.getElementById('one');
                orden.style.display = 'none';

                detalle10 = document.getElementById('pedi_detalle3');
                detalle10.style.display = '';

                detalle3 = document.getElementById('pedi_detalle1');
                detalle3.style.display = '';

                ORDEN = document.getElementById('notarda');
                ORDEN.setAttribute('required', 'true');

                $("#notes").val('0');


            } else {
                notas = document.getElementById('two');
                notas.style.display = '';

                orden = document.getElementById('one');
                orden.style.display = ''

                registro = document.getElementById('registro');
                registro.style.display = '';

                divone = document.getElementById('one');
                $("#pedido").val('0');

                detalle3 = document.getElementById('pedi_detalle');
                detalle3.style.display = 'none';

                detalle2 = document.getElementById('pedi_detalle1');
                detalle2.style.display = 'none';

                detalle5 = document.getElementById('pedi_detalle3');
                detalle5.style.display = 'none';
                $("#notarda").val('0');


                detalle3 = document.getElementById('pedi_detalle2');
                detalle3.style.display = 'none';

                proveedor = document.getElementById('idprovi');
                proveedor.removeAttribute('disabled');
            }


        }
    }
    window.onload = tiposelect();



    function obtenerpedido() {
        var dat = $('#idprovi').val().split("_");
        if (parseInt($('#idprovi').val()) > 0) {
            $.ajax({
                type: "GET",
                url: "/Taller/compras/compras/ordenc_prov.php?vidpedido=" + dat[0],
                cache: false,
                beforeSend: function() {},
                success: function(msg) {
                    $('#pedidos').html(msg);


                }
            });
        }
    }

    function obtenernotarem() {
        var dat = $('#idprovi').val().split("_");
        if (parseInt($('#idprovi').val()) > 0) {
            $.ajax({
                type: "GET",
                url: "/Taller/compras/compras/obtener_nota.php?vidpedido=" + dat[0],
                cache: false,
                beforeSend: function() {},
                success: function(msg) {
                    $('#notita').html(msg);


                }
            });
        }
    }

    function ver_boton() {
        if (document.getElementById('idprovi').value > 0) {
            div = document.getElementById('botoncito');
            div.style.display = '';
        } else {
            div = document.getElementById('botoncito');
            div.style.display = 'none';
        }
    }

    function ver_boton_registrar() {
        if (document.getElementById('pedido').value > 0) {
            registro = document.getElementById('registro');
            registro.style.display = '';
        } else {
            registro = document.getElementById('registro');
            registro.style.display = 'none';
        }
    }

    function ver_boton_registrar1() {
        if (document.getElementById('notarda').value > 0) {
            registro = document.getElementById('registro');
            registro.style.display = '';
        } else {
            registro = document.getElementById('registro');
            registro.style.display = 'none';
        }
    }
</script>

<script>
    function obtenerord() {
        var dat = $('#pedido').val().split("_");
        $.ajax({
            type: "GET",
            url: "/Taller/compras/compras/ordenc_presu.php?vidorden=" + dat[0],
            cache: false,
            beforeSend: function() {},
            success: function(msg) {
                $('#pedid').html(msg);


            }
        });
    }
</script>
<script>
    function obtenernota() {
        var dat = $('#notarda').val().split("_");
        $.ajax({
            type: "GET",
            url: "/Taller/compras/compras/nota_compra.php?vidorden=" + dat[0],
            cache: false,
            beforeSend: function() {},
            success: function(msg) {
                $('#notas').html(msg);


            }
        });
    }
</script>

</html>