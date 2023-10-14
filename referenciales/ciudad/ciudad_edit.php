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
            <div class="content-wrapper" style="background-color: #1E282C;">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Editar Ciudad</h3>
                                    <div class="box-tools">
                                        <a href="ciudad_index.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="ciudad_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class=row">
                                            <?php $resultado = consultas::get_datos("SELECT * FROM v_ref_ciudad WHERE id_ciudad =" . $_GET['vidciudad']); ?>
                                            <!--CIUDAD-->
                                            <div class="form-group">
                                                <input type="hidden" name="voperacion"  value="2">
                                                <input type="hidden" name="vidciudad" value="<?php echo $resultado[0]['id_ciudad']; ?>"/> 
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Ciudad.</label>
                                                    <div class="col-lg-8">
                                                        <input class="form-control" type="text" name="vciudescri" required="" value="<?php echo $resultado[0]['ciu_descri']; ?>"
                                                               style="width: 500px;" onkeypress="return soloLetras(event);" maxlength="30">
                                                    </div>
                                                </div>
                                            </div>
 
                                            <!--PAIS-->
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">País</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $pais = consultas::get_datos("SELECT * FROM ref_pais ORDER BY id_pais"); ?>
                                                        <select class="select2" name="vidpais" required="" style="width: 500px;">  
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

                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: center;">
                                        <button class="fa fa-save btn btn-success pull-right " type="submit"> Guardar</button>
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
