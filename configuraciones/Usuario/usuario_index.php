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
                            <div class="header box-header">
                                <i class="fa fa-user"></i>
                                <h3 class="box-title">Usuarios</h3>
                               <div class="box-tools">
                                        <a href="usuario_add.php" class="btn btn-toolbar pull-right ">
                                            <i style="color: #465F62" class="fa fa-plus"></i>
                                              <a href="usuario_print.php" class="btn btn-toolbar  pull-right">
                                            <i style="color: #465F62"  class="fa fa-print"></i>
                                        </a>
                                        </a>
                                    </div>
                            </div>
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <!--BUSCADOR-->
                                        <form action="usuario_index.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="input-group custom-search-form">
                                                            <input type="search" class="form-control" name="buscar" placeholder="Buscar por nombre de persona..." autofocus="" />
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
                                        $usuario = consultas::get_datos("SELECT * FROM v_ref_usuario WHERE usu_estado = 'ACTIVO' AND (TRIM(UPPER(persona))) LIKE TRIM(UPPER('%" . $valor . "%')) ORDER BY usu_cod");
                                        if (!empty($usuario)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">N°</th>
                                                            <th class="text-center">Usuario</th>
                                                            <th class="text-center">Sucursal</th>
                                                            <th class="text-center">Empleado</th>
                                                            <th class="text-center">Grupo</th>
                                                            <th class="text-center">Imagen</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($usuario as $u) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $u['usu_cod']; ?></td>
                                                                <td class="text-center"> <?php echo $u['usu_nick']; ?></td>
                                                                <td class="text-center"> <?php echo $u['suc_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $u['persona']; ?></td>
                                                                <td class="text-center"> <?php echo $u['gru_nombre']; ?></td>
                                                                <td class="text-center">
                                                                    <img height="50px" id="vimagen" src="/T.A/img/sistema/<?php echo $u['usu_foto']; ?>" />
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="/T.A/configuraciones/permisos/permisos_index.php?vgrup=<?php echo $u['gru_cod'] . '&vgrunombre=' . $u['gru_nombre']; ?>" class="btn btn-toolbar" rel="tooltip" title="Permisos">
                                                                        <span style="color: #465F62" class="fa fa-cog"></span>
                                                                    </a>

                                                                    <a href="usuario_delete.php?vusucod=<?php echo $u['usu_cod']; ?>" class="btn btn-toolbar" role="button" data-title="Anular" rel="tooltip" data-placement="top" data-target="#borrar">
                                                                        <span style="color: red" class="glyphicon glyphicon-ban-circle"></span>
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