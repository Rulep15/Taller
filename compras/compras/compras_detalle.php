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
                                $idpedido = $_REQUEST['vidcompra'];
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
                                    <a style="padding: 10px; margin: 1px" data-toggle="modal" data-target="#anular" onclick="registrar_anular(<?php echo "'" . $_REQUEST['vidcompra'] . "'" ?>);" class="btn btn-toolbar btn-lg" role="button" rel="tooltip" data-title="Anular" rel="tooltip" data-placement="top">
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
                                        $total = consultas::get_datos("SELECT sum(cantidad*precio) as total FROM det_compra where id_compra=$idorden");
                                        if ($total !== false && isset($total[0]['total'])) {
                                            $resultado = $total[0]['total'];
                                        } else {
                                            $resultado = 0;
                                        }
                                        $ivatotal = consultas::get_datos("SELECT sum(iva5+iva10+exentas) as totaliva FROM det_compra where id_compra=$idorden");
                                        if ($ivatotal !== false && isset($ivatotal[0]['totaliva'])) {
                                            $resultadoiva = $ivatotal[0]['totaliva'];
                                        } else {
                                            $resultadoiva = 0;
                                        }
                                        if (!empty($orden)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">N°</th>
                                                            <th class="text-center">N° de Orden</th>
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
                                                                <td class="text-center"> <?php echo $pc['nro_orden']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['prv_razon_social']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['fecha_compra']; ?></td>
                                                                <td class="text-center"> <?php echo $resultadoiva; ?></td>
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
                                        $presupuestodetalle = consultas::get_datos("SELECT * FROM v_detalle_compras WHERE id_compra = $idpedido ");
                                        $total = consultas::get_datos("SELECT sum(cantidad*precio) as total FROM det_compra where id_compra=$idorden");
                                        if ($total !== false && isset($total[0]['total'])) {
                                            $resultado = $total[0]['total'];
                                        } else {
                                            $resultado = 0;
                                        }
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
                                                                <td class="text-center"> <?php echo $pcd['precio']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['cantidad']; ?></td>
                                                                <td class="text-center"> <?php echo $resultado; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['iva5']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['iva10']; ?></td>
                                                                <td class="text-center">
                                                                    <?php if ($deti['com_estado'] == 'ACTIVO') { ?>
                                                                        <a onclick="quitar(<?php echo "'" . $pcd['id_compra'] . "_" . $pcd['pro_cod'] . "'" ?>)" class="btn btn-toolbar " role="button" data-title="Eliminar Detalle" data-placement="top" rel="tooltip" data-toggle="modal" data-target="#quitar">
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
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Producto</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <?php $productos = consultas::get_datos("SELECT * FROM producto") ?>
                                                                    <select class="select2" name="vproducto" required="" style="width: 300px;" id="idproducto">
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
        $('#si').attr('href', 'compras_detalle_control.php?vidcompra=' + dat[0] + '&vproducto=' + dat[1] + '&vdeposito=' + dat[2] + '&voperacion=2');
        $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el Articulo del detalle <i><strong>' + dat[0] + '</strong></i>?');
    }



    function registrar_permisos(datos) {
        var dat = datos.split("_");
        $.ajax({
            type: "GET",
            url: "/Taller/compras/compras/compras_confirmar.php?vidcompra=" + dat[0],
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
            url: "/Taller/compras/compras/compra_anularm.php?vidcompra=" + dat[0],
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