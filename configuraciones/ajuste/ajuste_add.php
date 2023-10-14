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
        <div id="wrapper" style="background-color: #1E282C">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color: #1E282C">
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
                                    <h3 class="box-title">Agregar Ajuste</h3>
                                    <div class="box-tools">
                                        <a href="ajuste_index.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>

                                    </div>
                                </div>
                                <form action="ajuste_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class="row">
                                            <input type="hidden" name="voperacion" value="1">
                                            <div class="form-group">
                                                <?php $compras = consultas::get_datos("SELECT COALESCE(MAX(id_ajuste),0)+1 AS ultimo FROM ajustes;") ?>
                                                <div class="col-xs-8 col-sm-4 col-xs-4 ">
                                                    <input class="form-control" type="hidden" name="vidajuste" readonly="" value="<?php echo $compras[0]['ultimo']; ?>" required="">
                                                    <input type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>">
                                                </div>
                                            </div>
                                            <!--Motivo-->
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4 ">Fecha</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" value="<?php echo date("d-m-Y"); ?>" type="text" name="vfecha" required="" style="width: 250px;" readonly="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">Motivo</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $pais = consultas::get_datos("SELECT * FROM motivo_ajuste ORDER BY id_majuste"); ?>
                                                        <select class="select2" name="vajustes" required="" style="width: 250px;">
                                                            <option value="">Seleccione un Motivo</option>>
                                                            <?php
                                                            if (!empty($pais)) {
                                                                foreach ($pais as $p) {
                                                                    ?>
                                                                    <option value="<?php echo $p['id_majuste']; ?>"><?php echo $p['maj_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos un Motivo</option>
                                                            <?php }
                                                            ?>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Deposito-->
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">Deposito</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $pais = consultas::get_datos("SELECT * FROM ref_deposito ORDER BY id_depo"); ?>
                                                        <select class="select2" name="vdeposito" required="" style="width: 250px;">
                                                            <option value="">Seleccione un Deposito</option>>
                                                            <?php
                                                            if (!empty($pais)) {
                                                                foreach ($pais as $p) {
                                                                    ?>
                                                                    <option value="<?php echo $p['id_depo']; ?>"><?php echo $p['dep_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos un Deposito</option>
                                                            <?php }
                                                            ?>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">Articulo</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $pais = consultas::get_datos("SELECT * FROM ref_producto WHERE pro_cod IN (select pro_cod from ref_stock where id_depo= (select id_depo from ref_deposito where id_sucursal=" . $_SESSION['id_sucursal'] . "))"); ?>
                                                        <select class="select2" name="vproducto" required="" style="width: 250px;">
                                                            <option value="">Seleccione un Articulo</option>>
                                                            <?php
                                                            if (!empty($pais)) {
                                                                foreach ($pais as $p) {
                                                                    ?>
                                                                    <option value="<?php echo $p['pro_cod']; ?>"><?php echo $p['pro_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos un Articulo</option>
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4 ">Cantidad</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" value="1" type="number" name="vcantidad" max="500" required=""  style="width: 150px;" min="1" autofocus="" maxlength="30">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: center;">
                                        <button class=" fa fa-save btn btn-success  pull-right" type="submit"> Guardar</button>
                                    </div>
                                </form>
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
        /*MENSAJE DE INSERT MARCAS, TIPO,. ETC*/
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });

        //LETRAS
        function soloLetras(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toString();
            letras = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzáéíóú";

            especiales = [8, 13, 32];
            tecla_especial = false
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                //alert("Ingresar solo letras");
                return false;
            }
        }

        //focus en el primer input pais
        $(document).ready(function () {
            $('#registrar_pais').on('shown.bs.modal', function () {
                $('#descripcion').focus();
            });
        });

        //LIMPIAR AUTOMÁTICO pais
        $("#cerrar_agregar, #cerrar_agregar1").click(function () {
            $('#descripcion').val("");
        });
    </script>

</HTML>