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
                                    <h3 class="box-title">Informes Referenciales</h3>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-0">
                                            <div class="list-group">
                                                <a href="#" class="list-group-item active" style="background-color: #465F62">Reportes</a>
                                                <a href="/T.A/referenciales/pais/pais_print.php" class="list-group-item" >Pais</a>
                                                <a href="#" class="list-group-item" onclick="obtener_proveedor()">Proveedor</a>
                                                <a href="/T.A/referenciales/marcas/marca_print.php" class="list-group-item" >Marcas</a>
                                                <a href="/T.A/referenciales/vehiculos/vehiculo_print.php" class="list-group-item" >Vehiculos</a>
                                                <a href="/T.A/referenciales/grupos/grupos_print.php" class="list-group-item" >Grupos</a>
                                                <a href="/T.A/referenciales/cargos/cargos_print.php" class="list-group-item" >Cargos</a>
                                                <a href="#" class="list-group-item" onclick="obtener_empleado()">Empleado</a>

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
    <script>
        function obtener_proveedor() {
            $.ajax({
                type: 'POST',
                url: "/T.A/informes/referenciales/proveedor/reporte_proveedor.php",
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
        function obtener_empleado() {
            $.ajax({
                type: 'POST',
                url: "/T.A/informes/referenciales/empleado/reporte_empleado.php",
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
