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
<script>
    function soloNUM(e) {
        var key = e.keyCode || e.which,
            tecla = String.fromCharCode(key).toLowerCase(),
            letras = "0123456789",
            especiales = [" "],
            tecla_especial = false;

        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = false;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
    }
</script>

<BODY class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper" style="background-color: #1E282C">
        <?php require '../../estilos/cabecera.ctp'; ?>
        <?php require '../../estilos/izquierda.ctp'; ?>
        <div class="content-wrapper" style="background-color:  #1E282C ">
            <div class="content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <!-- MENSAJE -->
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
                        <!-- MENSAJE -->
                        <h3 style="color: white; text-align: center">Orden de Compras-Detalle</h3>
                        <!--CABECERA-->
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Cabecera</h3>
                                <?php
                                $idpedido = $_REQUEST['vidorden'];
                                $confirmar = consultas::get_datos("SELECT * FROM v_orden_de_compra WHERE nro_orden = $idpedido");
                                if (!empty($confirmar)) {
                                ?>
                                    <?php foreach ($confirmar as $con) { ?>
                                    <?php } ?>
                                    <?php if ($con['orden_estado'] == 'ACTIVO') { ?>
                                        <a style="padding: 10px; margin: 1px" data-toggle="modal" data-target="#confirmar" onclick="registrar_permisos(<?php echo "'" . $_REQUEST['vidorden'] . "'" ?>);" class="btn btn-toolbar btn-lg" role="button" rel="tooltip" data-title="Confirmar" rel="tooltip" data-placement="top">
                                            <span style="color: green" class="glyphicon glyphicon-ok-sign"></span>
                                        </a>
                                    <?php } ?>
                                    <?php if ($con['orden_estado'] == 'CONFIRMADO') { ?>
                                        <a style="padding: 10px; margin: 1px" data-toggle="modal" data-target="#anular" onclick="registrar_anular(<?php echo "'" . $_REQUEST['vidorden'] . "'" ?>);" class="btn btn-toolbar btn-lg" role="button" rel="tooltip" data-title="Anular" rel="tooltip" data-placement="top">
                                            <span style="color: red" class="glyphicon glyphicon-ban-circle"></span>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                                <div class="box-tools">
                                    <a href="ordenc_index.php" class="btn btn-toolbar pull-right">
                                        <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php
                                        $idorden = $_REQUEST['vidorden'];
                                        $orden = consultas::get_datos("SELECT * FROM v_orden_de_compra WHERE nro_orden = $idorden ");
                                        $total = consultas::get_datos("SELECT sum(cantidad*precio_unit) as total FROM v_det_orden_compra where nro_orden=$idorden");
                                        if ($total !== false && isset($total[0]['total'])) {
                                            $resultado = $total[0]['total'];
                                        } else {
                                            $resultado = 0;
                                        }
                                        if (!empty($orden)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">N°</th>
                                                            <th class="text-center">N° Presupuesto</th>
                                                            <th class="text-center">Proveedor</th>
                                                            <th class="text-center">Fecha</th>
                                                            <th class="text-center">Sucursal</th>
                                                            <th class="text-center">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($orden as $pc) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $pc['nro_orden']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['id_presu']; ?><?php echo ' - '; ?><?php echo $pc['fecha']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['prv_razon_social']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['fecha_orden']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['suc_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $resultado; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--CABECERA-->

                        <!--DETALLE-->
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Detalles de Orden</h3>
                            </div>
                            <div class="box-body no-padding">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <?php
                                    $idpedido = $_REQUEST['vidorden'];
                                    $presupuestodetalle = consultas::get_datos("SELECT * FROM v_det_orden_compra WHERE nro_orden= $idpedido");
                                    if (!empty($presupuestodetalle)) {
                                    ?>
                                        <div class="table-responsive">
                                            <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Producto</th>
                                                        <th class="text-center">Precio</th>
                                                        <th class="text-center">Cantidad</th>
                                                        <?php if ($pc['orden_estado'] == 'ACTIVO') { ?>
                                                            <th class="text-center">Acciones</th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($presupuestodetalle as $pcd) { ?>
                                                        <tr>
                                                            <td class="text-center"> <?php echo $pcd['pro_descri']; ?></td>
                                                            <td class="text-center"> <?php echo $pcd['precio_unit']; ?></td>
                                                            <td class="text-center"> <?php echo $pcd['cantidad']; ?></td>
                                                            <td class="text-center">
                                                                <?php if ($pc['orden_estado'] == 'ACTIVO') { ?>
                                                                    <a onclick="quitar(<?php echo "'" . $pcd['nro_orden'] . "_" . $pcd['pro_cod'] . "'"; ?>);" class="btn btn-toolbar" role="button" data-title="Quitar" rel="tooltip" data-placement="top" data-toggle="modal" data-target="#quitar">
                                                                        <i style="color: red" class="fa fa-times"></i>
                                                                    </a>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } else { ?>
                                        <div class="alert alert-danger flat">
                                            <span class="glyphicon glyphicon-info-sign"></span> La Orden de Compra no tiene detalles...
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php if ($pc['orden_estado'] == 'ACTIVO') { ?>
                            <!--AGREGAR DETALLE-->
                            <div class="box box-primary" style="width: 550px; height: auto;margin: 0 auto;">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Agregar Items</h3>
                                </div>
                                <div class="box-body no-padding">
                                    <?php if ($pc['orden_estado'] == 'ACTIVO') { ?>
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <form action="ordenc_detalle_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                                <div class="box-body" style="left: 1000px;">
                                                    <input type="hidden" name="voperacion" value="1" />
                                                    <input type="hidden" name="vidorden" value="<?php echo $_REQUEST['vidorden']; ?>" />
                                                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                                                        <div class="form-group">
                                                            <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Producto</label>
                                                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                <?php $productos = consultas::get_datos("SELECT * FROM producto where pro_cod != 0 AND pro_cod in(select pro_cod from detalle_presupuesto where id_presu = $pc[id_presu] ) ORDER BY pro_cod") ?> <select class="select2" name="vproducto" required="" style="width: 300px;" id="idproducto" onchange="obtenerprecio()" onkeyup="obtenerprecio()" onclick="obtenerprecio()">
                                                                    <option value="">Seleccione un Producto</option>
                                                                    <?php
                                                                    if (!empty($productos)) {
                                                                        foreach ($productos as $producto) {
                                                                    ?>
                                                                            <option value="<?php echo $producto['pro_cod']; ?>"><?php echo $producto['pro_descri']; ?></option>
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
                                                            <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Cantidad</label>
                                                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                <input type="number" name="vcantidad" class="form-control" max="500" required="" min="1" value="1" style="width: 300px;" id="idcantidad" onchange="calsubtotal()" onkeydown="calsubtotal()">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <button type="submit" class="btn btn-success center-block">
                                                        <span class="glyphicon glyphicon-plus"></span> Agregar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <!--AGREGAR DETALLE-->
                    </div>
                </div>
            </div>
        </div>

        <!-- registrar-->
        <div id="confirmar" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" id="detalles_registrar">
                </div>
            </div>
        </div>
        <!-- registrar-->
        <!-- anular-->
        <div id="anular" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" id="detalles_anular">

                </div>
            </div>
        </div>
        <!-- anular-->
        <!-- MODAL DE QUITAR -->
        <div class="modal fade" id="quitar" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title custom_align" id="Heading">Atencion!!!</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" id="confirmacion"></div>
                    </div>
                    <div class="modal-footer">
                        <a id="si" role="button" class="btn btn-primary">
                            <span class="glyphicon glyphicon-ok-sign"></span>Si
                        </a>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span>No
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL DE QUITAR -->
    </div>
    <?php require '../../estilos/pie.ctp'; ?>
</BODY>
<?php require '../../estilos/js_lte.ctp'; ?>
<SCRIPT>
    $("#mensaje").delay(1500).slideUp(200, function() {
        $(this).alert('close');
    });

    function quitar(datos) {
        var dat = datos.split("_");
        $('#si').attr('href', 'ordenc_detalle_control.php?vidorden=' + dat[0] + '&vproducto=' + dat[1] + '&vdeposito=' + dat[2] + '&voperacion=4');
        $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el producto del detalle <i><strong>' + dat[1] + '</strong></i>?');
    }


    function calsubtotal() {
        var precio = parseInt($('#idprecio').val());
        var cant = parseInt($('#idcantidad').val());
        $('#idsubtotal').val(precio * cant);
    }

    function obtenerprecio() {
        var dat = $('#idproducto').val().split("_");
        if (parseInt($('#idproducto').val()) > 0) {
            $.ajax({
                type: "GET",
                url: "/Taller/compras/orden_compra/listar_precios.php?vidproducto=" + dat[0],
                cache: false,
                beforeSend: function() {
                    $('#precio').html('<img src="/Taller/img/sistema/ajax-loader.gif">\n\<strong><i>Cargando...</i></strong></img>');
                },
                success: function(msg) {
                    $('#precio').html(msg);
                    calsubtotal();
                }
            });
        }
    }

    function registrar_permisos(datos) {
        var dat = datos.split("_");
        $.ajax({
            type: "GET",
            url: "/Taller/compras/orden_compra/ordenc_confirmar.php?vidorden=" + dat[0],
            beforeSend: function() {
                $('#detalles_registrar').html();
            },
            success: function(msg) {
                $('#detalles_registrar').html(msg);
            }
        });
    }

    function registrar_anular(datos) {
        var dat = datos.split("_");
        $.ajax({
            type: "GET",
            url: "/Taller/compras/orden_compra/ordenc_anularm.php?vidorden=" + dat[0],
            beforeSend: function() {
                $('#detalles_anular').html();
            },
            success: function(msg) {
                $('#detalles_anular').html(msg);
            }
        });
    }
</SCRIPT>

</HTML>