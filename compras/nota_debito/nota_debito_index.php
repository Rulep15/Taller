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
            <div class="content-wrapper"  style="background-color: #1E282C">
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
                                    <h3 class="box-title">Nota de Debito</h3>
                                    <div class="box-tools">
                                        <a href="nota_debito_add.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding" >
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <!--BUSCADOR-->
                                            <form action="nota_debito_index.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="input-group custom-search-form">
                                                                <input type="search" class="form-control" name="buscar" 
                                                                       placeholder="Buscar por Proveedor..." autofocus=""/>
                                                                <span class="input-group-btn">
                                                                    <button type="submit" class="btn btn-toolbar btn-flat" data-title="Buscar por Proveedor" 
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
                                            $notadebito = consultas::get_datos("SELECT * FROM v_nota_debito WHERE (id_debito||TRIM(UPPER(prv_razon_social))) LIKE TRIM(UPPER('%" . $valor . "%')) ORDER BY id_debito");
                                            if (!empty($notadebito)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">N°</th>
                                                                <th class="text-center">N° Compra</th>
                                                                <th class="text-center">Proveedor</th>
                                                                <th class="text-center">Nro Fact</th>
                                                                <th class="text-center">Fecha</th>
                                                                <th class="text-center">Total</th>
                                                                <th class="text-center">IvaTotal</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($notadebito AS $n) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $n['id_debito']; ?></td>
                                                                    <td class="text-center"> <?php echo $n['id_compra']; ?></td>
                                                                    <td class="text-center"> <?php echo $n['prv_razon_social']; ?></td>
                                                                    <td class="text-center"> <?php echo $n['nro_fact']; ?></td>
                                                                    <td class="text-center"> <?php echo $n['fecha_sistema1']; ?></td>
                                                                    <td class="text-center"> <?php echo $n['monto']; ?></td>
                                                                    <td class="text-center"> <?php echo $n['total_iva']; ?></td>
                                                                    <td class="text-center">
                                                                        <?php if ($n['estado'] == 'ACTIVO' || $n['estado'] == 'ANULADO' || $n['estado'] == 'CONFIRMADO') { ?>
                                                                            <a href="nota_debito_detalle.php?vidnota=<?php echo $n['id_debito']; ?>" class="btn btn-toolbar" role="button" data-title="Detalle" rel="tooltip" data-placement="top">
                                                                                <i style="color: #465F62" class="fa  fa-list"></i>

                                                                            </a>
                                                                        <?php } ?>

                                                                        <?php if ($n['estado'] == 'CONFIRMADO') { ?>
                                                                            <a href="nota_debito_anular.php?vidnota=<?php echo $n['id_debito']; ?>" class="btn btn-toolbar" role="button" data-title="Anular" rel="tooltip" data-placement="top">
                                                                                <span style="color: red" class="glyphicon glyphicon-ban-circle"></span>
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
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });

    </SCRIPT>
</HTML>
