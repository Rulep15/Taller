<?php
session_start();
require '../../../conexion.php';
require '../../../estilos/css_lte.ctp';
?>

<form accept-charset="UFT8" class="form-horizontal" onsubmit="return showValues();">
    <input name="option" value="1" id="opcion" type="hidden">
    <div class="col-md-8 col-md-offset-0" style=" margin-top: -14px; border: none;">
        <div class="list-group">
            <a href="#" class="list-group-item active" style="background-color: #465F62">Reportes por Fecha</a>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-2 col-sm-2 col-xs-2">Desde</label>
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <input class="form-control" type="date" id="iddesde" name="vdesde"
                       value="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d'); ?>" min="" required=""
                       >
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-lg-2 col-sm-2 col-xs-2">Hasta</label>
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <input class="form-control" type="date" id="idhasta" name="vhasta"
                       value="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d'); ?>"  min="" disabled="" required=""
                       >
            </div>
        </div>
        <div class="form-group col-md-8">
            <div class="col-md-1 pull-right">
                <a onclick="enviar();" rel="tooltip" data-title="Imprimir" class="btn btn-primary" style="background-color: #465F62" role="button">
                    <span class="fa fa-print"></span> 
                </a>
            </div>
        </div>
    </div>
</form>
<script>
    function enviar() {
        window.open("/T.A/informes/compras/cuenta/cuenta_print.php?vdesde=" + "'" + $('#iddesde').val() + "'" + "&vhasta=" + "'" + $('#idhasta').val() + "'" + "&vopcion=" + $('#opcion').val(), '_blank');
    }
</script>
<script>
//     function hasta() {
//        var input = document.getElementById("idhasta");
//        input.setAttribute("min", this.value);
//        document.getElementById('idhasta').removeAttribute('disabled');
//    }
//    function desde() {
//        var input = document.getElementById("iddesde");
//        input.setAttribute("max", this.value);
//    }
    document.getElementById("iddesde").onchange = function () {
        var input = document.getElementById("idhasta");
        input.setAttribute("min", this.value);
        document.getElementById('idhasta').removeAttribute('disabled');
    }
    document.getElementById("idhasta").onchange = function () {
        var input = document.getElementById("iddesde");
        input.setAttribute("max", this.value);
    }
</script>