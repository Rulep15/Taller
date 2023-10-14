<?php
require '../../conexion.php';
session_start();

if (isset($_REQUEST['vgrup'])) {
    $gru = $_REQUEST['vgrup'];
    $grunom = $_REQUEST['vgrunombre'];
} else {
    echo 'VALORES VACIOS';
}
?>
<div class="modal-header">
    <button type = "button" class = "close" data-dismiss="modal" arial-label="Close">x</button>
    <h4 class = "modal-title"><strong>Registrar Permisos</strong></h4>
</div>
<div class="panel-body">
    <form action = "permisos_control.php" method = "post" accept-charset = "utf-8" class = "form-horizontal">
        <div class = "panel-body se">
            <input type = "hidden" name = "accion" value="1">
            <input type = "hidden" name = "vgru" value="<?php echo $gru ?>"/>
            <input type = "hidden" name = "vgrunombre" value="<?php echo $grunom ?>">
            <input type = "hidden" name = "pagina" value="permisos_index.php">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-xs-3">
                    <label class = "col-lg-2 control-label">Grupo</label>
                    <input type="text" class="form-control" name="grupo" value="<?php echo $gru ?>" readonly=""/>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-3" style="left: auto; width: 400px;">
                    <label class="col-lg-2 control-label">Paginas</label>
                    <?php $paginas = consultas::get_datos("select * from ref_paginas where pag_cod not in (select pag_cod from ref_permisos where gru_cod=". $gru .")"); ?>                                 
                    <select name="vpag" class="form-control">
                        <?php
                        if (!empty($paginas)) {
                            foreach ($paginas as $pag) {
                                ?>
                                <option value="<?php echo $pag['pag_cod']; ?>"><?php echo $pag['pag_nombre']; ?></option>
                                <?php
                            }
                        } else {
                            ?>
                            <option value="0">Debe insertar registros</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-xs-3" style="left: 200px">
                    <label class="col-lg-2 control-label">Permisos</label>     
                    <br>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" value="false" name="consul" id="PermisoConsul">
                            <input type="checkbox" value="true" name="consul" id="PermisoConsul">Consultar
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" value="false" name="agre" id="PermisoAgre">
                            <input type="checkbox" value="true" name="agre" id="PermisoAgre">Insertar
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" value="false" name="editar" id="PermisoConsul">
                            <input type="checkbox" value="true" name="editar" id="PermisoConsul">Actualizar
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" value="false" name="borrar" id="PermisoAgre">
                            <input type="checkbox" value="true" name="borrar" id="PermisoAgre">Borrar
                        </label>
                    </div>
                </div>                               
            </div>
        </div>  
        <div class="modal-footer" style="border-top: 1px solid #e5e5e5;margin-left: -1.1em;margin-right: -1.1em;margin-top: 1.5em;;padding-top: 1em;padding-right: 1em;">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-floppy-o"></i> Registrar
            </button>
            <button type="reset" data-dismiss="modal" class="btn btn-danger">
                <i class="fa fa-close"></i> Cerrar
            </button>
        </div>
    </form>
</div>

