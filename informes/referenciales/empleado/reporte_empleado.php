<?php session_start(); ?>
<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta content="width=devicewidth, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        include '../../../conexion.php';
        require '../../../estilos/css_lte.ctp';
        ?>
    </HEAD>
    <form accept-charset="UTF8" class="form-horizontal">
        <div class="col-md-8 col-md-offset-0">
            <div style="width: 218px;" class="list-group">
                <a  href="#" class="list-group-item active" style="background-color: #465F62">Referencial de Empleado</a>
            </div>
            <div class="form-group col-md-12">
                <div class="row">
                    <div class="col-md-10">
                        <div class="box-body no-padding">
                            <div class="row">
                                <div class="col-md-4 col-md-offset-0">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item active" style="background-color: #465F62">Filtros</a>
                                        <a href="#" class="list-group-item" onclick="obtener_sucursal()">Por Sucursal</a>
                                        <a href="#" class="list-group-item" onclick="obtener_cargos()">Por Cargos</a>
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
        function obtener_sucursal() {
            $.ajax({
                type: 'POST',
                url: "/T.A/informes/referenciales/empleado/inf_x_sucursal.php",
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
    <script>
        function obtener_cargos() {
            $.ajax({
                type: 'POST',
                url: "/T.A/informes/referenciales/empleado/inf_x_cargos.php",
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
