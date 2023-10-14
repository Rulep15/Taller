<?php
session_start();
require '../../../conexion.php';
require '../../../estilos/css_lte.ctp';
?>
<form accept-charset="UTF8" class="form-horizontal">
    <input name="opcion" value="2" id="opcion" type="hidden"/>
    <div class="col-md-6 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active" style="background-color: #465F62;">Informes de Orden de Compra por Estado</a>
        </div>
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label">Estados</label>
            <div class="col-sm-6">
                <select id="vestado" class="form-control select2" name="vpag"  style="width: 215px;">
                    <option value="ACTIVO">ACTIVO</option>
                    <option value="ANULADO">ANULADO</option>
                    <option value="CONFIRMADO">CONFIRMADO</option>
                    <option value="EN USO">EN USO</option>
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
    function enviar() {
        window.open("/T.A/informes/compras/orden/impresion.php?vciudad=" + "'" + $('#vestado').val() + "'" + '&vopcion=' + $('#opcion').val(), '_blank');

    }
</script>
