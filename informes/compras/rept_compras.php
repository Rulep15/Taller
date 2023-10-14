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
        <div id="content" style="background-color: #1E282C">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color: #1E282C">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Informes de Modulo de Compra</h3>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-0">
                                            <div class="list-group">
                                                <a href="#" class="list-group-item active" style="background-color: #465F62">Reportes</a>
                                                <a href="#" class="list-group-item" onclick="obtener_pedido()" >Pedidos</a>
                                                <a href="#" class="list-group-item" onclick="obtener_compras()">Compras</a>
                                                <a href="#" class="list-group-item" onclick="obtener_orden()" >Orden de Compras</a>
                                                <a href="#" class="list-group-item" onclick="obtener_presupuesto()" >Presupuestos</a>
                                                <a href="#" class="list-group-item" onclick="obtener_cuentas()" >Cuentas</a>
                                                <a href="#" class="list-group-item" onclick="obtener_debito()" >Notas de Debito</a>
                                                <a href="#" class="list-group-item" onclick="obtener_notaremision()">Notas de Remision</a>
                                                <a href="#" class="list-group-item" onclick="obtener_notacredito()">Notas de Credito</a>
                                                <a href="#" class="list-group-item" onclick="obtener_libro()">Libro de Compras</a>
                                            </div>
                                        </div>
                                        <div id="cargando"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php require '../../estilos/pie.ctp'; ?>
    </BODY>
    <?php require '../../estilos/js_lte.ctp'; ?>

    <SCRIPT>
        function obtener_pedido() {
            $.ajax({
                type: 'POST',
                url: "/T.A/informes/compras/pedidos/reporte_pedidos.php",
                cache: false,
                beforeSend: function () {
                    $('#cargando').html('<img src="/T.A/img/sistema/ajax-loader.gif"><strong><i>Cargando...</i></strong>');
                },
                success: function (msg) {
                    $('#cargando').html(msg);
                }
            })
        }
    </script>
    <SCRIPT>
        function obtener_compras() {
            $.ajax({
                type: 'POST',
                url: "/T.A/informes/compras/compras/reporte_compras.php",
                cache: false,
                beforeSend: function () {
                    $('#cargando').html('<img src="/T.A/img/sistema/ajax-loader.gif"><strong><i>Cargando...</i></strong>');
                },
                success: function (msg) {
                    $('#cargando').html(msg);
                }
            })
        }
    </script>
    <SCRIPT>
        function obtener_orden() {
            $.ajax({
                type: 'POST',
                url: "/T.A/informes/compras/orden/reporte_orden.php",
                cache: false,
                beforeSend: function () {
                    $('#cargando').html('<img src="/T.A/img/sistema/ajax-loader.gif"><strong><i>Cargando...</i></strong>');
                },
                success: function (msg) {
                    $('#cargando').html(msg);
                }
            })
        }
    </script>
    <SCRIPT>
        function obtener_presupuesto() {
            $.ajax({
                type: 'POST',
                url: "/T.A/informes/compras/presupuesto/reporte_presupuesto.php",
                cache: false,
                beforeSend: function () {
                    $('#cargando').html('<img src="/T.A/img/sistema/ajax-loader.gif"><strong><i>Cargando...</i></strong>');
                },
                success: function (msg) {
                    $('#cargando').html(msg);
                }
            })
        }
    </script>
    <SCRIPT>
        function obtener_cuentas() {
            $.ajax({
                type: 'POST',
                url: "/T.A/informes/compras/cuenta/reporte_cuentas.php",
                cache: false,
                beforeSend: function () {
                    $('#cargando').html('<img src="/T.A/img/sistema/ajax-loader.gif"><strong><i>Cargando...</i></strong>');
                },
                success: function (msg) {
                    $('#cargando').html(msg);
                }
            })
        }
    </script>
    <SCRIPT>
        function obtener_notacredito() {
            $.ajax({
                type: 'POST',
                url: "/T.A/informes/compras/notacredito/reporte_notacredito.php",
                cache: false,
                beforeSend: function () {
                    $('#cargando').html('<img src="/T.A/img/sistema/ajax-loader.gif"><strong><i>Cargando...</i></strong>');
                },
                success: function (msg) {
                    $('#cargando').html(msg);
                }
            })
        }
    </script>
    <SCRIPT>
        function obtener_notaremision() {
            $.ajax({
                type: 'POST',
                url: "/T.A/informes/compras/notaremision/reporte_notaremision.php",
                cache: false,
                beforeSend: function () {
                    $('#cargando').html('<img src="/T.A/img/sistema/ajax-loader.gif"><strong><i>Cargando...</i></strong>');
                },
                success: function (msg) {
                    $('#cargando').html(msg);
                }
            })
        }
    </script>
    <SCRIPT>
        function obtener_debito() {
            $.ajax({
                type: 'POST',
                url: "/T.A/informes/compras/notadebito/reporte_notadebito.php",
                cache: false,
                beforeSend: function () {
                    $('#cargando').html('<img src="/T.A/img/sistema/ajax-loader.gif"><strong><i>Cargando...</i></strong>');
                },
                success: function (msg) {
                    $('#cargando').html(msg);
                }
            })
        }
    </script>
    <SCRIPT>
        function obtener_libro() {
            $.ajax({
                type: 'POST',
                url: "/T.A/informes/compras/libro/reporte_libro.php",
                cache: false,
                beforeSend: function () {
                    $('#cargando').html('<img src="/T.A/img/sistema/ajax-loader.gif"><strong><i>Cargando...</i></strong>');
                },
                success: function (msg) {
                    $('#cargando').html(msg);
                }
            })
        }
    </script>
</HTML>
