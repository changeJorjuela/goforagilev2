<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="width">
    <title>GO FOR AGILE - OKR Suite By Change Americas</title>
    <link type="image/x-icon" rel="icon" href="{{asset("img/IsotipoGFA.png")}}">
    <link rel="stylesheet" href="{{asset("template/css/bootstrap.min.css")}}" />
    <link rel="stylesheet" href="{{asset("template/fonts/icomoon/icomoon.css")}}" />
    <link rel="stylesheet" href="{{asset("template/css/main.min.css")}}" />
    <link rel="stylesheet" href="{{asset("css/toastr.min.css")}}">
</head>

<body class="login-bg">
    <div class="container">
        <div class="login-screen row align-items-center">
            <div class="col-sm-12">
                {!! Form::open(['url' => 'acceso', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'form-login']) !!}
                @csrf
                <div class="login-container">
                    <div class="row no-gutters">
                        
                        <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12">
                            <div class="login-slider">
                                <h1 style="font-family: Lato-Black;">Go For Agile</h1>
                                <h5>El software que está ayudando a las organizaciones a conseguir resultados escalables en su estrategia de negocio, mediante la Metodología&nbsp;OKR&nbsp;(Objetivos y Resultados Claves).</h5>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
                            <div class="login-box">
                                <div class="input-group mb-2">
                                    <div class="col-md-12" style="text-align: center;">
                                        <h4 id="textLogin">GO FOR AGILE - OKR Suite By Change Americas</h4>
                                        <h6 style="color:white;">Llego el momento de transformar tus Objetivos y Proyectos en Resultados Tangibles.</h6>
                                    </div>
                                </div>
                                <br>
                                <div class="input-group mb-2">
                                    <!-- <div class="input-group-prepend">
                                        <span class="input-group-text" id="username">
                                            <i class="icon-account_circle"></i>
                                        </span>
                                    </div> -->
                                    <!-- <label for="user" style="color: white;">Ingrese Usuario</label> -->
                                    <input type="text" class="form-control" placeholder="Ingrese Usuario" aria-label="username" aria-describedby="username" name="user" id="user" required>
                                    <div class="invalid-feedback">Campo obligatorio y en formato de correo</div>
                                </div>
                                <div class="input-group mb-2">
                                    <input type="password" class="form-control" placeholder="Ingrese Contraseña" aria-label="Password" aria-describedby="Password" name="password" id="password" required>
                                    <div class="input-group-append">
                                        <button id="show_password" class="btn btn-primary" type="button" onClick="Ver_Pass(this)"> <span class="icon-eye"></span> </button>
                                    </div>
                                    <div class="invalid-feedback">Campo obligatorio</div>
                                </div>
                                
                                <div class="actions clearfix">
                                <button type="submit" class="btn btn-primary btn-lg">Ingresar <i class="icon icon-login"></i></button>
                                </div>

                                <div class="mt-4" style="text-align:center;">
                                    <a href="{{ url('/recuperarContrasena') }}" style="color: white !important;">¿Olvido su contraseña?</a>
                                </div>
                                <a href="" class="login-logo">
                                    <img src="{{asset("img/Logo_Blanco.png")}}" alt="Admin Dashboards" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{asset("template/js/jquery.js")}}"></script>
    <script src="{{asset("template/js/bootstrap.min.js")}}"></script>
    <script src="{{asset("js/jquery.validate.js")}}"></script>
    <script src="{{asset("js/login.js")}}"></script>
    <script src="{{asset("js/jquery.validate.min.js")}}"></script>
    <script src="{{asset("js/additional-methods.min.js")}}"></script>
    <script src="{{asset("js/toastr.min.js")}}"></script>
    <script>
        @if (session("mensaje"))
            toastr.success("{{ session("mensaje") }}");
        @endif

        @if (session("precaucion"))
            toastr.warning("{{ session("precaucion") }}");
        @endif

        @if (count($errors) > 0)
            @foreach($errors -> all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
</body>

</html>