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
        <div class="content-wrapper" style="background-color:#1E282C;">
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
                                <h3 class="box-title">Cliente</h3>
                                <div class="box-tools">
                                    <a href="cliente_add.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <a href="cliente_print.php" class="btn btn-success btn-sm pull-right" target="_blank">
                                        <i class="fa fa-print"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <!--BUSCADOR-->
                                        <form action="cliente_index.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="input-group custom-search-form">
                                                            <input type="search" class="form-control" name="buscar" placeholder="Buscar por codigo del cliente o por nombre..." autofocus="" />
                                                            <span class="input-group-btn">
                                                                <button type="submit" class="btn btn-primary btn-flat" data-title="Buscar" data-placement="bottom" rel="tooltip">
                                                                    <span class="fa fa-search"></span>
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
                                        $cliente = consultas::get_datos("SELECT * FROM v_ref_cliente WHERE (id_cliente||TRIM(UPPER(nombres))) LIKE TRIM(UPPER('%" . $valor . "%')) AND estado = 'ACTIVO' ORDER BY id_cliente");
                                        if (!empty($cliente)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">N°</th>
                                                            <th class="text-center">C.I</th>
                                                            <th class="text-center">Nombre</th>
                                                            <th class="text-center">Ruc</th>
                                                            <th class="text-center">Telefono</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($cliente as $cli) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $cli['id_cliente']; ?></td>
                                                                <td class="text-center"> <?php echo $cli['cli_ci']; ?></td>
                                                                <td class="text-center"> <?php echo $cli['per_nombre']; ?></td>
                                                                <td class="text-center"> <?php echo $cli['per_ruc']; ?></td>
                                                                <td class="text-center"> <?php echo $cli['per_telefono']; ?></td>

                                                                <td class="text-center">
                                                                    <a href="cliente_edit.php?vidcliente=<?php echo $cli['id_cliente']; ?>" class="btn btn-warning btn-sm" role="button" data-title="Editar" rel="tooltip" data-placement="top">
                                                                        <span class="glyphicon glyphicon-edit"></span>
                                                                    </a>
                                                                    <a href="cliente_delete.php?vidcliente=<?php echo $cli['id_cliente']; ?>" class="btn btn-danger btn-sm" role="button" data-title="Anular" rel="tooltip" data-placement="top">
                                                                        <span class="glyphicon glyphicon-remove"></span>
                                                                    </a>
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