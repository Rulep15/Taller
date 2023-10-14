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
                                    <h3 class="box-title">Agregar Deposito</h3>
                                    <div class="box-tools">
                                        <a href="deposito_index.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="deposito_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class="row">
                                            <input type="hidden" name="voperacion"  value="1">
                                            <input type="hidden" name="vcodigo" value="0"/> 
                                            
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">Sucursal</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $sucursal = consultas::get_datos("SELECT * FROM ref_sucursal ORDER BY id_sucursal"); ?>
                                                        <select class="select2"  name="vidsucursal" required="" style="width: 320px;">
                                                            <?php
                                                            if (!empty($sucursal)) {
                                                                foreach ($sucursal as $s) {
                                                                    ?>
                                                                    <option value="<?php echo $s['id_sucursal']; ?>"><?php echo $s['suc_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos un sucursal</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-toolbar btn-flat"  type="button" data-toggle="modal" data-target="#registrar_sucursal">
                                                                <i style="color: #465F62" class="fa fa-plus"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Descripcion</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input maxlength="30" class="form-control" type="text" name="vdescripcion" required="" onkeypress="return soloLetras(event);" >
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
                <!--MODAL DE SUCURSAL-->
                <div class="modal fade" id="registrar_sucursal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Registrar Sucursal</strong></h4>
                            </div>
                            <form action="deposito_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input name="voperacion" value="4" type="hidden">
                                <input name="vidsucursal" value="0" type="hidden" id="vidsucursal">
                                
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Descripcion</label>
                                        <div class="col-xs-10 col-md-10 col-lg-10">
                                            <input type="text" class="form-control" name="vdescripcion" required="" autofocus="" id="vsucdescri" onkeypress="return soloLetras(event);" >
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Telefono</label>
                                        <div class="col-xs-10 col-md-10 col-lg-10">
                                            <input type="number" class="form-control" name="vcodigo" required="" autofocus="" id="vsuctelefono" min="0">
                                        </div>
                                    </div>
                                </div><div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Direccion</label>
                                        <div class="col-xs-10 col-md-10 col-lg-10">
                                            <input type="text" class="form-control" name="vdescripcion" required="" autofocus="" id="vsucdireccion">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="reset" data-dismiss="modal" class="fa fa-remove btn btn-danger" id="cerrar_sucursal">Cerrar</button>
                                    <button type="submit" class="fa fa-save btn btn-success pull-right"> Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--MODAL DE SUCURSAL-->
                
            </div>
        </div>
        <?php require '../../estilos/pie.ctp'; ?>
    </BODY>
    <?php require '../../estilos/js_lte.ctp'; ?>
    <script>
        /*MENSAJE DE INSERT SUCURSAL, DEPOSITO,. ETC*/
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });
        /*Focus en el primer input de sucursal*/
        $(document).ready(function () {
            $('#registrar_sucursal').on('shown.bs.modal', function () {
                $('#vsucidciudad','#vsucdescri', '#vsuctelefono', '#sucdireccion').focus();
            });
        });
        /*limpiar campos al cerrar nuestro modal sucursal*/
        $("#cerrar_sucursal").click(function () {
            $("#vsucidciudad, #vsucdescri, #vsuctelefono, #vsucdireccion").val("");
        });
        
    </script>
      <script>
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
</HTML>
