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
        <div class="wrapper" style="background-color: #1E282C;">
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
                                <div class="header box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Agregar Usuario</h3>
                                    <div class="box-tools">
                                        <a href="usuario_index.php" class="btn  btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="usuario_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <input type="hidden" name="voperacion" value="1">
                                        <input type="hidden" name="vusucod" value="0" />

                                        <!--NICK-->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-3">Nombre Usuario</label>
                                            <div class="col-lg-8 col-sm-8 col-xs-9">
                                                <input class="form-control" id="vnick" type="text" name="vnick" required="" onkeypress="return soloLetras(event);" style="width: 500px;" onpaste="return soloLetras(event);" maxlength="30" />
                                            </div>
                                        </div>
                                        <!--CLAVE-->
                                        <div class="passCont form-group has-feedback">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-3">Clave</label>
                                            <div class="col-lg-8 col-sm-8 col-xs-9">
                                                <input type="password" name="vclave" class="form-control" id="vclave" placeholder="Ingrese su contraseña" required="" style="width: 500px;" onkeypress="return alphanum(event);" onpaste="return alphanum(event);" maxlength="20">
                                                <!--- <i class="p glyphicon glyphicon-eye-close form-control-feedback" id="hide" onclick="passFunction()"></i>-->
                                                <!---<i class="p glyphicon glyphicon-eye-open form-control-feedback" id="show" onclick="passFunction()"></i>--->
                                            </div>
                                        </div>

                                        <!--SUCURSAL-->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-3">Sucursal</label>
                                            <div class="col-lg-8 col-sm-8 col-xs-9">
                                                <div class="input-group">
                                                    <?php $sucursal = consultas::get_datos("SELECT * FROM ref_sucursal ORDER BY id_sucursal"); ?>
                                                    <select class="select2" name="vidsucursal" required="" style="width: 200px;">
                                                        <option value="">Seleccione una Sucursal</option>>

                                                        <?php
                                                        if (!empty($sucursal)) {
                                                            foreach ($sucursal as $s) {
                                                                ?>
                                                                <option value="<?php echo $s['id_sucursal']; ?>"><?php echo $s['suc_descri']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos una ciudad</option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                    <span class="input-group-btn">

                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--EMPLEADO-->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-3">Empleado</label>
                                            <div class="col-lg-8 col-sm-8 col-xs-9">
                                                <div class="input-group">
                                                    <?php $empleado = consultas::get_datos("SELECT * FROM v_ref_empleado WHERE id_empleado NOT IN(SELECT id_empleado FROM ref_usuario) ORDER BY id_empleado"); ?>
                                                    <select class="select2" name="vidempleado" required="" style="width: 200px;">
                                                        <option value="">Seleccione un Empleado</option>>
                                                        <?php
                                                        if (!empty($empleado)) {
                                                            foreach ($empleado as $e) {
                                                                ?>
                                                                <option value="<?php echo $e['id_empleado']; ?>"><?php echo $e['per_nombre'] . ' - ' . $e['car_descri']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos una persona</option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                    <span class="input-group-btn">

                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--GRUPO-->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-3">Grupo</label>
                                            <div class="col-lg-8 col-sm-8 col-xs-9">
                                                <div class="input-group">
                                                    <?php $grupo = consultas::get_datos("SELECT * FROM ref_grupos ORDER BY gru_cod"); ?>
                                                    <select class="select2" name="vgrucod" required="" style="width: 200px;">
                                                        <option value="">Seleccione un Grupo</option>>
                                                        <?php
                                                        if (!empty($grupo)) {
                                                            foreach ($grupo as $g) {
                                                                ?>
                                                                <option value="<?php echo $g['gru_cod']; ?>"><?php echo $g['gru_nombre']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos una ciudad</option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                    <span class="input-group-btn">

                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--IMAGEN-->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-3">Imagen</label>
                                            <div class="col-lg-8 col-sm-8 col-xs-9">
                                                <input class="form-control" type="file" name="vimagen" style="width: 500px;" required="" min="0" placeholder="Seleccione una imagen">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: center;">
                                        <button class="fa fa-save btn btn-success pull-right" type="submit"> Registrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!--MODAL DE SUCURSAL-->
                <!----<div class="modal fade" id="registrar_sucursal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="cerrar close" data-dismiss='modal' id="cerrar_ciudad1" arial-label="Close">X</button>
                                <h4 class="modal-title"><strong>Registrar Sucursal</strong></h4>
                            </div>
                            <form action="usuario_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input name="voperacion" value="4" type="hidden">
                                <input name="vusucod" value="0" type="hidden">
                                <div class="box-body">
                                    
                                    <div class="form-group">
                                        <label class="control-label col-lg-2 col-sm-2 col-xs-3">Descripción</label>
                                        <div class="col-lg-8 col-sm-8 col-xs-9">
                                            <input class="form-control" type="text" name="vnick" required="" style="width: 100%;" onkeypress="return alphanum(event);" autofocus="" maxlength="30">
                                        </div>
                                    </div>

                                    <
                                    <div class="form-group">
                                        <label class="control-label col-lg-2 col-sm-2 col-xs-3">Ciudad</label>
                                        <div class="col-lg-8 col-sm-8 col-xs-9">
                                            <div class="input-group">
                                                < ?php $ciudad = consultas::get_datos("SELECT * FROM ref_ciudad ORDER BY id_ciudad"); ?>
                                                <select class="select2" name="vusucod" required="" style="width: 100%;">
                                                    < ?php
                                                    if (!empty($ciudad)) {
                                                        foreach ($ciudad as $c) {
                                                            ?>
                                                            <option value="< ?php echo $c['id_ciudad']; ?>"><? php echo $c['ciu_descri']; ?></option>
                                                            < ?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value="">Debe seleccionar al menos una ciudad</option>
                                                    < ?php }
                                                    ?>
                                                </select>
                                                <span class="input-group-btn">
                                                    <button type="btn" style="border: none; background-color: white;"></button>
                                                </span>
                                            </div>
                                        </div>
                <!--DIRECCION-->
            </div>


            <div class="form-group">
                <label class="control-label col-lg-2 col-sm-2 col-xs-3">Dirección</label>
                <div class="col-lg-8 col-sm-8 col-xs-9">
                    <input class="form-control" id="vdireccion" type="text" name="vclave" required="" onkeypress="return alphanum(event);" style="width: 100%;" maxlength="30" />
                </div>
            </div>

            <!--Telefono-->
            <div class="form-group">
                <label class="control-label col-lg-2 col-sm-2 col-xs-3">Teléfono</label>
                <div class="col-lg-8 col-sm-8 col-xs-9">
                    <input class="form-control" id="vtelefono" type="text" name="vgrucod" required="" onkeypress="return soloNumeros(event);" style="width: 100%;" maxlength="30" />
                </div>
            </div>
            <div class="box-footer" style="text-align: center;">
                <button type="reset" data-dismiss="modal" class="fa fa-remove btn btn-danger pull-left" id="cerrar_ciudad">Cerrar</button>
                <button class="fa fa-save btn btn-success pull-right" type="submit"> Registrar</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>

<!--MODAL DE EMPLEADO-->
<div class="modal fade" id="registrar_empleado" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="cerrar close" data-dismiss='modal' id="cerrar_ciudad1" arial-label="Close">X</button>
                <h4 class="modal-title"><strong>Registrar Empleado</strong></h4>
            </div>
            <form action="usuario_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                <input name="voperacion" value="5" type="hidden">
                <input name="vidempleado" value="0" type="hidden">
                <div class="box-body">
                    <!--PERSONA-->
                    <div class="form-group">
                        <label class="control-label col-lg-2 col-sm-2 col-xs-3">Persona</label>
                        <div class="col-lg-8 col-sm-8 col-xs-9">
                            <div class="input-group">
                                <?php $persona = consultas::get_datos("SELECT * FROM ref_persona ORDER BY id_persona"); ?>
                                <select class="select2" name="vusucod" required="" style="width: 100%;">
                                    <?php
                                    if (!empty($persona)) {
                                        foreach ($persona as $per) {
                                            ?>
                                            <option value="<?php echo $per['id_persona']; ?>"><?php echo $per['per_nombre'] . ' ' . $per['per_apellido']; ?></option>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <option value="">Debe seleccionar al menos una persona</option>
                                    <?php }
                                    ?>
                                </select>
                                <span class="input-group-btn">
                                    <button type="btn" style="border: none; background-color: white;"></button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!--CARGO-->
                    <div class="form-group">
                        <label class="control-label col-lg-2 col-sm-2 col-xs-3">Cargos</label>
                        <div class="col-lg-8 col-sm-8 col-xs-9">
                            <div class="input-group">
                                <?php $cargo = consultas::get_datos("SELECT * FROM ref_cargos ORDER BY id_cargo"); ?>
                                <select class="select2" name="vgrucod" required="" style="width: 100%;">
                                    <?php
                                    if (!empty($cargo)) {
                                        foreach ($cargo as $c) {
                                            ?>
                                            <option value="<?php echo $c['id_cargo']; ?>"><?php echo $c['car_descri']; ?></option>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <option value="">Debe seleccionar al menos un cargo</option>
                                    <?php }
                                    ?>
                                </select>
                                <span class="input-group-btn">
                                    <button type="btn" style="border: none; background-color: white;"></button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!--SUCURSAL-->
                    <div class="form-group">
                        <label class="control-label col-lg-2 col-sm-2 col-xs-3">Sucursal</label>
                        <div class="col-lg-8 col-sm-8 col-xs-9">
                            <div class="input-group">
                                <?php $sucursal = consultas::get_datos("SELECT * FROM ref_sucursal ORDER BY id_sucursal"); ?>
                                <select class="select2" name="vidsucursal" required="" style="width: 100%;">
                                    <?php
                                    if (!empty($sucursal)) {
                                        foreach ($sucursal as $s) {
                                            ?>
                                            <option value="<?php echo $s['id_sucursal']; ?>"><?php echo $s['suc_descri']; ?></option>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <option value="">Debe seleccionar al menos una sucursal</option>
                                    <?php }
                                    ?>
                                </select>
                                <span class="input-group-btn">
                                    <button type="btn" style="border: none; background-color: white;"></button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2 col-sm-2 col-xs-3">Descripcion</label>
                        <div class="col-lg-8 col-sm-8 col-xs-9">
                            <input type="text" class="form-control" name="vnick" required="" autofocus="autofocus" id="vdescriciu" maxlength="30" onkeypress="return soloLetras(event);" style="width: 100%">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="reset" data-dismiss="modal" class="fa fa-remove btn btn-danger" id="cerrar_ciudad"> Cerrar</button>
                    <button type="submit" class="fa fa-save btn btn-success pull-right"> Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--MODAL DE GRUPO-->
<div class="modal fade" id="registrar_grupo" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="cerrar close" data-dismiss='modal' id="cerrar_ciudad1" arial-label="Close">X</button>
                <h4 class="modal-title"><strong>Registrar Grupo</strong></h4>
            </div>
            <form action="usuario_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                <input name="voperacion" value="6" type="hidden">
                <input name="vgrucod" value="0" type="hidden">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Descripción</label>
                        <div class="col-xs-10 col-md-10 col-lg-10">
                            <input type="text" class="form-control" name="vnick" id="vgrunombre" required="" maxlength="40" onkeypress="return soloLetras(event);">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="reset" data-dismiss="modal" class="fa fa-remove btn btn-danger" id="cerrar_ciudad"> Cerrar</button>
                    <button type="submit" class="fa fa-save btn btn-success pull-right"> Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
</div>
<?php require '../../estilos/pie.ctp'; ?>
</BODY>
<?php require '../../estilos/js_lte.ctp'; ?>
<script>
    /*MENSAJE DE INSERT*/
    $("#mensaje").delay(1000).slideUp(200, function () {
        $(this).alert('close');
    });
    //ALPHANUMERICO
    function alphanum(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toString();
        letras = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzáéíóú";

        especiales = [8, 13, 32, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57];
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

    function soloNumeros(evt) {
        if (window.event) {
            keynum = evt.keyCode;
        } else {
            keynum = evt.which;
        }

        if ((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13) {
            return true;
        } else {
            //alert("Ingresar solo numeros");
            return false;
        }
    }

    //focus en el primer input tipo per
    $(document).ready(function () {
        $('#registrar_tipoper').on('shown.bs.modal', function () {
            $('#vtipoper').focus();
        });
    });

    //LIMPIAR AUTOMÁTICO tipo per
    $("#cerrar_tipoper, #cerrar_tipoper1").click(function () {
        $('#vidtipoper').val("");
    });

    //focus en el primer input tipo de ciudad
    $(document).ready(function () {
        $('#registrar_ciudad').on('shown.bs.modal', function () {
            $('#vdescriciu').focus();
        });
    });

    //LIMPIAR AUTOMÁTICO TIPO DE CIUDAD
    $("#cerrar_ciudad, #cerrar_ciudad1").click(function () {
        $('#vdescriciu').val("");
    });

    /*  function passFunction() {
     var x = document.getElementById("vclave");
     if (x.type === "password") {
     x.type = "text";
     document.getElementById('show').style.display = "inline-block";
     document.getElementById('hide').style.display = "none";
     } else {
     x.type = "password";
     document.getElementById('show').style.display = "none";
     document.getElementById('hide').style.display = "inline-block";
     }
     }*/
</script>

</HTML>