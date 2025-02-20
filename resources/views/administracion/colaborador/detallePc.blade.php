@extends("layout")

@push('styles')

@endpush

@section('titulo')
Colaborador
@endsection

@section('headerPage')
<header class="main-heading">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10">
                <div class="page-icon">
                    <i class="icon-network"></i>
                </div>
                <div class="page-title">
                    <h4>Crear / Editar Colaborador</h4>
                </div>
            </div>
            <div class="col-sm-2" style="text-align: end;">
                <a href="colaboradores" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
</header>
@endsection

@section('contenido')

<div class="row guttes">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form action="editarColaboradorPC" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="documento">Documento / Código Interno *</label>
                                <input type="text" name="documento" id="documento" class="form-control">
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $("#lateralAdmin").addClass("active selected");
        $("#navAdmin").addClass("in");
        $("#menuColaboradores").addClass("current-page");
        $('.js-example-basic-single').select2();
    });
</script>
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
@endpush