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
                        <h3 style="color: white; text-align: center">Detalle-Remision</h3>
                        <!--CABECERA-->
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Cabecera</h3>
                                <?php
                                $idpedido = $_REQUEST['vidnota'];
                                $confirmar = consultas::get_datos("SELECT * FROM v_nota_remision WHERE id_remision = $idpedido");
                                if (!empty($confirmar)) {
                                ?>
                                    <?php foreach ($confirmar as $con) { ?>
                                    <?php } ?>
                                    <?php if ($con['estado'] == 'ACTIVO') { ?>
                                        <a style="padding: 10px; margin: 1px" data-toggle="modal" data-target="#confirmar" onclick="registrar_permisos(<?php echo "'" . $_REQUEST['vidnota'] . "'" ?>);" class="btn btn-toolbar btn-lg" role="button" rel="tooltip" data-title="Confirmar" rel="tooltip" data-placement="top">
                                            <span style="color: green" class="glyphicon glyphicon-ok-sign"></span>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($con['estado'] == 'CONFIRMADO') { ?>
                                    <a style="padding: 10px; margin: 1px" data-toggle="modal" data-target="#anular" onclick="registrar_anular(<?php echo "'" . $_REQUEST['vidnota'] . "'" ?>);" class="btn btn-toolbar btn-lg" role="button" rel="tooltip" data-title="Anular" rel="tooltip" data-placement="top">
                                        <span style="color: red" class="glyphicon glyphicon-ban-circle"></span>
                                    </a>
                                <?php } ?>
                                <div class="box-tools">
                                    <a href="nota_remision_index.php" class="btn btn-toolbar pull-right">
                                        <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php
                                        $idorden = $_REQUEST['vidnota'];
                                        $orden = consultas::get_datos("SELECT * FROM v_nota_remision WHERE id_remision = $idorden ");
                                        $total = consultas::get_datos("SELECT sum(cantidad*precio_unit) as total FROM detalle_remision where id_remision=$idorden");
                                        if ($total !== false && isset($total[0]['total'])) {
                                            $resultado = $total[0]['total'];
                                        } else {
                                            $resultado = 0;
                                        }
                                        $ivatotal = consultas::get_datos("SELECT sum(iva5+iva10+exentas) as totaliva FROM detalle_remision where id_remision=$idorden");
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
                                                                <td class="text-center"> <?php echo $pc['id_remision']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['nro_orden']; ?><?php echo ' - '; ?><?php echo $pc['orden_fecha']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['prv_razon_social']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['fecha']; ?></td>
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
                        $idpedido = $_REQUEST['vidnota'];
                        $detalleitems = consultas::get_datos("SELECT * FROM v_nota_remision WHERE id_remision = $idpedido");
                        if (!empty($detalleitems)) {
                        ?>
                            <?php foreach ($detalleitems as $deti) { ?>
                            <?php } ?>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Detalles de Remision</h3>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php
                                        $idpedido = $_REQUEST['vidnota'];
                                        $presupuestodetalle = consultas::get_datos("SELECT * FROM v_detalle_remision WHERE id_remision = $idpedido ");
                                        $total = consultas::get_datos("SELECT sum(cantidad*precio_unit) as total FROM detalle_remision where id_remision=$idorden");
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
                                                            <th class="text-center">Producto</th>
                                                            <th class="text-center">Precio</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <th class="text-center">SubTotal</th>
                                                            <th class="text-center">Iva 5%</th>
                                                            <th class="text-center">Iva 10%</th>
                                                            <?php if ($deti['estado'] == 'ACTIVO') { ?>
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
                                                                <td class="text-center"> <?php echo $pcd['precio_unit'] * $pcd['cantidad']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['iva5']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['iva10']; ?></td>
                                                                <td class="text-center">
                                                                    <?php if ($deti['estado'] == 'ACTIVO') { ?>
                                                                        <a onclick="quitar(<?php echo "'" . $pcd['id_remision'] . "_" . $pcd['pro_cod'] . "'" ?>)" class="btn btn-toolbar " role="button" data-title="Eliminar Detalle" data-placement="top" rel="tooltip" data-toggle="modal" data-target="#quitar">
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
                                                <span class="glyphicon glyphicon-info-sign"></span> La Nota no tiene detalles...
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                        <?php
                        $idpedido = $_REQUEST['vidnota'];
                        $detallecompra = consultas::get_datos("SELECT * FROM v_nota_remision WHERE id_remision= $idpedido");
                        if (!empty($detallecompra)) {
                        ?>
                            <?php foreach ($detallecompra as $det) { ?>
                            <?php } ?>
                            <?php if ($det['estado'] == 'ACTIVO') { ?>
                                <!--AGREGAR DETALLE-->
                                <div class="box box-primary" style="width: 550px; height: 300px;margin: 0 auto;">
                                    <div class="box-header">
                                        <i class="ion ion-clipboard"></i>
                                        <h3 class="box-title">Agregar Items</h3>
                                    </div>
                                    <div class="box-body no-padding">
                                        <?php if ($det['estado'] == 'ACTIVO') { ?>
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                <form action="nota_remision_detalle_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                                    <div class="box-body" style="left: 1000px;">
                                                        <input type="hidden" name="voperacion" value="1" />
                                                        <input type="hidden" name="vidnota" value="<?php echo $_REQUEST['vidnota']; ?>" />
                                                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                                                            <div class="form-group">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Producto</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <?php $productos = consultas::get_datos("SELECT * FROM producto WHERE pro_cod IN (SELECT pro_cod FROM producto)") ?>
                                                                    <div class="input-group">
                                                                        <select class="select2 form-control" name="vproducto" required="" style="width: 300px;" id="idproducto">
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
                                                                                <option value="">Debe insertar registros..

                                                                                </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-toolbar btn-flat " type="button" data-toggle="modal" data-target="#registrar_producto">
                                                                                <i style="color: #465F62" class="fa fa-plus"></i> </button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Precio</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <input type="number" name="vprecio" class="form-control" required="" min="1000" style="width: 300px;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Cantidad</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <input type="number" name="vcantidad" class="form-control" required="" min="1" max="500" value="1" style="width: 300px;" id="idcantidad">
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
        <!--MODAL DE MARCAS-->
        < <div class="modal fade" id="registrar_marca" role="dialog" style="z-index: 1060;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Registrar Marca</strong></h4>
                    </div>
                    <form action="marca_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                        <input name="voperacion" value="1" type="hidden">
                        <input name="vidmarca" value="0" type="hidden" id="vidmarca">
                        <input name="vidpedido" value="<?php echo $_REQUEST['vidnota']; ?>" type="hidden" id="vidpedido">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Descripcion</label>
                                <div class="col-xs-10 col-md-10 col-lg-10">
                                    <input type="text" class="form-control" name="vdescripcionmarca" required="" autofocus="" id="vmardescri" onkeypress="return soloLetras(event);">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="reset" data-dismiss="modal" class="fa fa-remove btn btn-danger" id="cerrar_marca"> Cerrar</button>
                            <button type="submit" class="fa fa-save btn btn-success pull-right"> Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    <!--MODAL DE MARCAS-->
    <!--MODAL DE Producto-->
    <div class="modal fade" id="registrar_producto" role="dialog" style="z-index: 1050;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Registrar Producto</strong></h4>
                </div>
                <form action="productos_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                    <input name="voperacion" value="1" type="hidden">
                    <input name="vidproducto" value="0" type="hidden" id="vidmarca">
                    <input name="vidpedido" value="<?php echo $_REQUEST['vidnota']; ?>" type="hidden" id="vidpedido">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Cod.Barra</label>
                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                <input style="width: 320px;" class="form-control" type="number" name="vcodigob" required="" id="codigo_barra" onkeypress="return soloNumero(event)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Marcas</label>
                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                <div class="input-group">
                                    <?php $marcas = consultas::get_datos("SELECT * FROM ref_marca ORDER BY mar_cod"); ?>
                                    <select class="select2" name="vidmarca" required="" style="width: 320px;">
                                        <?php
                                        if (!empty($marcas)) {
                                            foreach ($marcas as $m) {
                                        ?>
                                                <option value="<?php echo $m['mar_cod']; ?>"><?php echo $m['mar_descri']; ?></option>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe seleccionar al menos un Dato</option>
                                        <?php }
                                        ?>
                                    </select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-toolbar btn-flat" type="button" data-toggle="modal" data-target="#registrar_marca">
                                            <i style="color: #465F62" class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">T.Producto</label>
                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                <div class="input-group">
                                    <?php $tipoprod = consultas::get_datos("SELECT * FROM ref_tipo_producto ORDER BY id_tipro"); ?>
                                    <select class="select2" name="vidtipro" required="" style="width: 320px;">
                                        <?php
                                        if (!empty($tipoprod)) {
                                            foreach ($tipoprod as $tp) {
                                        ?>
                                                <option value="<?php echo $tp['id_tipro']; ?>"><?php echo $tp['tipro_descri']; ?></option>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe seleccionar al menos un Dato</option>
                                        <?php }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Impuesto</label>
                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                <div class="input-group">
                                    <?php $tipoimp = consultas::get_datos("SELECT * FROM ref_tipo_impuesto ORDER BY id_timp"); ?>
                                    <select class="select2" name="vidtimp" required="" style="width: 320px;">
                                        <?php
                                        if (!empty($tipoimp)) {
                                            foreach ($tipoimp as $tim) {
                                        ?>
                                                <option value="<?php echo $tim['id_timp']; ?>"><?php echo $tim['descripcion']; ?></option>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe seleccionar al menos un Dato</option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2 col-sm-2 col-xs-2">U.Medida</label>
                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                <div class="input-group">
                                    <?php $Unidad = consultas::get_datos("SELECT * FROM unidad_de_medida ORDER BY id_um"); ?>
                                    <select class="select2" name="vidum" required="" style="width: 320px;">
                                        <?php
                                        if (!empty($Unidad)) {
                                            foreach ($Unidad as $um) {
                                        ?>
                                                <option value="<?php echo $um['id_um']; ?>"><?php echo $um['descripcion']; ?></option>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe seleccionar al menos un Dato</option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Descripcion</label>
                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                <input style="width: 320px;" maxlength="250" required="" class="form-control" type="text" name="vdescripcion" id="descripcion" onkeypress="return soloLetras(event);">
                            </div>
                        </div>
                        <div style="display: none;" class="form-group">
                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">P.Compra</label>
                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                <input style="width: 320px;" class="form-control" type="number" onkeypress="return soloNumero(event)" id="precioc" name="vprecioc" min="0">
                            </div>
                        </div>
                        <div style="display: none;" class="form-group">
                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">P.Venta</label>
                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                <input style="width: 320px;" class="form-control" type="number" onkeypress="return soloNumero(event)" id="preciov" name="vpreciov" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="reset" data-dismiss="modal" class="fa fa-close btn btn-danger" id="cerrar_producto"> Cerrar</button>
                        <button type="submit" class="fa fa-save btn btn-success pull-right"> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
        $('#si').attr('href', 'nota_remision_detalle_control.php?vidnota=' + dat[0] + '&vproducto=' + dat[1] + '&vdeposito=' + dat[2] + '&voperacion=2');
        $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el Articulo del detalle <i><strong>' + '</strong></i>?');
    }



    function registrar_permisos(datos) {
        var dat = datos.split("_");
        $.ajax({
            type: "GET",
            url: "/Taller/compras/nota_remision/nota_remision_confirmar.php?vidnota=" + dat[0],
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
            url: "/Taller/compras/nota_remision/nota_remision_anular.php?vidnota=" + dat[0],
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
<script>
    //focus en el primer input de marca
    $(document).ready(function() {
        $('#registrar_marca').on('shown.bs.modal', function() {
            $('#vmardescri').focus();
        });
    });
    //focus en el primer de tipo de producto
    $(document).ready(function() {
        $('#registrar_tipo').on('shown.bs.modal', function() {
            $('#vtipoproducto').focus();
        });
    });
    //focus en el primer input de producto
    $(document).ready(function() {
        $('#registrar_producto').on('shown.bs.modal', function() {
            $('#codigo_barra').focus();
        });
    });
    /*MENSAJE DE INSERT MARCAS, TIPO,. ETC*/
    $("#mensaje").delay(1000).slideUp(200, function() {
        $(this).alert('close');
    });
    //LIMPIAR AUTOMÁTICO MARCA
    $("#cerrar_marca").click(function() {
        $('#vmardescri').val("");
    });
    //LIMPIAR AUTOMÁTICO TIPO DE PRODUCTO
    $("#cerrar_tipo").click(function() {
        $('#vdescripcionproducto').val("");
    });
    //LIMPIAR AUTOMÁTICO PRODUCTO
    $("#cerrar_producto").click(function() {
        $('#codigo_barra').val("");
        $('#descripcion').val("");
        $('#precioc').val("");
        $('#preciov').val("");
    });
</script>

</HTML>