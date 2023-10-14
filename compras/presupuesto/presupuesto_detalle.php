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
                            <h3 style="color: white; text-align: center">Presupuesto - Detalle</h3>
                            <!--CABECERA-->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Cabecera</h3>
                                    <a style="padding: 10px; margin: 1px"  data-toggle="modal" data-target="#confirmar"
                                       onclick="registrar_permisos(<?php echo "'" . $_REQUEST['vidpresupuesto'] . "'" ?>);"
                                       class="btn btn-toolbar btn-lg" role="button" rel="tooltip"  data-title="Confirmar" rel="tooltip" data-placement="top">
                                        <span style="color: green" class="glyphicon glyphicon-ok-sign"></span>
                                    </a> 
                                    <div class="box-tools">
                                        <a href="presupuesto_index.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>                                     
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $idpedido = $_REQUEST['vidpresupuesto'];
                                            $presupuesto = consultas::get_datos("SELECT * FROM v_presupuesto WHERE id_presu = $idpedido ");
                                            if (!empty($presupuesto)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">N°</th>
                                                                <th class="text-center">Pedido</th>
                                                                <th class="text-center">Fecha</th>
                                                                <th class="text-center">Empleado</th>
                                                                <th class="text-center">Proveedor</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($presupuesto AS $pc) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $pc['id_presu']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['id_pedido']; ?><?php echo ' - '; ?><?php echo $pc['descri']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['fecha_pedido1']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['empleado']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['prv_razon_social']; ?></td>
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
                                    <h3 class="box-title">Detalles Items</h3>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php
                                        $idpedido = $_REQUEST['vidpresupuesto'];
                                        $presupuestodetalle = consultas::get_datos("SELECT * FROM v_detalle_presupuesto WHERE id_presu = $idpedido");
                                        if (!empty($presupuestodetalle)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Producto</th>
                                                            <th class="text-center">Deposito</th>
                                                            <th class="text-center">Cantidad</th> 
                                                            <th class="text-center">Precio</th> 
                                                            <th class="text-center">Subtotal</th> 
                                                            <?php if ($pc['estado'] == 'ACTIVO') { ?>
                                                                <th class="text-center">Acciones</th> 
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($presupuestodetalle AS $pcd) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $pcd['pro_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['dep_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['cantidad']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['precio_unit']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['subtotal']; ?></td>


                                                                <td class="text-center"> 
                                                                    <?php if ($pc['estado'] == 'ACTIVO') { ?>                                                
                                                                        <a onclick="editar(<?php echo "'" . $pcd['id_presu'] . "_" . $pcd['pro_cod'] . "_" . $pcd['id_depo'] . "_" . $pcd['cantidad'] . "_" . $pcd['precio_unit'] . "'"; ?>)" class="btn btn-toolbar " role="button" data-title="Modificar Precio" data-placement="top" rel="tooltip" data-toggle="modal" data-target="#editar">
                                                                            <span style="color: green;" class="fa fa-money"></span>
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
                                                <span class="glyphicon glyphicon-info-sign"></span> El Presupuesto no tiene detalles...
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Modificar Precio</strong></h4>
                            <form action="presupuesto_detalle_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input name="voperacion" value="1" type="hidden">
                                <input name="vproducto" id="producto" value="<?php echo $pcd['pro_cod']; ?>" type="hidden">
                                <input name="vdeposito" id="deposito" value="<?php echo $pcd['id_depo']; ?>" type="hidden">
                                <input type="hidden" name="vcantidad" id="cantidad" value="<?php echo $pcd['cantidad']; ?>">
                                <input type="hidden" name="vidpresupuesto" id="codigo">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Precio</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <input class="form-control"  type="number" onkeypress="return soloNUM(event)" name="vprecio" value="" min="1000" required="" id="pre">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="reset" data-dismiss="modal" class="fa fa-close btn btn-danger"> Cerrar</button>
                                    <button type="submit" class="fa fa-refresh btn btn-success pull-right"> Actualizar</button>
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
                        <div class="modal-footer"
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
        $("#mensaje").delay(1500).slideUp(200, function () {
            $(this).alert('close');
        });
        function editar(datos) {
            var dat = datos.split("_"); //ayuda a quitar el guion
            $('#codigo').val(dat[0]);
            $('#producto').val(dat[1]);
            $('#deposito').val(dat[2]);
            $('#cantidad').val(dat[3]);
            $('#pre').val(dat[4]);
        }

        function quitar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href', 'presupuesto_detalle_control.php?vidpresupuesto=' + dat[0] + '&vproducto=' + dat[1] + '&vdeposito=' + dat[2] + '&voperacion=2');
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
                    url: "/T.A/compras/pedido/listar_precios.php?vidproducto=" + dat[0], cache: false,
                    beforeSend: function () {
                        $('#precio').html('<img src="/T.A/img/sistema/ajax-loader.gif">\n\<strong><i>Cargando...</i></strong></img>');
                    },
                    success: function (msg) {
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
                url: "/T.A/compras/presupuesto/presupuesto_confirmar.php?vidpresupuesto=" + dat[0],
                beforeSend: function () {
                    $('#detalles_registrar').html();
                },
                success: function (msg) {
                    $('#detalles_registrar').html(msg);
                }
            });
        }
    </SCRIPT>
</HTML>
