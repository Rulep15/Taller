<?php session_start() ?> <!-- Para que muestre la sesion guardada -->
<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=devicewidth,initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        include '../../../conexion.php';
        require '../../../estilos/css_lte.ctp';
        ?>
    </head>
    <form accept-charset="UTF8" class="form-horizontal">
        <div class="col-md-8 col-md-offset-0">
            <div style="width: 218px;" class="list-group">
                <a  href="#" class="list-group-item active" style="background-color: #465F62">Reportes de Pedidos</a>
            </div>
            <div class="form-group col-md-12">
                <div class="row">
                    <div class="col-md-10">
                        <div class="box-body no-padding">
                            <div class="row">
                                <div class="col-md-4 col-md-offset-0">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item active" style="background-color: #465F62">Filtros</a>
                                        <a href="#" class="list-group-item" onclick="obtener_fecha()">Por Fecha</a>
                                        <a href="#" class="list-group-item" onclick="obtener_estado()">Por Estado</a>
                                    </div>
                                </div>
                                <div id="cargando">

                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php require '../../../estilos/js_lte.ctp'; ?>
    <script>
        function obtener_fecha() {
            $.ajax({
                type: 'POST',
                url: "/T.A/informes/compras/pedidos/fecha.php",
                cache: false,
                beforeSend: function () {
                    $('#cargando').html('<img src="/T.A/img/sistema/ajax-loader.gif"><strong><i>Cargando...</i></strong>');
                },
                success: function (msg) {
                    $('#cargando').html(msg);
                }
            })
        }
        function obtener_estado() {
            $.ajax({
                type: 'POST',
                url: "/T.A/informes/compras/pedidos/estado.php",
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
</html>




