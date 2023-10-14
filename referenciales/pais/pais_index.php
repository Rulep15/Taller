<?php session_start() ?>

<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=devicewidth, initial-scale=1, maximum-scalable=no"name="viewport">
    </head>
    <?php
    include '../../conexion.php';
    require '../../estilos/css_lte.ctp';
    ?>
    <body class="hold-transition skin-purple sidebar-mini">
        <div id= wrapper style="background-color: #1E282C">
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
                                    <h3 class="box-title">Pais</h3>
                                    <div class="box-tools">
                                        <a href="pais_add.php" class="btn btn-toolbar  pull-right ">
                                            <i style="color: #465F62" class="fa fa-plus"></i>
                                        </a>
                                        <a href="pais_print.php" class="btn btn-toolbar  pull-right">
                                            <i style="color: #465F62" class="fa fa-print"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $pais = consultas::get_datos("SELECT * FROM ref_pais ORDER BY id_pais");
                                            if (!empty($pais)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th>Pais</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($pais AS $p) { ?>
                                                                <tr>
                                                                    <td data-title="Nombre"><?php echo $p['pai_descri'] ?></td>
                                                                    <td data-tile="Acciones" class="text-center">
                                                                        <a href="pais_edit.php?vid_pais=<?php echo $p['id_pais'] ?>" class="btn btn-toolbar " role="button" 
                                                                           data-title="Editar" rel="tooltip" data-placement="top">
                                                                            <span style="color: #FFB400" class="glyphicon glyphicon-edit"></span>
                                                                        </a>
                                                                        <a href="pais_delete.php?vid_pais=<?php echo $p['id_pais'] ?>" class="btn btn-toolbar " role="button" 
                                                                           data-title="Borrar" rel="tooltip" data-placement="top">
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
                                                    No se han encontrado registros..
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
        </div>
        <?php require '../../estilos/pie.ctp'; ?>
    </body>
    <?php require '../../estilos/js_lte.ctp'; ?>
    <SCRIPT>
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });
    </SCRIPT>
</html>




