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
        <div class="wrapper">
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
                                    <h3 class="box-title">Agregar Producto</h3>
                                    <div class="box-tools">
                                        <a href="productos_index.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="productos_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class="row">
                                            <input type="hidden" name="voperacion"  value="1">
                                            <input type="hidden" name="vidproducto" value="0"/> 
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Codigo de barra</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="number" name="vcodigob" required="" autofocus onkeypress="return soloNumero(event)">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">Marcas</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $marcas = consultas::get_datos("SELECT * FROM ref_marca ORDER BY mar_cod"); ?>
                                                        <select class="select2" name="vidmarca" required="" style="width: 320px;">
                                                            <?php
                                                            if (!empty($marcas)) {
                                                                foreach ($marcas as $m) {
                                                                    ?>
                                                                    <option value="<?php echo $m['mar_cod']; ?>"><?php echo $m['mar_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos una marca</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-toolbar btn-flat" type="button" data-toggle="modal" data-target="#registrar_marca">
                                                                <i style="color: #465F62" class="fa fa-plus"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">Tipo</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $tipoprod = consultas::get_datos("SELECT * FROM ref_tipo_producto ORDER BY id_tipro"); ?>
                                                        <select class="select2" name="vidtipro" required="" style="width: 320px;">
                                                            <?php
                                                            if (!empty($tipoprod)) {
                                                                foreach ($tipoprod as $tp) {
                                                                    ?>
                                                                    <option value="<?php echo $tp['id_tipro']; ?>"><?php echo $tp['tipro_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos un tipo</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-toolbar btn-flat" type="button" data-toggle="modal" data-target="#registrar_tipoprod">
                                                                <i style="color: #465F62" class="fa fa-plus"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">Impuesto</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $tipoimp = consultas::get_datos("SELECT * FROM ref_tipo_impuesto ORDER BY id_timp"); ?>
                                                        <select class="select2" name="vidtimp" required="" style="width: 320px;">
                                                            <?php
                                                            if (!empty($tipoimp)) {
                                                                foreach ($tipoimp as $tim) {
                                                                    ?>
                                                                    <option value="<?php echo $tim['id_timp']; ?>"><?php echo $tim['descripcion']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos un tipo</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-toolbar btn-flat" type="button" data-toggle="modal" data-target="#registrar_tipoimp">
                                                                <i style="color: #465F62" class="fa fa-plus"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">U.Medida</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $Unidad = consultas::get_datos("SELECT * FROM ref_unidadmedida ORDER BY id_um"); ?>
                                                        <select class="select2" name="vidum" required="" style="width: 320px;">
                                                            <?php
                                                            if (!empty($Unidad)) {
                                                                foreach ($Unidad as $um) {
                                                                    ?>
                                                                    <option value="<?php echo $um['id_um']; ?>"><?php echo $um['descripcion']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos un tipo</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-toolbar btn-flat" type="button" data-toggle="modal" data-target="#registrar_unidadm">
                                                                <i style="color: #465F62" class="fa fa-plus"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Descripcion</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input maxlength="250" class="form-control" type="text" name="vdescripcion" required=""  onkeypress="return soloLetras(event);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Precio Compra</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="number" onkeypress="return soloNumero(event)" name="vprecioc" required="" min="0">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Precio Venta</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="number"  onkeypress="return soloNumero(event)" name="vpreciov" required="" min="0">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Imagen</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input maxlength="100" class="form-control" type="file" name="vimagen" required="" min="0"
                                                           placeholder="Seleccione una imagen">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: center;">
                                        <button class="fa fa-save btn btn-success pull-right" type="submit"> Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--MODAL DE MARCAS-->
                <div class="modal fade" id="registrar_marca" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Registrar Marca</strong></h4>
                            </div>
                            <form action="productos_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input name="voperacion" value="4" type="hidden">
                                <input name="vidmarca" value="0" type="hidden" id="vidmarca">
                                <input name="vidmarca" value="0" type="hidden" id="vidmarca">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Descripcion</label>
                                        <div class="col-xs-10 col-md-10 col-lg-10">
                                            <input type="text" class="form-control" name="vdescripcion" required="" autofocus="" id="vmardescri"  onkeypress="return soloLetras(event);">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="reset" data-dismiss="modal" class="fa fa-remove btn btn-danger" id="cerrar_marca"> Cerrar</button>
                                    <button type="submit" class="fa fa-save btn btn-success pull-right"> Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--MODAL DE MARCAS-->
                <!--MODAL DE TIPRO-->
                <div class="modal fade" id="registrar_tipoprod" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Registrar Tipo Producto</strong></h4>
                            </div>
                            <form action="productos_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input name="voperacion" value="5" type="hidden">
                                <input name="vidtipro" value="0" type="hidden">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Descripcion</label>
                                        <div class="col-xs-10 col-md-10 col-lg-10">
                                            <input type="text" class="form-control" name="vdescripcion" required="" autofocus="autofocus"  onkeypress="return soloLetras(event);" id="vtiprodescri">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="reset" data-dismiss="modal" class="fa fa-remove btn btn-danger" id="cerrar_tp" > Cerrar</button>
                                    <button type="submit" class="fa fa-save btn btn-success pull-right">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--MODAL DE TIPRO-->
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
        /*Focus en el primer input de marca*/
        $(document).ready(function () {
            $('#registrar_marca').on('shown.bs.modal', function () {
                $('#vmardescri').focus();
            });
        });
        /*limpiar campos al cerrar nuestro modal marca*/
        $("#cerrar_marca").click(function () {
            $('#vidmarca, #vmardescri').val("");
        });
        /*Focus en el primer input de tipopro*/
        $(document).ready(function () {
            $('#registrar_tipoprod').on('shown.bs.modal', function () {
                $('#vtiprodescri').focus();
            });
        })
        /*limpiar campos al cerrar nuestro modal tipo pro*/
        $("#cerrar_tp").click(function () {
            $('vidtipro, #vtiprodescri').val("");
        });
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
