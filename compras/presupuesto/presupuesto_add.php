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
                                    <h3 class="box-title">Agregar Presupuesto</h3>
                                    <div class="box-tools">
                                        <a href="presupuesto_index.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="presupuesto_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class="row">
                                            <input type="hidden" name="voperacion" value="1">
                                            <input name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>" type="hidden">
                                            <input type="hidden" name="vtotal" value="0">

                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Pedido</label>
                                                <div class="col-lg-5 col-sm-4 col-xs-4">
                                                    <?php $marcas = consultas::get_datos("SELECT * FROM compras_pedidos WHERE id_pedido !=0 ORDER BY id_pedido"); ?>
                                                    <select class="form-control" id="factura" name="vidpedido" required="" onchange="tiposelect();obtenercomp();" onclick="obtenercomp();"  >
                                                        <option value="">Seleccione un Pedido</option>>
                                                        <?php
                                                        if (!empty($marcas)) {
                                                            foreach ($marcas as $m) {
                                                                ?>
                                                                <option value="<?php echo $m['id_pedido']; ?>"><?php echo $m['id_pedido']; ?><?php echo '-'; ?><?php echo $m['descri']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos una marca</option>             
                                                        <?php }
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>     
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Proveedor</label>
                                                <div class="col-lg-5 col-sm-4 col-xs-4">
                                                    <?php $marcas = consultas::get_datos("SELECT * FROM ref_proveedor ORDER BY prv_cod"); ?>
                                                    <select class="form-control" name="vidproveedor" required="" >
                                                        <option value="">Seleccione un Proveedor</option>>
                                                        <?php
                                                        if (!empty($marcas)) {
                                                            foreach ($marcas as $m) {
                                                                ?>
                                                                <option value="<?php echo $m['prv_cod']; ?>"><?php echo $m['prv_razon_social']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos una marca</option>             
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>     
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Fecha</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="date" onkeypress="return soloNum(event)" name="vfecha" min="2022-01-01" value="<?php echo date("Y-m-d"); ?>"  required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Validez</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="date" onkeypress="return soloNum(event)" name="vvalidez" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" required="">
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

                </BODY>
                <?php require '../../estilos/js_lte.ctp'; ?>
                <script>
                    /*MENSAJE DE INSERT MARCAS, TIPO,. ETC*/
                    $("#mensaje").delay(1000).slideUp(200, function () {
                        $(this).alert('close')
                    })
                </script>
                <script>
                    function obtenercomp() {
                        var dat = $('#factura').val().split("_");
                        if (parseInt($('#factura').val()) > 0) {
                            $.ajax({
                                type: "GET",
                                url: "/T.A/compras/presupuesto/presupuesto_pedi.php?vidpresupuesto=" + dat[0], cache: false,
                                beforeSend: function () {
                                },
                                success: function (msg) {
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
                </HTML>