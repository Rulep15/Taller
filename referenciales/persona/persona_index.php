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
            <div class="content-wrapper"  style="background-color: #1E282C;">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <?php if (!empty($_SESSION['mensaje'])) { ?>
                                <?php
                                $mensaje = explode("_/_", $_SESSION['mensaje']);
                                if (($mensaje[0] == 'NOTICIA')) {
                                    $plass = "success";
                                } else {
                                    $plass = "danger";
                                }
                                ?>
                                <div class="alert alert-<?= $plass; ?>" role="alert" id="mensaje">
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
                                    <h3 class="box-title">Persona</h3>
                                    <div class="box-tools">
                                        <!--AGREGAR-->
                                        <a href="persona_add.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-plus"></i>
                                        </a>
                                        <!--IMPRIMIR-->
                                        <a href="persona_print.php" target="_blank" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-print"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <!--BUSCADOR-->
                                            <form action="persona_index.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="input-group custom-search-form">
                                                                <input type="search" class="form-control" name="buscar" 
                                                                       placeholder="Buscar por nombre de Persona..." autofocus=""/>
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
                                            $persona = consultas::get_datos("SELECT * FROM v_ref_persona WHERE (per_nro_doc||TRIM(UPPER(per_nombre))) LIKE TRIM(UPPER('%" . $valor . "%')) ORDER BY id_persona");
                                            if (!empty($persona)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">N°</th>
                                                                <th class="text-center">Nombre</th>
                                                                <th class="text-center">Apellido</th>
                                                                <th class="text-center">C.I</th>
                                                                <th class="text-center">R.U.C</th>
                                                                <th class="text-center">Direccion</th>
                                                                <th class="text-center">Telefono</th>
                                                                <th class="text-center">Email</th>
                                                                <th class="text-center">Sexo</th>
                                                                <th class="text-center">Fecha de Nac</th>
                                                                <th class="text-center">Razon Social</th>
                                                                <th class="text-center">Ciudad</th>
                                                                <th class="text-center">Tipo de Persona</th>
                                                                <th class="text-center">Imagen</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($persona AS $p) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $p['id_persona']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['per_nombre']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['per_apellido']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['per_nro_doc']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['per_ruc']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['per_direccion']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['per_telefono']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['per_email']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['per_sexo']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['per_fecha_nacimiento']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['razon_social']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['ciu_descri']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['tp_descri']; ?></td>
                                                                    <TD class="tex-center"><img height="45px" src="/T.A/img/personas/<?php echo $p['per_imagen']; ?>"/></TD>                                                                    <td class="text-center">
                                                                    
                                                                        <a href="persona_edit.php?vidpersona=<?php echo $p['id_persona']; ?>" 
                                                                           class="btn btn-toolbar " role="button"
                                                                           data-title="Editar" rel="tooltip" data-placement="top">
                                                                            <span style="color: #FFB400" class="glyphicon glyphicon-edit"></span>
                                                                        </a>
                                                                        <a href="persona_delete.php?vidpersona=<?php echo $p['id_persona']; ?>" 
                                                                           class="btn btn-toolbar " role="button"
                                                                           data-title="Borrar" rel="tooltip" data-placement="top" data-target="#borrar">
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
