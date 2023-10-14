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
        <div class="wrapper" style="background-color:#1e282c;">
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
                                    <h3 class="box-title">Productos</h3>
                                    <div class="box-tools">
                                        <a href="productos_add.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-plus"></i>
                                        </a>
                                        <a href="productos_print.php" class="btn btn-toolbar  pull-right" target="_blank">
                                            <i style="color: #465F62" class="fa fa-print"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <!--BUSCADOR-->
                                            <form action="productos_index.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="input-group custom-search-form">
                                                                <input type="search" class="form-control" name="buscar" 
                                                                       placeholder="Buscar por nombre de producto o por marca..." autofocus=""/>
                                                                <span class="input-group-btn">
                                                                    <button type="submit" class="btn btn-toolbar btn-flat" data-title="Buscar" 
                                                                            data-placement="bottom" rel="tooltip">
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
                                            $productos = consultas::get_datos("SELECT * FROM v_ref_producto WHERE pro_cod > 0 AND (pro_cod||TRIM(UPPER(mar_descri))) LIKE TRIM(UPPER('%" . $valor . "%')) ORDER BY pro_cod");
                                            if (!empty($productos)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">N°</th>
                                                                <th class="text-center">Producto</th>
                                                                <th class="text-center">Marca</th>
                                                                <th class="text-center">Tipo</th>
                                                                <th class="text-center">U.Medida</th>
                                                                <th class="text-center">Impuesto</th>
                                                                <th class="text-center">P.Costo</th>
                                                                <th class="text-center">P.Venta</th>
                                                                <th class="text-center">Cod.Barra</th>
                                                                <th class="text-center">Imagen</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($productos AS $p) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $p['pro_cod']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['pro_descri']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['mar_descri']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['tipro_descri']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['unidadmedida']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['impuesto']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['precio_costo']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['precio_venta']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['codigo_barra']; ?></td>
                                                                    <td class="text-center">
                                                                        <img height="45px" src="/T.A/img/productos/<?php echo $p['pro_imagen']; ?>"/>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <a href="productos_edit.php?vidproducto=<?php echo $p['pro_cod']; ?>" 
                                                                           class="btn btn-toolbar" role="button"
                                                                           data-title="Editar" rel="tooltip" data-placement="top">
                                                                            <span style="color: #FFB400" class="glyphicon glyphicon-edit"></span>
                                                                        </a>
                                                                        <a href="productos_delete.php?vidproducto=<?php echo $p['pro_cod']; ?>" 
                                                                           class="btn btn-toolbar" role="button"
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
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });
    </SCRIPT>
</HTML>
