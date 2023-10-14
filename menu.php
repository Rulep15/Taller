<?php session_start() ?>

<!DOCTYPE>
<html>
    <style>

        body {
            background:#d2d9e4;
            font-family:sans-serif;
        }
        .contentreloj {
            top:0;
            left:0;
            display:flex;
            justify-content:right;
            align-items:right;
        }
        .reloj {
            display:inline-block;
            background:#d1dae3;
            color:#71767f;
            padding:9xp;
            font-weight:bold;
            font-size:30px;
            border-radius:4px;
            border: 4px solid #cad3dc;
            box-shadow: -8px -8px 15px rgba(255,255,255,0.5),
                10px 10px 10px rgba(0,0,0,0.1),
                inset -8px -8px 15px rgba(255,255,255,0.5),
                inset 10px 10px 10px rgba(0,0,0,0.1);
        }
    </style>

    <head>

        <meta charset="utf-8">
        <meta content="width=devicewidth, initial-scale=1, maxium-scalable=no" name="viewport">
    </head>

    <?php
    include './conexion.php';
    require './estilos/css_lte.ctp';
    ?>

    <body class="hold-transition skin-purple sidebar-mini">
        <div style="background-color: #1E282C;">
            <?php require './estilos/cabecera.ctp'; ?>
            <?php require './estilos/izquierda.ctp'; ?>
            <div>
                <div class="content-wrapper" style="background-repeat: no-repeat; background-position: right top;background-image: url('/T.A/img/sistema/fondo_taller2.jpg');background-size: 100%;background-size: cover">

                    <section class="content-header">
                        <section class="content">
                            <div class="contentreloj">
                                <div class="reloj">
                                    <span id="tiempo">00 : 00 : 00</span>
                                </div>
                            </div>
                            <h3 style="color: whitesmoke; font-size: 30px; font-family: Impact; font-style: italic;">
                                Bienvenido al Sistema <?php echo '- ', $_SESSION['nombres']; ?>
                            </h3>
                            <br><br>
                            <br>
                        </section>
                    </section>
                </div>
            </div>
    </body>
    <?php require './estilos/pie.ctp'; ?>
    <?php require './estilos/js_lte.ctp'; ?>
    <script>
        let html = document.getElementById("tiempo");

        setInterval(function () {
            tiempo = new Date();

            horas = tiempo.getHours();
            minutos = tiempo.getMinutes();
            segundos = tiempo.getSeconds();

            //evitar los 0 o numeros individuales
            if (horas < 10)
                horas = "0" + horas;
            if (minutos < 10)
                minutos = "0" + minutos;
            if (segundos < 10)
                segundos = "0" + segundos;

            html.innerHTML = horas + " : " + minutos + " : " + segundos;
        }, 1000);
    </script>
    <script>
        var embedimSnow = document.getElementById("embedim--snow");
        if (!embedimSnow) {
            function embRand(a, b) {
                return Math.floor(Math.random() * (b - a + 1)) + a
            }
            var embCSS = '.embedim-snow{position: absolute;width: 3px;height: 3px;background: white;border-radius: 50%;margin-top:-10px}';
            var embHTML = '';
            for (i = 1; i < 200; i++) {
                embHTML += '<i class="embedim-snow"></i>';
                var rndX = (embRand(0, 1000000) * 0.0001), rndO = embRand(-100000, 100000) * 0.0001, rndT = (embRand(3, 8) * 10).toFixed(2), rndS = (embRand(0, 10000) * 0.0001).toFixed(2);
                embCSS += '.embedim-snow:nth-child(' + i + '){' + 'opacity:' + (embRand(1, 10000) * 0.0001).toFixed(2) + ';' + 'transform:translate(' + rndX.toFixed(2) + 'vw,-10px) scale(' + rndS + ');' + 'animation:fall-' + i + ' ' + embRand(10, 30) + 's -' + embRand(0, 30) + 's linear infinite' + '}' + '@keyframes fall-' + i + '{' + rndT + '%{' + 'transform:translate(' + (rndX + rndO).toFixed(2) + 'vw,' + rndT + 'vh) scale(' + rndS + ')' + '}' + 'to{' + 'transform:translate(' + (rndX + (rndO / 2)).toFixed(2) + 'vw, 105vh) scale(' + rndS + ')' + '}' + '}'
            }
            embedimSnow = document.createElement('div');
            embedimSnow.id = 'embedim--snow';
            embedimSnow.innerHTML = '<style>#embedim--snow{position:fixed;left:0;top:0;bottom:0;width:100vw;height:100vh;overflow:hidden;z-index:9999999;pointer-events:none}' + embCSS + '</style>' + embHTML;
            document.body.appendChild(embedimSnow)
        }
    </script>

</html>