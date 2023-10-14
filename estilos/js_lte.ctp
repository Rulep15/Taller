
<script src="/T.A/librerias/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="/T.A/librerias/plugins/select2/select2.full.min.js"></script>
<script src="/T.A/librerias/plugins/fastclick/fastclick.min.js"></script>
<script src="/T.A/librerias/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="/T.A/librerias/plugins/iCheck/icheck.min.js"></script>
<script src="/T.A/librerias/plugins/pnotify/pnotify.custom.min.js"></script>
<script src="/T.A/librerias/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/T.A/librerias/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/T.A/librerias/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="/T.A/librerias/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="/T.A/librerias/bower_components/raphael/raphael.min.js"></script>
<script src="/T.A/librerias/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="/T.A/librerias/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="/T.A/librerias/bower_components/moment/min/moment.min.js"></script>
<script src="/T.A/librerias/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="/T.A/librerias/bower_components/fastclick/lib/fastclick.js"></script>
<script src="/T.A/librerias/dist/js/adminlte.min.js"></script>
<script src="/T.A/librerias/dist/js/demo.js"></script>
<script src="/T.A/librerias/js/adminlte/js/app.min.js"></script>
<script src="/T.A/librerias/js/bootstrap.min.js"></script>

<script>
//Initialize Select2 Elements
    $(".select2").select2();
</script>

<script>
    /*  $(function() {
     $('input').iCheck({
     checkboxClass: 'icheckbox_square-blue',
     radioClass: 'iradio_square-blue',
     increaseArea: '20%' // optional
     });
     });*/
</script>

<script>
    $(function () {
        $("[rel='tooltip']").tooltip();
    });
</script>

<script>
    $(function () {
        $("[data-toggle='popover']").popover();
    });
</script>

<script type='text/javascript'>
    // Botón para ir al tope de la pagina
    $(document).ready(function () {
        $("#IrArriba").hide();
        $(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 80) {
                    $('#IrArriba').fadeIn();
                } else {
                    $('#IrArriba').fadeOut();
                }
            });
        });
        $('#arriba').click(function () {
            $('html,body').animate({scrollTop: '0px'}, 500);
            return false;
        });
    });
</script>

<script>
    function format(input)
    {
        var num = input.value.replace(/\./g, '');
        if (!isNaN(num)) {
            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
            num = num.split('').reverse().join('').replace(/^[\.]/, '');
            input.value = num;
        } else {
            alert('Sólo se permiten numeros');
            input.value = input.value.replace(/[^\d\.]*/g, '');
        }
    }
</script>

<script>
    $(document).ready(function () {
        $('[id^=detail-]').hide();
        $('.toggle').click(function () {
            $input = $(this);
            $target = $('#' + $inpuT.Attr('data-toggle'));
            $target.slideToggle();
        });
    });
</script>

<script>
    function currency(value, decimals, separators) {
        decimals = decimals >= 0 ? parseInt(decimals, 0) : 2;
        separators = separators || ['.', "'", ','];
        var number = (parseFloat(value) || 0).toFixed(decimals);
        if (number.length <= (4 + decimals))
            return number.replace('.', separators[separators.length - 1]);
        var parts = number.split(/[-.]/);
        value = parts[parts.length > 1 ? parts.length - 2 : 0];
        var result = value.substr(value.length - 3, 3) + (parts.length > 1 ?
                separators[separators.length - 1] + parts[parts.length - 1] : '');
        var start = value.length - 6;
        var idx = 0;
        while (start > -3) {
            result = (start > 0 ? value.substr(start, 3) : value.substr(0, 3 + start))
                    + separators[idx] + result;
            idx = (++idx) % 2;
            start -= 3;
        }
        return (parts.length === 3 ? '-' : '') + result;
    }
</script>

<!--para el buscador y filtrar-->
<script type="text/javascript">
    $(document).ready(function () {
        (function ($) {
            $('#filtrar').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('.buscar tr').hide();
                $('.buscar tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })

        }(jQuery));
    });
</script>

<script>
    function notificacion(titulo, msg, tipo, time) {
        var option = new Object();
        option.title = titulo;
        option.text = msg;
        option.type = tipo;
        option.delay = time ? time : 2500;
        new PNotify(option);
    }
</script>








