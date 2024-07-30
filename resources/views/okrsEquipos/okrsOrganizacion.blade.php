@extends("layout")


@section('titulo')
Okrs Organización
@endsection

@section('styles')
<link rel="stylesheet" href="{{asset("css/stylesOkrs.min.css")}}">
@endsection

@section('headerPage')
<header class="main-heading">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-icon">
                    <i class="icon-shareable"></i>
                </div>
                <div class="page-title">
                    <h4>OKR's Organización</h4>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection

@section('contenido')
<div class="row gutters">
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                @include("okrsEquipos.filtroOkrsOrganizacional")
            </div>
        </div>
    </div>
</div>
<div class="row gutters">
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="progresos" data-bs-toggle="tooltip" align="center">
                    <h1 style="font-size: 3.5rem;color: black !important;"><b>{{ $PorcentajeFinalBarra }}%</b></h1>
                </div>
                <div id="progresoOKRS" class="progress-bar bg-success" role="progressbar" style="width:{{ $PorcentajeBarra }}%;{{ $ColorPorcentaje }};" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                </div><br>
            </div>
        </div>
    </div>
</div>
@if($Okrs)
@foreach($Okrs as $okr)
<div class="row gutters">
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header" id="headerOKR">
                <table style="width: 100%;border-style: hidden;margin-bottom: -10px;" class="table" id="OKR_id_{{$okr['id_okrs']}}">
                    <thead>
                        <th style="align-content: center;width:10%;text-align: center;">
                            <div class="progreso-bar-container" style="--i:{{ $okr['porcentaje'] }};--clr:{{ $okr['color_bg'] }}">
                                <div class="progreso-bar objetivo-okr">
                                    <progreso id="objetivo-okr" min="0" value="{{ $okr['porcentaje'] }}"></progreso>
                                </div>
                            </div>
                        </th>
                        <th style="width: 10%;align-content: center;text-align: center;" id="fotoOwnerOkr">
                            <div class="user-profile">{!! $okr['foto'] !!}</div>
                        </th>
                        <th style="width: 75%;font-size: 1rem;align-content: center;">
                            <h5><b>{{ $okr['objetivo_okr'] }}</b><br></h5>
                            <b>OKR: </b>{{ $okr['tipo'] }}<br>
                            <b>Owner: </b>{{ $okr['nombre_owner'] }}<br>
                            <div class="sub_periodo">
                                {{ $okr['anio'] }}: {{ $okr['fecha_inicia'] }} a {{ $okr['fecha_termina'] }} || Publicado por: {{ $okr['nombre_owner'] }}
                            </div>
                        </th>

                    </thead>
                </table>
            </div>

            @include("okrsEquipos.resultadosOkrs")
        </div>
    </div>
</div>

@endforeach
@else
<div class="row gutters">
    <div class="col-md-12 col-sm-12">
        <div class="card bg-warning">            
            <div class="card-body" style="text-align: center;">
                <h3 class="card-title">No tiene OKRs relacionados o creados.</h3>                
            </div>
        </div>

    </div>
</div>
@endif

<div class="row gutters">
    <div class="col-md-12 col-sm-12">
        <!-- {{$paginacion->links()}} -->
        {{$paginacion->appends(['vicepresidencia_fill' => $filtroVp, 'areas_fill' => $filtroArea, 'responsable_fill' => $filtroResponsable, 'objestrategico_fill' => $filtroObjEst, 'okr_fill' => $filtroOkr, 'tipo_okr_fill' => $filtroTipoOkr,
        'anio_fill' => $filtroAnio, 'Q1' => $filtroQ1, 'Q2' => $filtroQ2, 'Q3' => $filtroQ3, 'Q4' => $filtroQ4, 'Anual' => $filtroAnual])}}
    </div>
</div>
@include("modals.modalProfile")
@include("modals.modalKrs")
@include("modals.modalIniciativas")
@endsection
@section('scripts')
<script src="{{asset("js/okrs.min.js")}}"></script>
<script>
    $(document).ready(function() {
        $("#laretalOkrsEquipo").addClass("active selected");
        $("#navOkrs").addClass("in");
        $("#menuOkrsOrganizacion").addClass("current-page");
        $('.js-example-basic-single').select2();
        $(".pagination").addClass("table-responsive mb-2");

    });

    document.addEventListener("DOMContentLoaded", function() {
        var Iniciativa = "{{ $IniciativaKR }}";
        var Resultado = "{{ $ResultadoOKR }}";
        var divElement = document.getElementById("datosResultados_{{ $ResultadoOKR }}");
        var divElementKr = document.getElementById("heading{{ $ResultadoOKR }}");
        var divIniciativaM = document.getElementById("datosIniciativas_{{ $IniciativaKR }}");
        var divIniciativaMH = document.getElementById("header{{ $ResultadoOKR }}_{{$IniciativaKR}}");
        var divIniciativa = document.getElementById("IniciativasKR{{$ResultadoOKR}}");

        if (Iniciativa) {
            @handheld
            if (divIniciativaMH) {
                $("#datosResultados_{{ $ResultadoOKR }}").removeClass("collapsed");
                document.getElementById("datosResultados_{{ $ResultadoOKR }}").setAttribute("aria-expanded", true);
                $("#collapseKr{{ $ResultadoOKR }}").addClass("show");
                $('html, body').animate({
                    scrollTop: $("#header{{ $ResultadoOKR }}_{{$IniciativaKR}}").offset().top - 90
                }, 2000);
                $("#datosIniciativas_{{ $IniciativaKR }}").removeClass("collapsed");
                document.getElementById("datosIniciativas_{{ $IniciativaKR }}").setAttribute("aria-expanded", true);
                $("#collapsin{{ $IniciativaKR }}").addClass("show");
            }
            @elsehandheld
            if (divIniciativa) {
                $("#datosResultados_{{ $ResultadoOKR }}").removeClass("collapsed");
                document.getElementById("datosResultados_{{ $ResultadoOKR }}").setAttribute("aria-expanded", true);
                $("#collapseKr{{ $ResultadoOKR }}").addClass("show");
                $('html, body, #heading{{ $ResultadoOKR }}').animate({
                    scrollTop: $("#fila_{{ $IniciativaKR }}").offset().top - 200
                }, 2000);
            }
            @endhandheld
        }
        if (Resultado) {
            if (divElement) {
                // bootstrap.ScrollSpy.getInstance(divElementKr);
                $('html, body').animate({
                    scrollTop: $("#heading{{ $ResultadoOKR }}").offset().top - 90
                }, 2000);
                $("#datosResultados_{{ $ResultadoOKR }}").removeClass("collapsed");
                document.getElementById("datosResultados_{{ $ResultadoOKR }}").setAttribute("aria-expanded", true);
                $("#collapseKr{{ $ResultadoOKR }}").addClass("show");
            }
        }

        // divElement.scrollIntoView(false);
        // divIniciativa.scrollIntoView(false);

    });
    window.location.hash = "";
    window.location.hash = "";
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
@endsection