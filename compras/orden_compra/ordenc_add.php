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
        function soloLetras(e) {
            var key = e.keyCode || e.which,
                    tecla = String.fromCharCode(key).toLowerCase(),
                    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz0123456789",
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
        <div class="wrapper" style="background-color: #1E282C;">
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
                            <div class="box box_primary" >
                                <div class="box-header" >
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title"> Agregar Ordenes de Compra</h3>
                                    <div class="box-tools">
                                        <a href="ordenc_index.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>

                                    </div>
                                </div>
                                <form action="ordenc_control.php" method="POST" accept-charset="UTF-8"
                                      class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion" value="1">
                                            <input type="hidden" name="vestado" value="ACTIVO">
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Codigo de pedido</label>
                                                <?php $cp = consultas::get_datos("SELECT COALESCE(MAX(nro_orden),0)+1 AS ultimo FROM orden_de_compra;") ?>
                                                <div class="col-xs-8 col-sm-4 col-xs-4 ">
                                                    <input class="form-control" type="text" name="vidorden" readonly="" value="<?php echo $cp[0]['ultimo']; ?>" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Fecha</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" name="vfecha" readonly="" value="<?php echo date("d-m-Y"); ?>">
                                                </div>
                                            </div>
                                            <input class="form-control" type="hidden" name="vcantidad" value="0">
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Usuario</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>">
                                                    <input class="form-control" type="text" name="vusunick" readonly="" value="<?php echo $_SESSION['usu_nick']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group" id="prov" >
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Proveedor</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <?php $marcas = consultas::get_datos("SELECT * FROM ref_proveedor ORDER BY prv_cod"); ?>
                                                    <select class="form-control"  name="vproveedor" onchange="obtenerpresupuesto(); ocultarcheck();" onclick="obtenerpresupuesto(); ocultarcheck();" required="" id="idprov"   >
                                                        <option value="">Seleccione un Proveedor</option>
                                                        <?php
                                                        if (!empty($marcas)) {
                                                            foreach ($marcas as $m) {
                                                                ?>
                                                                <option value="<?php echo $m['prv_cod']; ?>"><?php echo $m['prv_razon_social']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos una Proveedor</option>             
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div id="one" style="display: none;" class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2"></label>
                                                <div  class="col-lg-4 col-sm-4 col-xs-4">


                                                    <label id="two">         
                                                        <input  type="checkbox" style="margin-top: 15px" onchange="tiposelect()" onclick="tiposelect(); obtenerpresu()" name="presupuesto" value="presupuesto" id="pres"/>Presupuesto
                                                    </label>
                                                </div>
                                            </div>




                                            <div  style="display: none;" id="mostrarbox" class="form-group">
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
                                    <div class="box-footer" >
                                        <button class="fa fa-save btn btn-success pull-right" id="boton" type="submit"> Guardar</button>
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
        /*MENSAJE DE INSERT MARCAS, TIPO,. ETC*/
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });

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

        function obtenerpresu() {
            var dat = $('#presupuesto').val().split("_");

            $.ajax({
                type: "GET",
                url: "/T.A/compras/orden_compra/ordenc_presu.php?vidpedido=" + dat[0], cache: false,
                beforeSend: function () {
                },
                success: function (msg) {
                    $('#presup').html(msg);


                }
            });
        }



    </script>
    <script>
        function obtenerpresupuesto() {
            var dat = $('#idprov').val().split("_");

            $.ajax({
                type: "GET",
                url: "/T.A/compras/orden_compra/ordenc_prov.php?vidpedido=" + dat[0], cache: false,
                beforeSend: function () {
                },
                success: function (msg) {
                    $('#boxpresupuesto').html(msg);
                }
            });

        }

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
</html>