<?php session_start() ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="uft-8" <meta content="width=devicewitdh, initial-scale=1, maximum-scale=1,
              user-scalable=no" name="viewport">
    <?php
    include '../../conexion.php';
    require '../../estilos/css_lte.ctp';
    ?>
 

</head>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper" style="background-color: #1E282C;">
        <?php require '../../estilos/cabecera.ctp'; ?>
        <?php require '../../estilos/izquierda.ctp'; ?>
        <div class="content-wrapper" style="background-color: #1E282C;">
            <div class="content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <!--Mensaje de guardado exitoso o error-->
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
                            <!--Cabecera-->
                            <div class="header box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Paginas</h3>
                                <div class="box-tools">
                                    <!--Agregar-->
                                    <a href="" class="btn-header btn-toolbar pull-right" role="button"
                                        data-toggle="modal" data-target="#registrar">
                                        <i style="color: #465F62" class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <!--Cuerpo-->
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <!--BUSCADOR-->
                                        <form action="pagina_index.php" method="POST" accept-charset="UFT-8"
                                            class="form-horizontal">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="input-group custom-search-form">
                                                            <input type="search" class="form-control" name="buscar"
                                                                placeholder="Buscar..." autofocus="" />
                                                            <span class="input-group-btn">
                                                                <button type="submit" class="btn btn-toolbar btn-flat"
                                                                    data-title="Buscar" data-placement="bottom"
                                                                    rel="tooltip">
                                                                    <span style="color: #465F62" class="fa fa-search"></span>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <?php
                                        $valor = '';
                                        if (isset($_REQUEST['buscar'])) {
                                            $valor = $_REQUEST['buscar'];
                                        }

                                        $paginas = consultas::get_datos(
                                            "SELECT * FROM ref_paginas WHERE (pag_cod||TRIM(UPPER(pag_nombre))) "
                                            . "LIKE TRIM(UPPER('%" . $valor . "%')) ORDER BY pag_cod"
                                        );

                                        if (!empty($paginas)) {
                                        ?>
                                        <div class="table-responsive">
                                            <table class="table col-lg-12 col-md-12 col-xs-12">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">N°</th>
                                                        <th class="text-center">Paginas</th>
                                                        <th class="text-center">Dirección</th>
                                                        <th class="text-center">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($paginas as $p) { ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <?php echo $p['pag_cod']; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $p['pag_nombre']; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $p['pag_direc']; ?>
                                                        </td>
                                                      
                                                        <td class="text-center">
                                                            <!--BOTON BORRAR-->
                                                            <a onclick="borrar(<?php echo "'" . $p['pag_cod'] . "_" . $p['mod_cod'] . "_" . $p['pag_nombre'] . "'"; ?>)"
                                                                class="btn btn-toolbar" role="button"
                                                                data-title="Borrar" data-placement="top" rel="tooltip"
                                                                data-toggle="modal" data-target="#borrar">
                                                                <span style="color: red" class="glyphicon glyphicon-trash"></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <?php } else { ?>
                                        <div class="alert alert-warning flat">
                                            <span class="glyphicon glyphicon-info-sign"></span>
                                            No se han encontrado registros...
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--AGREGAR-->
        <div class="modal fade" id="registrar" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!--CABECERA MODAL-->
                    <div class="modal-header">
                        <button type="button" class="cerrar close" data-dismiss='modal' arial-label="Close">X</button>
                        <h4 class="modal-title"><strong>Registrar Paginas</strong></h4>
                    </div>
                    <!--CUERPO MODAL-->
                    <form action="pagina_control.php" method="POST" accept-charset="UFT-8" class="form-horizontal">
                        <input name="voperacion" value="1" type="hidden">
                        <input name="vpagina" value="0" type="hidden">
                        <div class="box-body">
                            <!--NOMBRE-->
                            <div class="form-group">
                                <label class="control-label col-lg-2 col-sm-2 col-xs-3">Nombre</label>
                                <div class="col-lg-8 col-sm-8 col-xs-9">
                                    <input type="text" class="form-control" name="vnombre" id="vnombre" required="" maxlength="30" onkeypress="return soloLetras(event);" onpaste="return soloLetras(event);">
                                </div>
                            </div>
                            <!--NOMBRE-->

                            <!--DIRECCION-->
                            <div class="form-group">
                                <label class="control-label col-lg-2 col-sm-2 col-xs-3">Dirección</label>
                                <div class="col-lg-8 col-sm-8 col-xs-9">
                                    <input type="text" class="form-control" name="vdireccion" id="vdireccion" required="" maxlength="120" onkeypress="return url(event);" onpaste="return url(event);">
                                </div>
                            </div>
                            <!--DIRECCION-->

                            <!--MODULO-->
                            <div class="form-group">
                                <label class="control-label col-lg-2 col-sm-2 col-xs-3">Módulo</label>
                                <div class="col-lg-8 col-sm-8 col-xs-9">
                                    <div class="input-group">
                                        <?php $modulo = consultas::get_datos("SELECT * FROM ref_modulos ORDER BY mod_cod"); ?>
                                        <select class="select2" name="vmodulo" required="" style="width: 100%">
                                            <?php
                                            if (!empty($modulo)) {
                                                foreach ($modulo as $m) {
                                            ?>
                                                    <option value="<?php echo $m['mod_cod']; ?>"><?php echo $m['mod_nombre']; ?></option>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="">Debe seleccionar al menos un módulo</option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--MODULO-->
                        </div>

                        <!--PIE MODAL-->
                        <div class="box-footer">
                            <button type="reset" data-dismiss="modal" class="fa fa-remove btn btn-danger"> Cerrar</button>
                            <button type="submit" class="fa fa-save btn btn-success pull-right"> Guardar</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--MODAL DE BORRAR-->
        <div class="modal fade" id="borrar" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!--CABECERA MODAL-->
                    <div class="modal-header">
                        <button type="button" class="cerrar close" data-dismiss='modal' arial-label="Close">X</button>
                        <h4 class="modal-title custom_align" id="Heading">Atención!!</h4>
                    </div>
                    <!--CUERPO MODAL-->
                    <div class="modal-body">
                        <div class="alert alert-danger" id="confirmacion"></div>
                    </div>
                    <!--PIE MODAL-->
                    <div class="modal-footer">
                        <a id="si" role="button" class="btn btn-primary">
                            <span class="glyphicon glyphicon-ok-sign"></span> Si
                        </a>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span> No
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--MODAL DE QUITAR-->
    </div>
    <?php require '../../estilos/pie.ctp'; ?>
</body>
<?php require '../../estilos/js_lte.ctp'; ?>
<script text="text/javascript">
    /*FUNCION MENSAJE ERROR O EXITO*/
    $('#mensaje').delay(1000).slideUp(200, function () {
        $(this).alert('close');
    });
    //PARA QUE EL FOCO SE VAYA AL MODAL
    $(".modal").on('shown.bs.modal', function () {
        $(this).find('input:text:visible:first').focus();
    });
    
    /*FUNCION BORRAR: SACA EL _*/
    function borrar(datos) {
        var dat = datos.split("_");
        $('#si').attr('href', 'pagina_control.php?vpagina=' + dat[0] + ' &vmodulo= ' + dat[1]+ ' &vnombre= ' + dat[2] + '&vdireccion=null &voperacion=2');
        $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea Borrar la pagina <i><strong>' + dat[0] + '</strong></i>?');
    }

    function soloLetras(e) {
        var key = e.keyCode || e.which,
            tecla = String.fromCharCode(key).toLowerCase(),
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz",
            especiales = [8, 37, 39, 46],
            tecla_especial = false;
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
    }

</script>

</html>