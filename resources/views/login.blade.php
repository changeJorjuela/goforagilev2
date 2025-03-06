<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GO FOR AGILE - OKR Suite By Change Americas</title>
    <link type="image/x-icon" rel="icon" href="{{asset("img/IsotipoGFA.png")}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("login/styles.min.css")}}">

</head>

<body>
    <div class="login-container">
        <video autoplay muted loop class="video-background">
            <source src="recursos/Video_Login.mp4" type="video/mp4">
        </video>
        <div class="login-form">
            <div class="login-logo"></div>
            {!! Form::open(['url' => 'acceso', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'form-login','class'=>'w-100']) !!}
            @csrf
            <div class="mb-3 text-start position-relative">
                <label class="form-label">Usuario</label>
                <input type="text" class="form-control" placeholder="Ingrese Usuario" aria-label="username" aria-describedby="username" name="user" id="user" required>
                <div class="invalid-feedback">Campo obligatorio y en formato de correo</div>
            </div>
            <div class="mb-3 text-start position-relative">
                <label class="form-label">Contraseña</label>
                <div class="password-container">
                    <input type="password" class="form-control" placeholder="Ingrese Contraseña" aria-label="Password" aria-describedby="Password" name="password" id="password" required>
                    <span class="toggle-password" onclick="togglePassword()">👁️</span>
                </div>
                <div class="invalid-feedback">Campo obligatorio</div>
            </div>
            <br>
            <button type="submit" id="btnIngresar">Ingresar</button>
            <p class="mt-3">¿Olvido su contraseña? <a href="{{ url('/recuperarContrasena') }}" class="text-primary">Recuperar</a></p>
            {!! Form::close() !!}
        </div>
    </div>
</body>
<script src="{{asset("template/js/jquery.js")}}"></script>
<script src="{{asset("template/js/bootstrap.min.js")}}"></script>
<script src="{{asset("js/jquery.validate.js")}}"></script>
<script src="{{asset("js/login.js")}}"></script>
<script src="{{asset("js/jquery.validate.min.js")}}"></script>
<script src="{{asset("js/additional-methods.min.js")}}"></script>
<script src="{{asset("js/toastr.min.js")}}"></script>
<script>
    @if(session("mensaje"))
    toastr.success("{{ session("
        mensaje ") }}");
    @endif

    @if(session("precaucion"))
    toastr.warning("{{ session("
        precaucion ") }}");
    @endif

    @if(count($errors) > 0)
    @foreach($errors -> all() as $error)
    toastr.error("{{ $error }}");
    @endforeach
    @endif
</script>

</html>