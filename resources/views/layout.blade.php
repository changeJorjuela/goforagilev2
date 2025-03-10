<!DOCTYPE html>
<html>

<head>
    <html lang="{{ app()->getLocale() }}">
    <title>GOFORAGILE - @yield('titulo')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="width">
    <link type="image/x-icon" rel="icon" href="{{asset("img/ISOTIPO_COLOR.png")}}">
    <link rel="stylesheet" href="{{asset("css/font-awesome/css/all.min.css")}}">

    <link rel="stylesheet" href="{{asset("template/css/bootstrap.min.css")}}" />
    <link rel="stylesheet" href="{{asset("template/fonts/icomoon/icomoon.css")}}" />
    <link rel="stylesheet" href="{{asset("template/css/main.min.css")}}" />
    <link rel="stylesheet" href="{{asset("css/okrs.css")}}" />

    <link href="{{asset("template/vendor/chartist/css/chartist.min.css")}}" rel="stylesheet" />
    <link href="{{asset("template/vendor/chartist/css/chartist-custom.css")}}" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset("DataTables/dataTables.bootstrap5.css")}}">
    <link rel="stylesheet" href="{{asset("DataTables/responsive.bootstrap5.css")}}">
    <link rel="stylesheet" href="{{asset("DataTables/buttons.bootstrap5.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="{{asset("css/select2.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/select2-bootstrap-5-theme.min.css")}}">
    @stack('styles')
</head>

<body>
    <div id="loading-wrapper">
        <div id="loader">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
            <div class="line4"></div>
            <div class="line5"></div>
            <div class="line6"></div>
        </div>
    </div>
    <div class="app-wrap">
        @include("header")
        <div class="app-container">
            @include("aside")
            <div class="app-main">
                @yield('headerPage')
                <div class="main-content">
                    @yield('contenido')
                    @include("modals.modalAlerta")                    
                </div>
            </div>

        </div>
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>

    <script src="{{asset("js/jquery.js")}}"></script>
    <script src="{{asset("js/jquery-migrate.min.js")}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script src="{{asset("template/js/bootstrap.min.js")}}" defer></script>
    <script src="{{asset("template/vendor/unifyMenu/unifyMenu.js")}}" defer></script>
    <script src="{{asset("template/vendor/onoffcanvas/onoffcanvas.js")}}" defer></script>
    <script src="{{asset("template/js/moment.js")}}" defer></script>

    <script src="{{asset("template/vendor/peity/peity.min.js")}}" defer></script>
    <script src="{{asset("template/vendor/peity/custom-peity.js")}}" defer></script>

    <script src="{{asset("template/vendor/circliful/circliful.min.js")}}" defer></script>
    <script src="{{asset("template/vendor/circliful/circliful.custom.js")}}" defer></script>

    <script src="{{asset("template/vendor/chartist/js/chartist.min.js")}}" defer></script>
    <script src="{{asset("template/vendor/slimscroll/slimscroll.min.js")}}" defer></script>
    <script src="{{asset("template/vendor/slimscroll/custom-scrollbar.js")}}" defer></script>

    <script src="{{asset("DataTables/bootstrap.bundle.min.js")}}" defer></script>
    <script src="{{asset("DataTables/datatables.js")}}" defer></script>
    <script src="{{asset("DataTables/dataTables.bootstrap5.js")}}" defer></script>
    <script src="{{asset("DataTables/dataTables.responsive.js")}}" defer></script>
    <script src="{{asset("DataTables/responsive.bootstrap5.js")}}" defer></script>
    <script src="{{asset("DataTables/dataTables.buttons.js")}}" defer></script>
    <script src="{{asset("DataTables/buttons.bootstrap5.js")}}" defer></script>
    <script src="{{asset("DataTables/jszip.min.js")}}" defer></script>
    <script src="{{asset("DataTables/pdfmake.min.js")}}" defer></script>
    <script src="{{asset("DataTables/vfs_fonts.js")}}" defer></script>
    <script src="{{asset("DataTables/buttons.html5.min.js")}}" defer></script>
    <script src="{{asset("DataTables/buttons.print.min.js")}}" defer></script>
    <script src="{{asset("DataTables/buttons.colVis.min.js")}}" defer></script>

    <script src="{{asset("js/administracion.js")}}" defer></script>
    <script src="{{asset("js/select2.min.js")}}" defer></script>
    <script src="{{asset("template/js/common.js")}}" defer></script>

    @stack('scripts')
    <script>
        $(document).ready(function() {
            irArriba();
        }); //Hacia arriba

        $(document).ready(function() {
            $('.multiples_responsables').select2();
        });

        function irArriba() {
            $('.ir-arriba').click(function() {
                $('body,html').animate({
                    scrollTop: '0px'
                }, "fast");
            });
            $(window).scroll(function() {
                if ($(this).scrollTop() > 0) {
                    $('.ir-arriba').slideDown(600);
                } else {
                    $('.ir-arriba').slideUp("fast");
                }
            });
            $('.ir-abajo').click(function() {
                $('body,html').animate({
                    scrollTop: '1000px'
                }, 1000);
            });
        }

        $(document).ready(function() {
            $('.multiples_responsables').select2();
        });
    </script>
</body>

</html>