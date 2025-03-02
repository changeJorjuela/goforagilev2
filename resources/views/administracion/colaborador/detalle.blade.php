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
            <div class="col-sm-12">
                <div class="page-icon">
                    <i class="icon-user"></i>
                </div>
                <div class="page-title">
                    <h4>Editar Colaborador</h4>
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
                <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="datos-colaborador" data-toggle="tab" href="#datos" role="tab"
                            aria-controls="datos" aria-selected="true">Datos Básicos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="lider-colaborador" data-toggle="tab" href="#lider" role="tab"
                            aria-controls="lider" aria-selected="false">Lider Plataforma</a>
                    </li>
                    @if(Session::get('ModValoracion') === 'on')
                    <li class="nav-item">
                        <a class="nav-link" id="evaluador_colaborador" data-toggle="tab" href="#evaluador" role="tab"
                            aria-controls="evaluador" aria-selected="false">Evaluador Competencias</a>
                    </li>
                    @endif
                </ul>
                <div class="tab-content" id="myTabContent1">
                    <div class="tab-pane fade show active" id="datos" role="tabpanel" aria-labelledby="datos-colaborador">
                        @include("administracion.colaborador.formEditar")
                    </div>
                    <div class="tab-pane fade" id="lider" role="tabpanel" aria-labelledby="lider-colaborador">With the
                        clear separation of concerns within Chartist.js, you're able to style your charts with CSS in
                        @media queries. However, sometimes you also need to conditionally control the behavior of your
                        charts. For this purpose, Chartist.js provides you with a simple configuration override
                        mechanism based on media queries.</div>
                    @if(Session::get('ModValoracion') === 'on')
                    <div class="tab-pane fade" id="evaluador" role="tabpanel" aria-labelledby="evaluador_colaborador">With the
                        clear separation of concerns within Chartist.js, you're able to style your charts with CSS in
                        @media queries. However, sometimes you also need to conditionally control the behavior of your
                        charts. For this purpose, Chartist.js provides you with a simple configuration override
                        mechanism based on media queries.</div>
                    @endif
                </div>
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