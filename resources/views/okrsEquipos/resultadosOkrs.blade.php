<div class="card-body responsive fill_resultados" id="bodyOKR">
    <div class="row gutters">
        <div class="col-md-12 col-sm-12">
            <div id="accordionIcons{{$okr['id_okrs']}}" class="accordion-icons" role="tablist">
                @foreach($okr['kr'] as $kr)
                <div class="card mb-0">
                    <div class="card-header" role="tab" id="heading{{$kr['id']}}">
                        <div class="row">
                            <div class="col-md-5">
                                <h5 class="fill_resultados">
                                    {{ $kr['periodo'] }}&nbsp;&nbsp;|&nbsp;&nbsp;{{ $kr['descripcion'] }}
                                </h5>
                            </div>
                            <div class="col-md-2">
                                <h5 class="fill_resultados">
                                    Meta:&nbsp;{{ $kr['txt_meta'] }}
                                </h5>
                            </div>
                            <div class="col-md-2">
                                <h5 class="fill_resultados">
                                    Seguimiento:&nbsp;{!! $kr['seguimiento'] !!}
                                </h5>
                            </div>
                            <div class="col-md-2">
                                <h5 class="fill_resultados">
                                    {!! $kr['porcentajeBarra'] !!}&nbsp;&nbsp;{{ $kr['porcentaje'] }} %
                                </h5>
                            </div>                            
                            <div class="col-md-1" style="text-align: end;">
                                <h5 class="fill_resultados">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseKr{{$kr['id']}}" aria-expanded="false" aria-controls="collapseKr{{$kr['id']}}" id="datosResultados_{{$kr['id']}}" style="color: black !important;">
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div id="collapseKr{{$kr['id']}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$kr['id']}}" data-parent="#accordionIcons{{$okr['id_okrs']}}">
                        <div class="card-body">
                            <div class="row">
                                @handheld
                                <div class="col md-12">
                                    <table class="table table-sm" id="TableKrMovil">
                                        <tbody>
                                            <tr>
                                                <td><b>Responsables</b></td>
                                                <td clase="detalleKrIniciativa">{!! $kr['listaResponsables'] !!}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Inicia</b></td>
                                                <td clase="detalleKrIniciativa">{{ $kr['fecha_inicia'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Entrega</b></td>
                                                <td clase="detalleKrIniciativa">{{ $kr['fecha_entrega'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Días Faltantes</b></td>
                                                <td clase="detalleKrIniciativa">{!! $kr['porcentaje_dias'] !!}Faltan {{ $kr['dias_faltantes'] }} días</td>
                                            </tr>
                                            <tr>
                                                <td><b>Seguimiento</b></td>
                                                <td clase="detalleKrIniciativa">{!! $kr['avance'] !!}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Acciones</b></td>
                                                <td clase="detalleKrIniciativa">{!! $kr['acciones'] !!}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @elsehandheld
                                <div class="col-md-3"><b>Responsables</b><br>{!! $kr['listaResponsables'] !!}</div>
                                <div class="col-md-2"><b>Inicia</b><br>{{ $kr['fecha_inicia'] }}</div>
                                <div class="col-md-2"><b>Entrega</b><br>{{ $kr['fecha_entrega'] }}</div>
                                <div class="col-md-2"><b>Días Faltantes</b>{!! $kr['porcentaje_dias'] !!}Faltan {{ $kr['dias_faltantes'] }} días</div>
                                <div class="col-md-2"><b>Seguimiento</b>{!! $kr['avance'] !!}</div>
                                <div class="col-md-1" style="text-align: right;"><b>Acciones</b><br>{!! $kr['acciones'] !!}</div>
                                @endhandheld
                            </div>
                            <br>
                            <div class="row" id="botonesForm">
                                <div class="col-md-12">
                                    {!! $kr['btnGuardar'] !!}
                                </div>
                            </div>
                        </div>
                        @if($kr['iniciativas'])
                        @include("okrsEquipos.iniciativasKR")

                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>