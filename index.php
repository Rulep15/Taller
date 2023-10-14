<?php
session_start();
if ($_SESSION) {
    session_destroy();
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=devicewidth, initial-scale=1, maximum-scalable=no" name="viewport">
    <title>Acceso la Sistema</title>
    <?php require 'estilos/css_lte.ctp'; ?>
    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #1E282C;

        }

        #sha {
            max-width: 340px;
            -webkit-box-shadow: 0px 0px 10px 0px rgb(48, 50, 50, 0.48);
            -mos-box-shadow: 0px 0px 10px 0px rgb(48, 50, 50, 0.48);
            box-shadow: 0px 0px 10px 0px rgb(48, 50, 50, 0.48);
            border-radius: 6%;
            border-color: #FFDE59;
            background-color: #243037;
        }

        #avatar {
            width: 160px;
            height: 160px;
            margin: 0px auto 10px;
            display: block;
            border-radius: 90px;
            border-color: #1E282C;
            background-color: #1E282C;
        }

        .login {
            max-width: 330px;
            padding: 15px;
            margin: 0px auto;
            background-color: #243037;
        }
    </style>
</head>

<body>
    <div class="container well" id="sha">
        <div class="row">
            <div class="col-xs-12">
                <img class="img-responsive" src="/T.A/img/sistema/T.A.gif" id="avatar">
            </div>
        </div>
        <form class="login" action="acceso.php" method="POST">
            <div class="form-group has-feedback">
                <input type="text" name="usuario" class="form-control" placeholder="Ingrese nombre de usuario" required="" autofocus="">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="pass" class="form-control" placeholder="Ingrese contraseña" required="">
                <span class="glyphicon glyphicon-qrcode form-control-feedback"></span>
            </div>
            <button class="btn btn-lg btn-info btn-block" type="submit" style="color: #181818; background-color: #FFDE59; padding: 5px 5px;">Iniciar Sesion</button>
            <div class="checkbox" style="padding: 0px 20px;">
                <p style="color: #A5A5A5; text-align: center;" class="help-block"><a href="#">¿No puede Ingresar a su cuenta?</a></p>
            </div>
            <?php if (!empty($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    <?php echo $_SESSION['error']; ?>
                </div>
            <?php } ?>
        </form>
    </div>
</body>
<?php require 'estilos/js_lte.ctp'; ?>

</html>