<div class="card-footer">
    @handheld
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div id="accordionIcons{{$kr['id']}}" class="accordion-icons" role="tablist">
                @foreach($kr['iniciativas'] as $iniciativa)
                <div class="card mb-0">
                    <div class="card-header" role="tab" id="header{{$kr['id']}}_{{$iniciativa['id']}}">
                        <div class="row">
                            <div class="col-md-7">
                                <h5 class="fill_iniciativas">
                                    <a class="collapsed" data-toggle="collapse" href="#collapsin{{$iniciativa['id']}}" aria-expanded="false" aria-controls="collapsin{{$iniciativa['id']}}" id="datosIniciativas_{{$iniciativa['id']}}" style="color: black !important;">
                                        {{$iniciativa['descripcion']}}
                                    </a>
                                </h5>
                            </div>
                            <div class="col-md-2">
                                <h5 class="fill_iniciativas">
                                    Meta:&nbsp;{{$iniciativa['meta']}}
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <h5 class="fill_iniciativas">
                                    {!! $iniciativa['porcentajeBarra'] !!}&nbsp;&nbsp;{{ $iniciativa['porcentaje'] }} %
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div id="collapsin{{$iniciativa['id']}}" class="collapse" role="tabpanel" aria-labelledby="header{{$kr['id']}}_{{$iniciativa['id']}}" data-parent="#accordionIcons{{$kr['id']}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col md-12">
                                    <table class="table table-sm" id="TableIniciativaMovil">
                                        <tbody>
                                            <tr>
                                                <td><b>Responsables</b></td>
                                                <td clase="detalleKrIniciativa">{!!$iniciativa['responsables']!!}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Entrega</b></td>
                                                <td clase="detalleKrIniciativa">{{$iniciativa['entrega']}}</td>
                                            </tr>
                                            <tr id="fila_{{$iniciativa['id']}}">
                                                <td><b>Seguimiento</b></td>
                                                <td clase="detalleKrIniciativa">{!!$iniciativa['avance']!!}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Acciones</b></td>
                                                <td clase="detalleKrIniciativa" style="text-align: right;text-align:-webkit-right;">{!! $iniciativa['acciones'] !!}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>
    @elsehandheld
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <table class="table table-responsive" id="IniciativasKR{{$kr['id']}}">
                <thead>
                    <th style="width: 50% !important;"><b>Iniciativa</b></th>
                    <th style="width: 10% !important;"><b>Responsables</b></th>
                    <th style="width: 10% !important;"><b>Entrega</b></th>
                    <th style="width: 5% !important;"><b>Meta</b></th>
                    <th style="width: 10% !important;"><b>Seguimiento</b></th>
                    <th style="width: 15% !important;"><b>% Iniciativa</b></th>
                    <th style="text-align: right;width: 15% !important;"><b>Acciones</b></th>
                </thead>
                <tbody>
                    @foreach($kr['iniciativas'] as $iniciativa)
                    <tr id="fila_{{$iniciativa['id']}}">
                        <td style="width: 50% !important;">{{$iniciativa['descripcion']}}</td>
                        <td style="width: 10% !important;">{!!$iniciativa['responsables']!!}</td>
                        <td style="width: 10% !important;">{{$iniciativa['entrega']}}</td>
                        <td style="width: 5% !important;">{{$iniciativa['meta']}}</td>
                        <td style="width: 10% !important;">{!!$iniciativa['avance']!!}</td>
                        <td style="width: 15% !important;">{!! $iniciativa['porcentajeBarra'] !!}&nbsp;&nbsp;{{ $iniciativa['porcentaje'] }} %</td>
                        <td style="text-align: right;text-align:-webkit-right;width: 15% !important;">{!! $iniciativa['acciones'] !!}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <td colspan="7"  id="botonesForm">{!! $kr['btnGuardarIni'] !!}</td>
                </tfoot>
            </table>

        </div>
    </div>
    @endhandheld
</div>