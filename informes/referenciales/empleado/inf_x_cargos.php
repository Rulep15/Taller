<?php
session_start();
require '../../../conexion.php';
require '../../../estilos/css_lte.ctp';
?>
<form accept-charset="UTF8" class="form-horizontal">
    <input name="opcion" value="2" id="opcion" type="hidden"/>
    <div class="col-md-6 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active" style="background-color: #465F62;">Informes de Empleado por Cargos</a>
        </div>
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label">Cargos</label>
            <div class="col-sm-6">
                <?php $consultas = consultas::get_datos("SELECT * FROM ref_cargos ORDER BY id_cargo"); ?>
                <select class="form-control select2" name="vpag" id="vciudad" style="width: 215px;">
                    <?php
                    if (!empty($consultas)) {
                        foreach ($consultas as $c) {
                            ?>
                            <option value="<?php echo $c['id_cargo']; ?>">
                            <?php echo $c['car_descri']; ?>
                            </option>
                            <?php
                        }
                    } else {
                        ?>
                            <option value="0">No existe ningun registro..</option>>

                        <?php }
                        ?>
                </select>
            </div>
            <div class="form-group col-md-1">
                <div class="col-md-1 pull-right">
                    <a onclick="enviar();" rel="tooltip" data-tittle="Imprimir" class="btn btn-primary"
                       style="background-color: #465F62" role="button"> 
                        <span class="fa fa-print"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
<?php require '../../../estilos/js_lte.ctp'; ?>
<script>
 function enviar(){
     window.open("/T.A/informes/referenciales/empleado/impresion.php?vciudad=" + "'" + $('#vciudad').val() + "'" + '&vopcion=' + $('#opcion').val(), '_blank');
     
 }
</script>

