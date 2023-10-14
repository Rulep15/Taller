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
                        <h3 style="color: white; text-align: center">Detalle-Compras</h3>
                        <!--CABECERA-->
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Cabecera</h3>
                                <?php
                                $idpedido = $_REQUEST['vidajuste'];
                                $confirmar = consultas::get_datos("SELECT * FROM v_compras WHERE id_compra = $idpedido");
                                if (!empty($confirmar)) {
                                ?>
                                    <?php foreach ($confirmar as $con) { ?>
                                    <?php } ?>
                                    <?php if ($con['com_estado'] == 'ACTIVO') { ?>
                                        <a style="padding: 10px; margin: 1px" data-toggle="modal" data-target="#confirmar" onclick="registrar_permisos(<?php echo "'" . $_REQUEST['vidcompra'] . "'" ?>);" class="btn btn-toolbar btn-lg" role="button" rel="tooltip" data-title="Confirmar" rel="tooltip" data-placement="top">
                                            <span style="color: green" class="glyphicon glyphicon-ok-sign"></span>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                                 <?php if ($con['com_estado'] == 'CONFIRMADO') { ?>
                                            <a style="padding: 10px; margin: 1px"  data-toggle="modal" data-target="#anular"
                                               onclick="registrar_anular(<?php echo "'" . $_REQUEST['vidcompra'] . "'" ?>);"
                                               class="btn btn-toolbar btn-lg" role="button" rel="tooltip"  data-title="Anular" rel="tooltip" data-placement="top">
                                                <span style="color: red" class="glyphicon glyphicon-ban-circle"></span>
                                            </a>
                                        <?php } ?>
                                <div class="box-tools">
                                    <a href="compras_index.php" class="btn btn-toolbar pull-right">
                                        <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php
                                        $idorden = $_REQUEST['vidcompra'];
                                        $orden = consultas::get_datos("SELECT * FROM v_compras WHERE id_compra = $idorden ");
                                        if (!empty($orden)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">N°</th>
                                                            <th class="text-center">Proveedor</th>
                                                            <th class="text-center">Fecha</th>
                                                            <th class="text-center">Iva Total</th>
                                                            <th class="text-center">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($orden as $pc) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $pc['id_compra']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['prv_razon_social']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['fecha_compra']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['com_totaliva']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['com_total']; ?></td>
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
                        <!--DETALLE ORDEN-->
                        <?php
                        $idorden1 = $_REQUEST['vidcompra'];
                        $vista = consultas::get_datos("SELECT * FROM v_compra_orden WHERE id_compra = $idorden1");
                        if (!empty($vista)) {
                        ?>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Detalles Orden</h3>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php
                                        $idpedido = $_REQUEST['vidcompra'];
                                        $presupuestodetalle = consultas::get_datos("SELECT * FROM v_compra_orden WHERE id_compra = $idpedido");
                                        if (!empty($presupuestodetalle)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Articulo</th>
<!--                                                            <th class="text-center">Deposito</th>-->
                                                            <th class="text-center">Cantidad</th>
                                                            <th class="text-center">Precio_Unit</th>
                                                            <th class="text-center">SubTotal</th>
                                                            <?php if ($pc['com_estado'] == 'ACTIVO') { ?>
                                                                <th class="text-center">Acciones</th>
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($presupuestodetalle as $pcd) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $pcd['pro_descri']; ?></td>
<!--                                                                <td class="text-center"> ?php echo $pcd['dep_descri']; ?></td>-->
                                                                <td class="text-center"> <?php echo $pcd['cantidad']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['precioc']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['subtotal']; ?></td>
                                                                <td class="text-center">
                                                                    <?php if ($pc['com_estado'] == 'ACTIVO') { ?>
                                                                        <a onclick="cantidad(<?php echo "'" . $pcd['id_compra'] . "_" . $pcd['pro_cod'] . "_" . $pcd['id_depo'] . "_" . $pcd['cantidad'] . "_" . $pcd['precioc'] . "'"; ?>)" class="btn btn-lg btn-toolbar" role="button" data-title="Modificar cantidad" data-placement="top" rel="tooltip" data-toggle="modal" data-target="#cantidad_orden">
                                                                            <span class="fa fa-bitcoin"></span>
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
                                                <span class="glyphicon glyphicon-info-sign"></span> La Orden no tiene detalles...
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!--DETALLE ITEMS-->
                        <?php
                        $idpedido = $_REQUEST['vidcompra'];
                        $detalleitems = consultas::get_datos("SELECT * FROM v_compras WHERE id_compra = $idpedido");
                        if (!empty($detalleitems)) {
                        ?>
                            <?php foreach ($detalleitems as $deti) { ?>
                            <?php } ?>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Detalles de Compras</h3>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php
                                        $idpedido = $_REQUEST['vidcompra'];
                                        $presupuestodetalle = consultas::get_datos("SELECT * FROM v_detalle_compras where id_compra = $idpedido AND pro_cod NOT IN (SELECT a.pro_cod FROM detalle_orden a, orden_de_compra b, compras c, compras_detalle d
                                               WHERE a.nro_orden = b.nro_orden AND b.nro_orden = c.nro_orden AND c.id_compra = d. id_compra AND c.id_compra = $idpedido)");
                                        if (!empty($presupuestodetalle)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Articulo</th>
                                                            <th class="text-center">Precio</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <th class="text-center">SubTotal</th>
                                                            <th class="text-center">Iva 5%</th>
                                                            <th class="text-center">Iva 10%</th>
                                                            <?php if ($deti['com_estado'] == 'ACTIVO') { ?>
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
                                                                <td class="text-center"> <?php echo $pcd['subtotal']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['iva5']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['iva10']; ?></td>
                                                                <td class="text-center">

                                                                    <?php if ($deti['com_estado'] == 'ACTIVO') { ?>
                                                                        <a onclick="quitar(<?php echo "'" . $pcd['id_compra'] . "_" . $pcd['pro_cod'] . "_" . $pcd['id_depo'] . "'" ?>)" class="btn btn-toolbar " role="button" data-title="Eliminar Detalle" data-placement="top" rel="tooltip" data-toggle="modal" data-target="#quitar">
                                                                            <span style="color: red;" class="fa fa-trash"></span>
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
                                                <span class="glyphicon glyphicon-info-sign"></span> La Compra no tiene detalles...
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                        <?php
                        $idpedido = $_REQUEST['vidcompra'];
                        $detallecompra = consultas::get_datos("SELECT * FROM v_compras WHERE id_compra= $idpedido");
                        if (!empty($detallecompra)) {
                        ?>
                            <?php foreach ($detallecompra as $det) { ?>
                            <?php } ?>
                            <?php if ($det['com_estado'] == 'ACTIVO') { ?>
                                <!--AGREGAR DETALLE-->
                                <div class="box box-primary" style="width: 550px; height: 300px;margin: 0 auto;">
                                    <div class="box-header">
                                        <i class="ion ion-clipboard"></i>
                                        <h3 class="box-title">Agregar Items</h3>
                                    </div>
                                    <div class="box-body no-padding">
                                        <?php if ($det['com_estado'] == 'ACTIVO') { ?>
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                <form action="compras_detalle_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                                    <div class="box-body" style="left: 1000px;">
                                                        <input type="hidden" name="voperacion" value="1" />
                                                        <input type="hidden" name="vidcompra" value="<?php echo $_REQUEST['vidcompra']; ?>" />
                                                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Deposito</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <?php $depositos = consultas::get_datos("SELECT * FROM ref_deposito WHERE id_sucursal=" . $_SESSION['id_sucursal']) ?>
                                                                    <select class="select2" name="vdeposito" required="" style="width: 300px;">
                                                                        <option value="">Seleccione un Deposito</option>
                                                                        <?php
                                                                        if (!empty($depositos)) {
                                                                            foreach ($depositos as $deposito) {
                                                                        ?>
                                                                                <option value="<?php echo $deposito['id_depo']; ?>"><?php echo $deposito['dep_descri']; ?></option>
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
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Producto</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <?php $productos = consultas::get_datos("SELECT * FROM ref_producto") ?>
                                                                    <select class="select2" name="vproducto" required="" style="width: 300px;" id="idproducto" onchange="obtenerprecio()" onkeyup="obtenerprecio()" onclick="obtenerprecio()">
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
                                                            <div class="form-group" id="precio">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Precio</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <input type="number" name="vprecio" class="form-control" required="" min="1000" value="0" style="width: 300px;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Cantidad</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <input type="number" name="vcantidad" class="form-control" required="" min="1" max="500" value="1" style="width: 300px;" id="idcantidad" onchange="calsubtotal()" onkeydown="calsubtotal()">
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
                        <?php } ?>
                        <!--AGREGAR DETALLE-->
                    </div>
                </div>
            </div>
        </div>
        <!-- EDITAR  Cantidad-->
        <div class="modal fade" id="cantidad_orden" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Modificar Cantidad</strong></h4>
                        <form action="compras_detalle_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                            <input name="voperacion" value="5" type="hidden">
                            <input name="vproducto" id="product" type="hidden">
                            <input name="vdeposito" id="deposit" type="hidden">
                            <input type="hidden" name="vprecio" id="preci">
                            <input type="hidden" name="vidcompra" id="idcom">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Cantidad</label>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <input class="form-control" type="number" name="vcantidad" max="500" min="1" required="" id="cantidati">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="reset" data-dismiss="modal" class="fa fa-remove btn btn-danger">Cerrar</button>
                                <button type="submit" class="fa fa-refresh btn btn-success pull-right">Actualizar</button>
                            </div>
                        </form>
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
                        <button type="button" class="close" data-dismiss="modal" arial-label="Close">X</button>
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
        $('#si').attr('href', 'compras_detalle_control.php?vidcompra=' + dat[0] + '&vproducto=' + dat[1] + '&vdeposito=' + dat[2] + '&voperacion=2');
        $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el Articulo del detalle <i><strong>' + dat[0] + '</strong></i>?');
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
                url: "/T.A/compras/compras/listar_precios.php?vidproducto=" + dat[0],
                cache: false,
                beforeSend: function() {
                    $('#precio').html('<img src="/T.A/img/sistema/ajax-loader.gif">\n\<strong><i>Cargando...</i></strong></img>');
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
            url: "/T.A/compras/compras/compras_confirmar.php?vidcompra=" + dat[0],
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
            url: "/T.A/compras/compras/compra_anularm.php?vidcompra=" + dat[0],
            beforeSend: function() {
                $('#detalles_anular').html();
            },
            success: function(msg) {
                $('#detalles_anular').html(msg);
            }
        });
    }

    function cantidad(datos) {
        var dat = datos.split("_"); //ayuda a quitar el guion
        $('#idcom').val(dat[0]);
        $('#product').val(dat[1]);
        $('#deposit').val(dat[2]);
        $('#cantidati').val(dat[3]);
        $('#preci').val(dat[4]);
    }
</SCRIPT>

</HTML>