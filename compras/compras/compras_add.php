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
</script>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper" style="background-color:  #1E282C;">
        <?php require '../../estilos/cabecera.ctp' ?>
        <?php require '../../estilos/izquierda.ctp' ?>

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
                        <div class="box box_primary" style="background-color: white">
                            <div class="box-header">
                                <i class="ion ion-plus"></i>
                                <h3 class="box-title"> Agregar Compra</h3>
                                <div class="box-tools">
                                    <a href="compras_index.php" class="btn btn-toolbar pull-right btn-sm">
                                        <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                    </a>

                                </div>

                            </div>
                            <form action="compras_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="hidden" name="voperacion" value="1">
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Codigo de compra</label>
                                            <?php $compras = consultas::get_datos("SELECT COALESCE(MAX(id_compra),0)+1 AS ultimo FROM compras;") ?>
                                            <div class="col-xs-8 col-sm-4 col-xs-4 ">
                                                <input class="form-control" type="text" name="vidcompra" readonly="" value="<?php echo $compras[0]['ultimo']; ?>" required="">
                                                <input type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>">
                                                <input type="hidden" name="vsucursal" value="<?php echo $_SESSION['id_sucursal']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Fecha</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" name="vfecha" readonly="" value="<?php echo date("d-m-Y"); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Nro. de factura</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" pattern="[0-9]{3}-[0-9]{3}-[0-9]{7}" placeholder="FORMATO:xxx-xxx-xxx-xxx-x" title="Debe coincidir con el formato xxx-xxx-xxxxxxx" name="vnrofactura" required="" onkeypress="return soloNumero(event)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Timbrado</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" onl name="vtimbrado" placeholder="INSERTE O DIGITE 8  DIGITOS" required="" minlength="8" maxlength="8" onkeypress="return soloNumero(event)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Validez timbrado</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="date" onkeypress="return soloNum(event)" name="vvalidez" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Condicion</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <select class="form-control" name="vcondicion" id="vcondi" onchange="ocultarcredito();">
                                                    <option value="CONTADO">CONTADO</option>
                                                    <option value="CREDITO">CREDITO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Cant. cuota</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input type="hidden" class="form-control" name="vcantidadcuota" value="1">
                                                <input class="form-control" type="number" min="1" max="36" name="vcantidadcuota" id="vcancuota">
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
                                        <div class="form-group" id="prov">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Proveedor</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <?php $proveedors = consultas::get_datos("SELECT * FROM ref_proveedor ORDER BY prv_cod"); ?>
                                                <select class="form-control" id="idprov" name="vidproveedor" onchange="obtenerpresupuesto(); ocultarcheck();" onclick="obtenerpresupuesto(); ocultarcheck();" required="">
                                                    <option value="">Seleccione un Proveedor</option>>
                                                    <?php
                                                    if (!empty($proveedors)) {
                                                        foreach ($proveedors as $p) {
                                                    ?>
                                                            <option value="<?php echo $p['prv_cod']; ?>"><?php echo $p['prv_razon_social']; ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>

                                                        <option value="0">Debe selecionar al menos un registro</option>

                                                    <?php }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                        <!--PROVEEDOR-->
                                        <div id="one" style="display: none;" class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2"></label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <label id="two">
                                                    <input type="checkbox" style="margin-top: 15px" onchange="tiposelect()" onclick="tiposelect(); obtenerpresu()" name="presupuesto" value="presupuesto" id="pres" />Orden de Compra
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group" style="display: none" id="ordene">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Ordenes</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <?php $marcas = consultas::get_datos("SELECT * FROM v_orden_de_compra WHERE estado = 'CONFIRMADO' ORDER BY nro_orden "); ?>
                                                <select class="form-control" name="vordenes" id="ordenes" onchange="obtenerorden()" onclick="obtenerorden()">
                                                    <option></option>
                                                    <?php
                                                    if (!empty($marcas)) {
                                                        foreach ($marcas as $m) {
                                                    ?>
                                                            <option value="<?php echo $m['nro_orden']; ?>"><?php echo $m['prv_razon_social']; ?><?php echo ' - '; ?><?php echo $m['fecha_orden']; ?></option>
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
                                        <div style="display: none;" id="mostrarbox" class="form-group">
                                            <div id="boxpresupuesto">

                                            </div>
                                        </div>
                                        <div class="box-body" id="presu_x" style="display: none;">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <div class="box-header" style="text-align: center;">
                                                </div>
                                                <div id="presup">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button class="fa fa-save btn btn-success  pull-right" id="boton" type="submit"> Guardar</button>
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
    function ocultarcredito() {
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
    window.onload = ocultarcredito();
</script>
<script>
    function mostrarboton() {
        if (document.getElementById('presupuesto').value > 0) {
            divbox12 = document.getElementById('boton');
            divbox12.style.display = '';

        } else {
            divbox13 = document.getElementById('boton');
            divbox13.style.display = 'none';

        }
    }
</script>
<script>
    function tiposelect() {
        if (document.getElementById('pres').checked) {
            divbox = document.getElementById('mostrarbox')
            divbox.style.display = '';
            divbox1 = document.getElementById('presu_x');
            divbox1.style.display = '';
            divbox12 = document.getElementById('boton');
            divbox12.style.display = 'none';

            $("#valor").val('0');

            detalle32 = document.getElementById('idprov');
            detalle32.setAttribute('disabled', 'true');

        } else {
            divbox12 = document.getElementById('boton');
            divbox12.style.display = '';

            $("#presupuesto").val('0');

            divbox1 = document.getElementById('presu_x');
            divbox1.style.display = 'none';

            divbox = document.getElementById('mostrarbox');
            divbox.style.display = 'none';

            divtwo = document.getElementById('two');
            divtwo.style.display = '';

            detalle32 = document.getElementById('idprov');
            detalle32.removeAttribute('disabled');



        }
    }
    window.onload = tiposelect();
</script>
<script>
    /*MENSAJE DE INSERT MARCAS, TIPO,. ETC*/
    $("#mensaje").delay(1000).slideUp(200, function() {
        $(this).alert('close');
    });
    $(document).ready(function() {
        $('#barra').on('shown.bs.modal', function() {
            $('#barra').focus();
        });
    })
    $(document).ready(function() {
        $('#registrar_marca').on('shown.bs.modal', function() {
            $('#vmardescri').focus();
        });
    })

    $('#cerrar_marca').click(function() {
        $('#vidmarca , #vmardescri').val("");
    });
    $(document).ready(function() {
        $('#registrar_tipoprod').on('shown.bs.modal', function() {
            $('#vtiprodescri').focus();
        });
    })

    $('#cerrar_tp').click(function() {
        $(' #vidtipro ,#vtiprodescri').val("");
    });
    $(document).ready(function() {
        $('#registrar_unidad').on('shown.bs.modal', function() {
            $('#vumdescri').focus();
        });
    })

    $('#cerrar_unidad').click(function() {
        $(' #vidum ,#vumdescri').val("");
    });

    $(document).ready(function() {
        $('#registrar_impuesto').on('shown.bs.modal', function() {
            $('#vimpdescri').focus();
        });
    })

    $('#cerrar_impuesto').click(function() {
        $('#vidimp , #vimpdescri').val("");
    });
    //        
    //        $('#cerrar_unidad').click(function () {
    //            $(' #vidum ,#vumdescri').val("");
    //        });
</script>
<script>
    function obtenerpresupuesto() {
        var dat = $('#idprov').val().split("_");

        $.ajax({
            type: "GET",
            url: "/T.A/compras/compras/ordenc_prov.php?vidpedido=" + dat[0],
            cache: false,
            beforeSend: function() {},
            success: function(msg) {
                $('#boxpresupuesto').html(msg);
            }
        });

    }

    function obtenerpresu() {
        var dat = $('#presupuesto').val().split("_");

        $.ajax({
            type: "GET",
            url: "/T.A/compras/compras/ordenc_presu.php?vidpedido=" + dat[0],
            cache: false,
            beforeSend: function() {},
            success: function(msg) {
                $('#presup').html(msg);


            }
        });
    }
</script>
<script>
    function ocultar() {
        if (document.getElementById('orden').checked) {
            divp = document.getElementById('ordene');
            $("#valor").val('0');
            divpro = document.getElementById('proveedor');

            divpro.style.display = 'none';


            divp.style.display = 'none';

            div4 = document.getElementById('ordene');
            div4.style.display = '';

            //DETALLE ORDEN
            detalle = document.getElementById('orden_detalle');
            detalle.style.display = '';

        } else {
            divp = document.getElementById('ordene');
            divp.style.display = '';
            $("#orden").val('0');


            divtwo = document.getElementById('two');
            divtwo.style.display = '';

            div4 = document.getElementById('ordene');
            div4.style.display = 'none';

            divpro = document.getElementById('proveedor');

            divpro.style.display = '';

            //DETALLES ORDEN
            detalle = document.getElementById('orden_detalle');
            detalle.style.display = 'none';


        }
    }
    window.onload = tiposelect();
</script>
<script>
    function ocultarcheck() {
        if (document.getElementById('idprov').value > 0) {
            divbox = document.getElementById('one')
            divbox.style.display = '';
        } else {
            divbox = document.getElementById('one')
            divbox.style.display = 'none';

        }
    }
</script>
<script>
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

</html>