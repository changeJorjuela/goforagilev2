<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>GO FOR AGILE - OKR Suite By Change Americas</title>

    <link rel="icon" href="{{asset("img/IsotipoGFA.png")}}">
    <!-- <link rel="stylesheet" href="{{asset("adminlte/plugins/fontawesome-free/css/all.min.css")}}"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("adminlte/css/adminlte.min.css")}}">
    <link rel="stylesheet" href="{{asset("adminlte/css/login.css")}}">
    <link rel="stylesheet" href="{{asset("css/toastr.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/bootstrap_4_1_3.css")}}">
    <link rel="stylesheet" href="{{asset("css/login.css")}}">

</head>

<body style="background-size: cover; background-attachment: fixed; background-position: center;">

    <div class="container rounded-bottom" style="max-width: 900px;">
        <div class="row" style="display: flex; align-items: center;" id="content_log">

            <div class="col-md-6" align="center">
                <div style="margin-top: 20px;">
                    <h1 style="font-family: Lato-Black">Go For Agile</h1>
                </div>
                <div style="font-size: 18px; margin-bottom: 20px;">
                    El software que está ayudando a las organizaciones a conseguir resultados escalables en su estrategia de negocio, mediante la Metodología OKR (Objetivos y Resultados Claves).
                </div>
            </div>
            <div class="col-md-6">

                <div class="tarjeta" style="margin-bottom: 20px">
                    <h4 style="text-align:center; font-family: Lato-Black ">GO FOR AGILE - OKR Suite By Change Americas prueba</h4>
                    <p align="center" style="color: #ffffff; margin-bottom: 15px;">
                        Llego el momento de transformar tus Objetivos y Proyectos en Resultados Tangibles.
                    </p>

                    <div style="text-align:center"></div>

                    {!! Form::open(['url' => 'recuperarPassword', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'form-login']) !!}
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ingrese correo</label>
                        {!! Form::email('mail',null,['class'=>'form-control','id'=>'mail','placeholder'=>'Correo..','required']) !!}
                    </div>
                    <div align="right">
                        <button type="submit" class="btn btn-primary btn-block">Recuperar Contraseña</button>
                    </div>
                    <br>
                    <a href="{{ url('/') }}" class="btn btn-danger btn-block">Volver</a>
                    <div align="center" style="margin-top:15px">
                        <img src="{{asset("img/Logo_Blanco.png")}}" width="200">
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset("js/jquery-3.5.0.js")}}"></script>
    <script src="{{asset("js/jquery.validate.js")}}"></script>
    <script src="{{asset("js/login.js")}}"></script>
    <script>
        @if(session("mensaje"))
        $("#loginExitoso").modal("show");
        document.getElementById("exitoAlert").innerHTML = "{{ session("
        mensaje ") }}";
        @endif

        @if(session("precaucion"))
        $("#solicitudError").modal("show");
        document.getElementById("errorAlert").innerHTML = "{{ session("
        precaucion ") }}";
        @endif

        @if(count($errors) > 0)
        $("#solicitudError").modal("show");
        @foreach($errors->all() as $error)
        document.getElementById("errorAlert").innerHTML = "{{ $error }}";
        @endforeach
        @endif
    </script>
</body>

</html>