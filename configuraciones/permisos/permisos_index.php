<?php
session_start();
$gc = $_REQUEST['vgrup'];
$gnombre = $_REQUEST['vgrunombre'];
?> <!-- Para que muestre la sesion guardada -->
<!DOCTYPE>

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
        <div class="wrapper" style="background-color: #1E282C;">
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
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Permisos</h3>
                                    <div class="box-tools">
                                        <a style="padding: 8px; margin: 1px" data-toggle="modal" data-target="#registrar"  
                                           onclick="registrar_permisos(<?php echo "'" . $_REQUEST['vgrup'] . "_" . $_REQUEST['vgrunombre'] . "'" ?>);"
                                           class="btn btn-toolbar pull-right" rel="tooltip" title="Añadir">
                                            <i style="color: #465F62" class="fa fa-plus"></i>
                                        </a>
                                        <a href="/T.A/configuraciones/Usuario/usuario_index.php" class="btn btn-toolbar pull-right" rel="tooltip" title="Atras" style="padding: 8px; margin: 1px">
                                            <i style="color: #465F62" class="fa fa-arrow-circle-left"></i>
                                        </a>
                                        <!--BUSCADOR-->
                                        <form action="permisos_index.php" method="POST" accept-charset="UTF-8" class="form-inline" >
                                            <div  style="float: right; width: 52%;display: block;">
                                                <div class="form-group-sm" >
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="input-group custom-search-form ">
                                                                <input type="text" class="form-control" name="buscar" placeholder="Cod/user..." style="margin:auto">
                                                                <span  class="glyphicon glyphicon-search form-control-feedback" ></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!--  BUSCADOR--> 
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Grupo:  <i><strong><?php echo $_REQUEST['vgrunombre']; ?></strong></i></div>
                                            <?php $paginas = consultas::get_datos("select * from v_permisos where gru_cod=" . $_REQUEST['vgrup']); ?>
                                            <?php if (!empty($paginas)) { ?>                     
                                                <div class="panel-body">
                                                    <?php foreach ($paginas as $pagina) { ?>                        
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="list-group-item-heading" 
                                                                     style="width: 87%;">
                                                                    <div class="col-lg-2"> <i><strong><?php echo $pagina['pag_nombre']; ?></strong></i></div>
                                                                    <div class="col-lg-2">
                                                                        <small>
                                                                            <i><strong>Consultar:</strong> 
                                                                                <?php
                                                                                if ($pagina['leer'] == 't') {
                                                                                    echo ("SI");
                                                                                } else {
                                                                                    echo ("NO");
                                                                                }
                                                                                ?></i>
                                                                        </small>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <small>
                                                                            <i><strong>Insertar:</strong> 
                                                                                <?php
                                                                                if ($pagina['insertar'] == 't') {
                                                                                    echo ("SI");
                                                                                } else {
                                                                                    echo ("NO");
                                                                                }
                                                                                ?></i>
                                                                        </small>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <small>
                                                                            <i><strong>Actualizar:</strong> <?php
                                                                                if ($pagina['editar'] == 't') {
                                                                                    echo ("SI");
                                                                                } else {
                                                                                    echo ("NO");
                                                                                }
                                                                                ?></i>
                                                                        </small>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <small>
                                                                            <i><strong>Borrar:</strong> <?php
                                                                                if ($pagina['borrar'] == 't') {
                                                                                    echo ("SI");
                                                                                } else {
                                                                                    echo ("NO");
                                                                                }
                                                                                ?></i>
                                                                        </small>
                                                                    </div>                                      
                                                                </div>

                                                                <div class="media-right media-middle" 
                                                                     style="padding-left: 58px;">
                                                                    <div class="pull-right action-buttons">

                                                                        <a onclick="borrar(<?php
                                                                        echo "'" . $pagina['gru_cod'] . "_" . $pagina['pag_cod'] . "_" .
                                                                        $pagina['gru_nombre'] . "_" . $pagina['pag_nombre'] . "'";
                                                                        ?>)"
                                                                           class="btn btn-xs btn-toolbar" role="button" data-title="Borrar"
                                                                           data-placement="top" rel="tooltip" data-toggle="modal" data-target="#borrar">
                                                                            <span style="color: red" class="glyphicon  glyphicon-trash"></span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>                                    
                                                        </div>
                                                    <?php } ?> 
                                                <?php } else { ?>
                                                    <div class="alert alert-danger">
                                                        <span class="glyphicon glyphicon-info-sign"></span>
                                                        No se han autorizado interfaces...
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
                <!-- registrar-->
                <div id="registrar" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content" id="detalles_registrar">

                        </div>
                    </div>
                </div>
                <!-- registrar-->
                <!--editar permisos--->
                <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" id="detalles_edit">

                        </div>
                    </div>
                </div>
                <!--editar permisos--->
                <!-- MODAL DE BORRAR -->
                <div class="modal fade" id="borrar" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" arial-label="Close">X</button>
                                <h4 class="modal-title custom_align" id="Heading">Atencion!!</h4>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-danger" id="confirmacion"></div>
                            </div>
                            <div class="modal-footer">
                                <a id="si" role="button" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok-sign"></span>Si
                                </a>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    <span class="glyphicon glyphicon-remove"></span>No
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN DE MODAL BORRAR -->
            </div>
        </div>
        <?php require '../../estilos/pie.ctp'; ?>
    </body>
    <?php require '../../estilos/js_lte.ctp'; ?>
    <script>
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });

        function registrar_permisos(datos) {
            var dat = datos.split("_");
            $.ajax({
                type: "GET",
                url: "/T.A/configuraciones/permisos/permisos_add.php?vgrup=" + dat[0] + "&vgrunombre=" + dat[1],
                beforeSend: function () {
                    $('#detalles_registrar').html();
                },
                success: function (msg) {
                    $('#detalles_registrar').html(msg);
                }
            });
        }

        function borrar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href', 'permisos_control.php?vgru=' + dat[0] + ' &vpag= ' + dat[1] + ' &vgrumbre=' + dat[2]
                    + '&consul=null&agre=null&editar=null&borrar=null' + '&accion=2&pagina=permisos_index.php');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> \n\ Desea Borrar el Permiso Parar <i><strong>' + dat[1] + '</strong></i>?');
        }

    </script>
</html>


