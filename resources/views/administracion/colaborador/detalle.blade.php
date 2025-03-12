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
                    <h4>Editar Colaborador</h4>
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
                <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="datos-colaborador" data-toggle="tab" href="#datos_tab_panel_{{ $idColaborador }}" role="tab"
                            aria-controls="datos" aria-selected="true">Datos Básicos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="lider-colaborador" data-toggle="tab" href="#lider_tab_panel_{{ $idColaborador }}" role="tab"
                            aria-controls="lider" aria-selected="false">Lider Plataforma</a>
                    </li>
                    @if(Session::get('ModValoracion') === 'on')
                    <li class="nav-item">
                        <a class="nav-link" id="evaluador-colaborador" data-toggle="tab" href="#evaluador_tab_panel_{{ $idColaborador }}" role="tab"
                            aria-controls="evaluador" aria-selected="false">Evaluador Competencias</a>
                    </li>
                    @endif
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="datos_tab_panel_{{ $idColaborador }}" role="tabpanel" aria-labelledby="datos-colaborador">
                        @if(Session::get('id_empresa') == 1)
                        @include("administracion.colaborador.formEditarPc")
                        @else
                        @include("administracion.colaborador.formEditar")
                        @endif
                    </div>
                    <div class="tab-pane fade" id="lider_tab_panel_{{ $idColaborador }}" role="tabpanel" aria-labelledby="lider-colaborador">
                        @include("administracion.colaborador.lider")
                    </div>
                    @if(Session::get('ModValoracion') === 'on')
                    <div class="tab-pane fade" id="evaluador_tab_panel_{{ $idColaborador }}" role="tabpanel" aria-labelledby="evaluador-colaborador">With the
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
@include("modals.modalColaboradores")
@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $("#lateralAdmin").addClass("active selected");
        $("#navAdmin").addClass("in");
        $("#menuColaboradores").addClass("current-page");
        $('.js-example-basic-single').select2();
    });

    document.addEventListener("DOMContentLoaded", function() {
        var divElementEB = document.getElementById("myTabContent");
        var divElementO = document.getElementById("datos_tab_panel_{{ request('datos_tab_panel') }}");
        var divElementI = document.getElementById("evaluador_tab_panel_{{ request('evaluador_tab_panel') }}");
        var divElementA = document.getElementById("lider_tab_panel_{{ request('lider_tab_panel') }}");

        if (divElementO) {
            // divElementEB.scrollIntoView();
            $("#lider-colaborador").removeClass("active");
            $("#lider_tab_panel_{{ $idColaborador }}").removeClass("active show");
            $("#evaluador-colaborador").removeClass("active");
            $("#evaluador_tab_panel_{{ $idColaborador }}").removeClass("active show");
            $("#datos-colaborador").addClass("active");
            $("#datos_tab_panel_{{ $idColaborador }}").addClass("active show");
        }
        if (divElementI) {
            // divElementEB.scrollIntoView();
            $("#datos-colaborador").removeClass("active");
            $("#datos_tab_panel_{{ $idColaborador }}").removeClass("active show");
            $("#lider-colaborador").removeClass("active");
            $("#lider_tab_panel_{{ $idColaborador }}").removeClass("active show");
            $("#evaluador-colaborador").addClass("active");
            $("#evaluador_tab_panel_{{ $idColaborador }}").addClass("active show");

        }
        if (divElementA) {
            // divElementEB.scrollIntoView();
            $("#datos-colaborador").removeClass("active");
            $("#datos_tab_panel_{{ $idColaborador }}").removeClass("active show");
            $("#evaluador-colaborador").removeClass("active");
            $("#evaluador_tab_panel_{{ $idColaborador }}").removeClass("active show");
            $("#lider-colaborador").addClass("active");
            $("#lider_tab_panel_{{ $idColaborador }}").addClass("active show");
        }


    });
    window.location.hash = "";
</script>
<script>
    @if(session("mensaje"))
    toastr.success("{{ session("mensaje") }}");
    @endif

    @if(session("precaucion"))
    toastr.warning("{{ session("precaucion") }}");
    @endif

    @if(count($errors) > 0)
    @foreach($errors -> all() as $error)
    toastr.error("{{ $error }}");
    @endforeach
    @endif
</script>
@endpush