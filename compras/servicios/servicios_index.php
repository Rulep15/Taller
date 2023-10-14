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
    <div id="wrapper" style="background-color:  #1E282C;">
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
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Presupuesto</h3>
                                <div class="box-tools">
                                    <a href="servicios_add.php" class="btn btn-toolbar pull-right">
                                        <i style="color: #465F62" class="fa fa-plus"></i>
                                    </a>

                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <!--BUSCADOR-->
                                        <form action="servicios_index.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="input-group custom-search-form">
                                                            <input type="search" class="form-control" name="buscar" placeholder="Buscar por descripcion..." autofocus="" />
                                                            <span class="input-group-btn">
                                                                <button type="submit" class="btn btn-toolbar btn-flat" data-title="Buscar" data-placement="bottom" rel="tooltip">
                                                                    <span style="color: #465F62" class="fa fa-search"></span>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!--BUSCADOR-->
                                        <?php
                                        $valor = '';
                                        if (isset($_REQUEST['buscar'])) {
                                            $valor = $_REQUEST['buscar'];
                                        }
                                        $pedidos = consultas::get_datos("SELECT * FROM v_servicios WHERE (id_servicio||TRIM(UPPER(descripcion))) LIKE TRIM(UPPER('%" . $valor . "%')) ORDER BY id_servicio");
                                        if (!empty($pedidos)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">N°</th>
                                                            <th class="text-center">Fecha</th>
                                                            <th class="text-center">Descripción</th>
                                                            <th class="text-center">Estado</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($pedidos as $pc) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $pc['id_servicio']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['fecha_servicio1']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['descripcion']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['estado']; ?></td>

                                                                <td class="text-center">
                                                                    <?php if ($pc['estado'] == 'ACTIVO') { ?>
                                                                        <a href="servicios_edit.php?vidservicio=<?php echo $pc['id_servicio']; ?>" class="btn btn-toolbar" role="button" data-title="Editar" rel="tooltip" data-placement="top">
                                                                            <span style="color: #FFB400" class="glyphicon glyphicon-edit"></span>
                                                                        </a>
                                                                    <?php } ?>

                                                                    <a href="servicios_detalle.php?vidservicio=<?php echo $pc['id_servicio']; ?>" class="btn btn-toolbar" role="button" data-title="Detalle" rel="tooltip" data-placement="top">
                                                                        <i style="color: #465F62" class="fa  fa-list"></i>

                                                                    </a>
                                                                    <?php if ($pc['estado'] == 'CONFIRMADO') { ?>
                                                                        <a href="servicios_print.php?vidservicio=<?php echo $pc['id_servicio']; ?>" class="btn btn-toolbar" role="button" data-title="Imprimir" rel="tooltip" data-placement="top">
                                                                            <span style="color: green" class="glyphicon glyphicon-print"></span>
                                                                        </a>
                                                                    <?php } ?>







                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } else { ?>
                                            <div class="alert alert-danger flat">
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

    </div>
    <?php require '../../estilos/pie.ctp'; ?>
</BODY>
<?php require '../../estilos/js_lte.ctp'; ?>
<SCRIPT>
    $("#mensaje").delay(1000).slideUp(200, function() {
        $(this).alert('close');
    });
</SCRIPT>

</HTML>