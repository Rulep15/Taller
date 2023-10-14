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
        <div id="wrapper" style="background-color: #1E282C;">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color: #1E282C;">
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
                                    <h3 class="box-title">Agregar Nota de Remision</h3>
                                    <div class="box-tools">
                                        <a href="nota_remision_index.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="nota_remision_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class="row">
                                            <input type="hidden" name="voperacion" value="1">
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">N° de Nota Debito</label>
                                                <?php $pc = consultas::get_datos("SELECT COALESCE(MAX(id_remision),0)+1 AS ultimo FROM nota_remision") ?>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="text" name="vidremision" readonly="" value="<?php echo $pc[0]['ultimo']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Inicio de Translado</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="date" name="vfechatranlado" readonly="" value="<?php echo date("Y-m-d"); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Nro de Timbrado</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" required="" type="text" name="vtimbrado" placeholder="INSERTE O DIGITE 8  DIGITOS"  minlength="8" maxlength="8" value="" onkeypress="return soloNumero(event);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Motivo de Translado</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" required="" type="text" name="vmotivo" value="">
                                                </div>
                                            </div>

                                            <input class="form-control" type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>" />
                                            <input type="hidden" name="vsucsalida" value="<?php echo $_SESSION['id_sucursal']; ?>">


                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Conductor</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <?php $marcas = consultas::get_datos("SELECT * FROM v_ref_empleado ORDER BY id_empleado"); ?>
                                                    <select class="form-control"   name="vconductor" id="factura"  required=""  >
                                                        <option value="">Seleccione un Conductor</option>>
                                                        <?php
                                                        if (!empty($marcas)) {
                                                            foreach ($marcas as $m) {
                                                                ?>
                                                                <option value="<?php echo $m['id_empleado']; ?>"><?php echo $m['nombre']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos un Conductor</option>             
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Sucursal Destino</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <?php $marcas = consultas::get_datos("SELECT * FROM ref_sucursal WHERE id_sucursal !=" . $_SESSION['id_sucursal']); ?>
                                                    <select class="form-control"   name="vsucursaldest" id="factura"  required="" >
                                                        <option value="">Seleccione una Sucursal</option>>
                                                        <?php
                                                        if (!empty($marcas)) {
                                                            foreach ($marcas as $m) {
                                                                ?>
                                                                <option value="<?php echo $m['id_sucursal']; ?>"><?php echo $m['suc_descri']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos una Sucursal</option>             
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Vehiculo</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <?php $marcas = consultas::get_datos("SELECT * FROM ref_vehiculo ORDER BY id_vehiculo"); ?>
                                                    <select class="form-control"   name="vvehiculo" id="factura"  required="" >
                                                        <option value="">Seleccione un Vehiculo</option>>
                                                        <?php
                                                        if (!empty($marcas)) {
                                                            foreach ($marcas as $m) {
                                                                ?>
                                                                <option value="<?php echo $m['id_vehiculo']; ?>"><?php echo $m['chapa']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos un Nro de Compra</option>             
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: right;">
                                        <button class="fa fa-save btn btn-success" type="submit"> Guardar</button>
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
        function soloNumero(e)
        {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toString();
            letras = "0123456789-";

            especiales = [];
            tecla_especial = false
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial)
            {
                //alert("Ingresar solo letras");
                return false;
            }
        }
    </script>


</HTML>