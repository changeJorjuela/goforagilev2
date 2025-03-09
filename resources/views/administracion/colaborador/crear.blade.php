@extends("layout")

@push('styles')

@endpush

@section('titulo')
Colaboradores
@endsection

@section('headerPage')
<header class="main-heading">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10">
                <div class="page-icon">
                    <i class="icon-user"></i>
                </div>
                <div class="page-title">
                    <h4>Crear Colaborador</h4>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="right-actions">
                    <a href="{{ url('administrador/colaboradores') }}" class="btn btn-primary float-right btn-rounded" data-toggle="tooltip" data-placement="left" title="" data-original-title="Download Reports">
                        Volver
                    </a>
                </div>
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
                @if(Session::get('id_empresa') == 1)
                @include("administracion.colaborador.formCrearPc")
                @else
                @include("administracion.colaborador.formCrear")
                @endif
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
@endpush