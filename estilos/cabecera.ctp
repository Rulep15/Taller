<header class="main-header">   
    <a href="#" class="logo">
        <span class="logo-mini"><b>T.A</b></span>
        <span class="logo-lg">T.A</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Menu emergente derecho --> 
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php
                        if (!empty($_SESSION['usu_foto'])) {
                            echo "/T.A/img/personas/" . $_SESSION['usu_foto'];
                        } else {
                            echo "/T.A/img/sistema/nodisponible.jpg";
                        }
                        ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $_SESSION['usu_nick']; ?></span>
                    </a>                    
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="<?php
                            if (!empty($_SESSION['usu_foto'])) {
                                echo "/T.A/img/personas/" . $_SESSION['usu_foto'];
                            } else {
                                echo "/T.A/img/no_disponible.jpg";
                            }
                            ?>" 
                                 class="img-circle" alt="User Image">
                            <p>
                                <small> <b> CARGO: </b> 
                                    <?php
                                    if (!empty($_SESSION['gru_cod'])) {
                                        echo $_SESSION['gru_nombre'];
                                    } else {
                                        echo "ERROR 69, CONTACTE AL 911";
                                    }
                                    ?>
                                </small>

                                <small><b>SUCURSAL: </b>
                                    <?php
                                    if (!empty($_SESSION['suc_descri'])) {
                                        echo $_SESSION['suc_descri'];
                                    } else {
                                        echo "ERROR 69, CONTACTE AL 911";
                                    }
                                    ?>
                                </small>
                            </p>
                        </li>
                        <!-- acciones dentro del menu emergente-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="/T.A/ayuda/manual_T.A.pdf " class="btn btn-default" style="color:blue;"> Ayuda </a>
                            </div>
                            <div class="pull-right">
                                <a href="/T.A" class="btn btn-default" style="color: red;"> Salir </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>