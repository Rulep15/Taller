<aside class="main-sidebar" style="background-color:#1e282c;">
    <section class="sidebar" >
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php
                if (!empty($_SESSION['usu_foto'])) {
                    echo "/T.A/img/personas/". $_SESSION['usu_foto'];
                } else {
                    echo "/T.A/img/sistema/nodisponible.jpg";
                }
                ?>" class="img-circle" alt="Imagen de Usuario">
            </div>
          <div class="pull-left info" style="font-size: 12px; padding-top: 5px;"><p><?php echo $_SESSION['nombres']; ?></p>
                <a  href="#">
                    <i class="fa fa-circle text-success"></i>
                    <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">En linea</font>
                    </font>
                </a>                   
            </div>
    <li> <a></a></li>
        </div>
        <ul class="sidebar-menu">
            <li><a href="/T.A/menu.php" class="fa fa-home"><span class="logo-lg"><strong> INICIO</strong></span> </a></li>
            <?php $modulos = consultas::get_datos("select distinct(mod_cod),(mod_nombre) from v_permisos where gru_cod =" . $_SESSION['gru_cod'] . " order by mod_cod"); ?>  
            <?php if (!empty($modulos)) { ?>
                <?php foreach ($modulos as $modulo) { ?>
                    <li class="treeview">
                        <a href=""> 
                            <i class="fa fa-folder"></i> 
                            <span ><?php echo $modulo['mod_nombre'] ?></span> 
                            <i class="fa fa-angle-double-right pull-right"></i> 
                        </a>
                        <?php $paginas = consultas::get_datos("select pag_direc,pag_nombre,leer,insertar,editar,borrar from v_permisos  where mod_cod=" . $modulo['mod_cod'] . " and gru_cod =" . $_SESSION['gru_cod'] . " order by pag_cod"); ?>   
                        <ul class="treeview-menu" >                             
                            <?php foreach ($paginas as $pagina) { ?>
                                <li>
                                    <a class="fa fa-cube"
                                       href="<?php echo $pagina['pag_direc']; ?>"><?php echo " " . $pagina['pag_nombre']; ?>
                                    </a>
                                         
                                </li>
                                <?php $_SESSION[$pagina['pag_nombre']] = $pagina; ?>
                            <?php } ?>  
                        </ul>
                    </li>
                <?php } ?>
            <?php } else { ?>
                    <b style="color: red; margin-left: 300px"> NO TIENE PERMISOS...</b>
            <?php } ?>
        </ul>
    </section>
</aside>