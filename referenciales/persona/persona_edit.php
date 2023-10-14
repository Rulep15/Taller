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
        <div class="wrapper" style="background-color: #1E282C">
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
                                    <h3 class="box-title">Edita una Persona</h3>
                                    <div class="box-tools">
                                        <a href="persona_index.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="persona_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class="row">
                                            <?php $resultado = consultas::get_datos("SELECT * FROM v_ref_persona WHERE id_persona =" . $_GET['vidpersona']); ?>

                                            <input type="hidden" name="voperacion" value="2">
                                            <input type="hidden" name="vidpersona" value="<?php echo $resultado[0]['id_persona']; ?>"/> 
                                            <!--CI-->
                                            <div class ="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">C.I</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="text" name="vci" required="" style="width: 500px;" 
                                                           autofocus="" maxlength="30" onkeypress="return controltag(event); " value="<?php echo $resultado[0]['per_nro_doc']; ?>">
                                                </div>
                                            </div>    
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Nombre</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="text" name="vnombre" required="" style="width: 500px;" onkeypress="return soloLetras(event);" 
                                                           autofocus="" maxlength="30" value="<?php echo $resultado[0]['per_nombre']; ?>">
                                                </div>

                                            </div>   


                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Apellido</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="text" name="vapellido" required="" style="width: 500px;" onkeypress="return soloLetras(event);" 
                                                           autofocus="" maxlength="30" value="<?php echo $resultado[0]['per_apellido']; ?>">
                                                </div>
                                            </div>
                                            <!--CIUDAD-->
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">Ciudad</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $ciudad = consultas::get_datos("SELECT * FROM ref_ciudad ORDER BY id_ciudad"); ?>
                                                        <select class="select2" name="vidciudad" required="" style="width: 500px;">
                                                            <?php
                                                            if (!empty($ciudad)) {
                                                                foreach ($ciudad as $c) {
                                                                    ?>
                                                                    <option value="<?php echo $c['id_ciudad']; ?>"><?php echo $c['ciu_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos una ciudad</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-toolbar btn-flat btn-sm" type="button" data-toggle="modal" data-target="#registrar_ciudad">
                                                                <i style="color: #465F62" class="fa fa-plus"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--TIPO DE PERSONA-->
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">Tipo de Persona</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $tipoper = consultas::get_datos("SELECT * FROM ref_tipo_persona ORDER BY id_tipper"); ?>
                                                        <select class="select2" name="vtipoper" required="" style="width: 500px;">
                                                            <?php
                                                            if (!empty($tipoper)) {
                                                                foreach ($tipoper as $tp) {
                                                                    ?>
                                                                    <option value="<?php echo $tp['id_tipper']; ?>"><?php echo $tp['tp_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos un Tipo de Persona</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-toolbar btn-flat " type="button" data-toggle="modal" data-target="#registrar_tipopersona">
                                                                <i style="color: #465F62" class="fa fa-plus"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--TIPO DE PERSONA-->
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">R.U.C</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="text" name="vruc" required="" style="width: 500px;" 
                                                           autofocus="" maxlength="20" value="<?php echo $resultado[0]['per_ruc']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Direccion</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="text" name="vdireccion" required="" style="width: 500px;" 
                                                           autofocus="" maxlength="30" value="<?php echo $resultado[0]['per_direccion']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Telefono</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="text" name="vtelefono" required="" style="width: 500px;" 
                                                           autofocus="" maxlength="30" value="<?php echo $resultado[0]['per_telefono']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Email</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="text" name="vcorreo" required="" style="width: 500px;" 
                                                           autofocus="" maxlength="30" value="<?php echo $resultado[0]['per_email']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Sexo</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input type="radio" name="vsexo" value="Masculino" value="<?php echo $resultado[0]['per_sexo']; ?>">Masculino</input>
                                                    <br>
                                                    <input type="radio" name="vsexo" value="Femenino" value="<?php echo $resultado[0]['per_sexo']; ?>">Femenino</input>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Fecha de Nacimiento</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="date" name="vfechanac" required="" style="width: 500px;" 
                                                           autofocus="" maxlength="30" value="<?php echo $resultado[0]['per_fecha_nacimiento']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Razon Social</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="text" name="vrazons" required="" style="width: 500px;" 
                                                           autofocus="" maxlength="30" value="<?php echo $resultado[0]['razon_social']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Imagen</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="file" name="vimagen" required="" min="0"
                                                           placeholder="Seleccione una imagen">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: center;">
                                        <button class="fa fa-save btn btn-success btn-lg pull-right" type="submit"> Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--MODAL DE ciudad-->
                    <div class="modal fade" id="registrar_ciudad" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="cerrar close" data-dismiss='modal' id="cerrar_ciudad1" arial-label="Close">X</button>
                                    <h4 class="modal-title"><strong>Registrar Ciudad</strong></h4>
                                </div>
                                <form action="persona_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <input name="voperacion" value="4" type="hidden">
                                    <input name="vidciudad" value="0" type="hidden">
                                    <div class="box-body">
                                        <!--PAIS-->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-2">Pais</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                                <div class="input-group">
                                                    <?php $pais = consultas::get_datos("SELECT * FROM ref_pais ORDER BY id_pais"); ?>
                                                    <select class="select2" name="vidpersona" required="" style="width: 400px;">
                                                        <?php
                                                        if (!empty($pais)) {
                                                            foreach ($pais as $p) {
                                                                ?>
                                                                <option value="<?php echo $p['id_pais']; ?>"><?php echo $p['pai_descri']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos un pais</option>             
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Descripcion</label>
                                            <div class="col-xs-10 col-md-10 col-lg-10">
                                                <input type="text" class="form-control" name="vnombre" required="" autofocus="autofocus" id="vdescriciu" maxlength="30" onkeypress="return soloLetras(event);">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="reset" data-dismiss="modal" class="fa fa-remove btn btn-danger" id="cerrar_ciudad" > Cerrar</button>
                                        <button type="submit" class="fa fa-save btn btn-success pull-right"> Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--MODAL DE UNIDAD DE MEDIDA-->
                    <div class="modal fade" id="registrar_tipopersona" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><strong>Registrar Tipo de Persona</strong></h4>
                                </div>
                                <form action="persona_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <input name="voperacion" value="5" type="hidden">
                                    <input name="tipopersona" value="0" type="hidden">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Descripcion</label>
                                            <div class="col-xs-10 col-md-10 col-lg-10">
                                                <input type="text" class="form-control" name="vnombre" required="" autofocus="autofocus" id="vdescripcion">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="reset" data-dismiss="modal" class="fa fa-remove btn btn-danger" id="cerrar_tipoper"> Cerrar</button>
                                        <button type="submit" class="fa fa-save btn btn-success pull-right"> Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--MODAL DE IMPUESTO-->
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
        function soloLetras(e)
        {
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

            if (letras.indexOf(tecla) == -1 && !tecla_especial)
            {
                //alert("Ingresar solo letras");
                return false;
            }
        }


    </script>
       <script type="text/javascript"> function controltag(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==8) return true;
        else if (tecla==0||tecla==9)  return true;
       // patron =/[0-9\s]/;// -> solo letras
        patron =/[0-9\s]/;// -> solo numeros
        te = String.fromCharCode(tecla);
        return patron.test(te);
    }
	</script>
</HTML>
