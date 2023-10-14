<?php session_start(); ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta content="width=devicewidth,initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
                            <div class="box box_primary">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title"> Inhabilitar a una Persona</h3>
                                    <div class="box-tools">
                                        <a href="persona_index.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>

                                    </div>

                                </div>
                                <form action="persona_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <?php $resultado = consultas::get_datos("SELECT * FROM v_ref_persona WHERE id_persona =" . $_GET['vidpersona']); ?>
                                    <!--?php $vistas = consultas::get_datos("SELECT * FROM v_ref_persona WHERE id_persona =" . $_GET['vid_persona']); ?--> 

                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion" value="3">
                                            <input type="hidden" name="vidpersona" value="<?php echo $resultado[0]['id_persona']; ?>">
                                            <input type="hidden" name="vci" value="<?php echo $resultado[0]['per_nro_doc']; ?>">
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Nombre</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" disabled="" value="<?php echo $resultado[0]['per_nombre']; ?>" name="vnombre" required="" autofocus="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Apellido</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text"  disabled="" value="<?php echo $resultado[0]['per_apellido']; ?>" name="vapellido" required="" autofocus="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Cedula</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text"  disabled="" value="<?php echo $resultado[0]['per_nro_doc']; ?>"  name="vci" required="" autofocus="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >RUC</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text"  disabled=""  value="<?php echo $resultado[0]['per_ruc']; ?>"name="vruc" required="" autofocus="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Ciudad</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <?php $marcas = consultas::get_datos("SELECT * FROM ref_ciudad where id_ciudad !=" . $resultado[0]['id_ciudad']); ?>
                                                        <select class="form-control select3"   disabled="" name="vidciudad" required="" style="width: 320px;">  
                                                            <option value="<?php echo $resultado[0]['id_ciudad']; ?>"><?php echo $resultado[0]['ciu_descri']; ?></option>
                                                            <?php
                                                            if (!empty($marcas)) {
                                                                foreach ($marcas as $m) {
                                                                    ?>
                                                                    <option value="<?php echo $m['id_ciudad']; ?>"><?php echo $m['ciu_descri']; ?></option>
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
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Tipo persona</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <?php $marcas = consultas::get_datos("SELECT * FROM ref_tipo_persona where id_tipper !=" . $resultado[0]['id_tipper']); ?>
                                                        <select class="form-control select3" name="vtipoper" required="" disabled="" style="width: 320px;">  
                                                            <option value="<?php echo $resultado[0]['tipo_per_cod']; ?>"><?php echo $resultado[0]['tp_descri']; ?></option>
                                                            <?php
                                                            if (!empty($marcas)) {
                                                                foreach ($marcas as $m) {
                                                                    ?>
                                                                    <option  disabled="" value="<?php echo $m['id_tipper']; ?>"><?php echo $m['tp_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option  disabled="" value="">Debe seleccionar al menos un tipo de persona</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Direccion</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control"  disabled="" type="text" value="<?php echo $resultado[0]['per_direccion']; ?>" name="vdireccion" required="">
                                                </div>
                                            </div>
                                            <!--Fin Codigo de descripcion-->
                                            <!--Codigo Precio compra-->
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Telefono</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control"  disabled="" type="text" value="<?php echo $resultado[0]['per_telefono']; ?>" name="vtelefono" required="" min="0">
                                                </div>
                                            </div>
                                            <!--Fin Codigo Precio compra-->
                                            <!--Codigo Precio venta-->
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Email</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control"  disabled="" type="text" value="<?php echo $resultado[0]['per_email']; ?>" name="vcorreo" required="" min="0">
                                                </div>
                                            </div>
                                            <div class = "form-group">
                                                <label class = "control-label  col-lg-3 col-sm-2 col-xs-2">Sexo</label>
                                                <div class = "col-lg-4 col-sm-4 col-xs-4">
                                                    <select class="form-control select3"  disabled="" name="vpersexo" value="<?php echo $resultado[0]['vsexo']; ?>" required="" style="width: 150px;">
                                                        <option value="FEMENINO">FEMENINO</option>
                                                        <option value="MASCULINO">MASCULINO</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Fec. Nac.</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text"  disabled="" value="<?php echo $resultado[0]['per_fecha_nacimiento']; ?>" name="vfechanac" required="" min="0">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Razon social</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text"  disabled="" value="<?php echo $resultado[0]['razon_social']; ?>" name="vrazons" required="" min="0">
                                                </div>
                                            </div>
                                            <!--Codigo imagen-->
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Imagen</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control"  disabled="" type="file" name="vimagen" required="" min="0" placeholder="Seleccionne una imagen">
                                                </div>
                                            </div>
                                            <!--Fin Codigo imagen-->
                                        </div>

                                    </div>
                                    <div class = "box-footer">
                                        <button class = "fa fa-remove btn btn-danger pull-right" type = "submit"> Inhabilitar</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "modal fade" id = "registrar_ciudad" role = "dialog">
                    <div class = "modal-dialog">
                        <div class = "modal-content">
                            <div class = "modal-header">

                                <h4 class = "modal-title"><strong>Registrar Ciudad</strong></h4>
                            </div>
                            <form action = "persoma_control.php" method = "POST" accept-charset = "UTF-8" class = "form-horizontal">
                                <input type = "hidden" name = "voperacion" value = "4">
                                <input type = "hidden" name = "vidciudad" value = "0" id = "vidpais">
                                <div class = "box-body">
                                    <div class = "form-group">
                                        <label class = "control-label col-lg-3 col-sm-2 col-xs-2" >Descripcion</label>
                                        <div class = "col-lg-4 col-sm-4 col-xs-4">
                                            <input type = "text" class = "form-control" name = "vpernombre" required = "" id = "vsucdescri">
                                        </div>
                                    </div>
                                    <div class = "form-group">
                                        <label class = "control-label col-lg-3 col-sm-2 col-xs-2" >Pais</label>
                                        <div class = "col-lg-4 col-sm-4 col-xs-4">
                                            <div class = "input-group">
                                                <?php $paiss = consultas::get_datos("SELECT * FROM ref_pais ORDER BY id_pais");
                                                ?>
                                                <select class="form-control select3" name="vidcodigo" required="" style="width: 150px;">
                                                    <?php
                                                    if (!empty($paiss)) {
                                                        foreach ($paiss as $m) {
                                                            ?>
                                                            <option value="<?php echo $m['id_pais']; ?>"><?php echo $m['pai_descri']; ?></option>
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
                                    <button type="reset" data-dismiss="modal" class="fa fa-remove btn btn-danger" id="cerrar_ciudad"> Cerrar</button>
                                    <button type="submit" class="fa fa-save btn btn-success pull-right"> Guardar</button>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
                <!--MODAL MARCAS-->
                <div class="modal fade" id="registrar_marca" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title"><strong>Registrar Tipo de persona</strong></h4>
                            </div>
                            <form action="persona_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input type="hidden" name="voperacion" value="5">
                                <input type="hidden" name="vtipopercod" value="0" id="vidmarca">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2">Descripcion</label>
                                        <div class="col-xs-10 col-md-10 col-lg-10">
                                            <input type="text" class="form-control" name="vpernombre" required="" id="vmardescri">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="reset" data-dismiss="modal" class="fa fa-remve btn btn-danger" id="cerrar_marca"> Cerrar</button>
                                    <button type="submit" class="fa fa-save btn btn-success pull-right"> Guardar</button>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
                <!--MODAL MARCAS-->
            </div>
        </div>
        <?php require '../../estilos/pie.ctp'; ?>
    </body>
    <?php require '../../estilos/js_lte.ctp'; ?>
    <script>
   
    </script>
</html>