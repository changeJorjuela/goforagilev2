var mensaje = "{{ Session::get('mensaje'); }}";

if (mensaje){
            $("#contactoExitoso").modal("show");
            document.getElementById("exitoAlert").innerHTML = mensaje;
}

        // @if (session("precaucion"))
        //     $("#solicitudError").modal("show");
        //     document.getElementById("errorAlert").innerHTML = "{{ session("precaucion") }}";
        // @endif

        // @if (count($errors) > 0)
        // $("#solicitudError").modal("show");
        //     @foreach($errors -> all() as $error)
        //         document.getElementById("errorAlert").innerHTML = "{{ $error }}";
        //     @endforeach
        // @endif
