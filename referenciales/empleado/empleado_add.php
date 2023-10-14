<?php session_start(); ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximun-scale=1">
        <?php
        include '../../conexion.php';
        require '../../estilos/css_lte.ctp';
        ?>
    </head>

    <body class="hold-transition skin-purple sidebar-mini">
        <div id="wrapper" style="background-color: #1E282C">
            <?php require '../../estilos/cabecera.ctp' ?>
            <?php require '../../estilos/izquierda.ctp' ?>

            <div class="content-wrapper" style="background-color: #1E282C;">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <?php if (!empty($_SESSION['mensaje'])) { ?>
                                <?php
                                $empensaje = explode("_/_", $_SESSION['mensaje']);
                                if (($empensaje[0] == 'NOTICIA')) {
                                    $class = "success";
                                } else {
                                    $class = "danger";
                                }
                                ?>
                                <div class="alert alert-<?= $class; ?>" role="alert" id="mensaje">
                                    <i class="ion ion-information-circled"></i>
                                    <?php
                                    echo $empensaje[1];
                                    $_SESSION['mensaje'] = '';
                                    ?>
                                </div>
                            <?php } ?>
                            <div class="box box_primary">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title"> Agregar Empleado</h3>
                                    <div class="box-tools">
                                        <a href="empleado_index.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>

                                    </div>

                                </div>
                                <!-- PERSONA -->
                                <form action="empleado_control.php" method="POST" accept-charset="UTF-8"
                                      class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion" value="1">
                                            <input type="hidden" name="vidcodigo" value="0">

                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Persona</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <?php $empmpleado = consultas::get_datos("SELECT * FROM ref_persona where per_estado = 'ACTIVO' order by id_persona"); ?>
                                                        <select class="form-control select3" name="vidpersona" required="" style="width: 320px;">  
                                                            <?php
                                                            if (!empty($empmpleado)) {
                                                                foreach ($empmpleado as $emp) {
                                                                    ?>
                                                                    <option value="<?php echo $emp['id_persona']; ?>"><?php echo $emp['per_nro_doc'].' - '.$emp['per_nombre'].' '.$emp['per_apellido']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos una marca</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Cargo</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <?php $empmpleado = consultas::get_datos("SELECT * FROM ref_cargos order by id_cargo"); ?>
                                                        <select class="form-control select3" name="vidcargo" required="" style="width: 320px;">  
                                                            <?php
                                                            if (!empty($empmpleado)) {
                                                                foreach ($empmpleado as $emp) {
                                                                    ?>
                                                                    <option value="<?php echo $emp['id_cargo']; ?>"><?php echo $emp['car_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos un cargo</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Sucursal</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <?php $empmpleado = consultas::get_datos("SELECT * FROM ref_sucursal order by id_sucursal"); ?>
                                                        <select class="form-control select3" name="vidsucursal" required="" style="width: 320px;">  
                                                            <?php
                                                            if (!empty($empmpleado)) {
                                                                foreach ($empmpleado as $emp) {
                                                                    ?>
                                                                    <option value="<?php echo $emp['id_sucursal']; ?>"><?php echo $emp['suc_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos una sucursal</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="fa fa-save btn  btn-success pull-right" type="submit"> Guardar</button>

                                    </div>


                                </form>

                            </div>

                        </div>

                    </div>
                </div>
                <!--MODAL Ciudad-->
                <div class="modal fade" id="registrar_ciudad" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Registrar Ciudad</strong></h4>
                            </div>
                            <form action="empleado_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input type="hidden" name="voperacion" value="4">
                                <input type="hidden" name="vidciudad" value="0" id="vidmarca">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Descripcion</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <input type="text" class="form-control" name="vpernombre" required="" id="vmardescri">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Pais</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <div class="input-group">
                                                <?php $empmpleado = consultas::get_datos("SELECT * FROM ref_pais ORDER BY id_pais"); ?>
                                                <select class="form-control select3" name="vidcodigo" required="" style="width: 150px;">
                                                    <?php
                                                    if (!empty($empmpleado)) {
                                                        foreach ($empmpleado as $emp) {
                                                            ?>
                                                            <option value="<?php echo $emp['id_pais']; ?>"><?php echo $emp['pai_descri']; ?></option>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>

                                                        <option value="0">Debe selecionar al menos una marca</option>

                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="box-footer">
                                    <button type="reset" data-dismiss="modal" class=" fa fa-remove btn btn-danger" id="cerrar_marca"> Cerrar</button>
                                    <button type="submit" class="fa fa-save btn btn-success pull-right"> Guardar</button>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <?php require '../../estilos/pie.ctp'; ?>
    </body>
    <?php require '../../estilos/js_lte.ctp'; ?>
    <script>
        /*MENSAJE DE INSERT MARCAS, TIPO,. ETC*/
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });
        $(document).ready(function () {
            $('#barra').on('shown.bs.modal', function () {
                $('#barra').focus();
            });
        })
        $(document).ready(function () {
            $('#registrar_marca').on('shown.bs.modal', function () {
                $('#vmardescri').focus();
            });
        })

        $('#cerrar_marca').click(function () {
            $('#vidmarca , #vmardescri').val("");
        });
        $(document).ready(function () {
            $('#registrar_tipoprod').on('shown.bs.modal', function () {
                $('#vtiprodescri').focus();
            });
        })

        $('#cerrar_tp').click(function () {
            $(' #vidtipro ,#vtiprodescri').val("");
        });
        $(document).ready(function () {
            $('#registrar_unidad').on('shown.bs.modal', function () {
                $('#vumdescri').focus();
            });
        })

        $('#cerrar_unidad').click(function () {
            $(' #vidum ,#vumdescri').val("");
        });

        $(document).ready(function () {
            $('#registrar_impuesto').on('shown.bs.modal', function () {
                $('#vimpdescri').focus();
            });
        })

        $('#cerrar_impuesto').click(function () {
            $('#vidimp , #vimpdescri').val("");
        });

    </script>
</html>