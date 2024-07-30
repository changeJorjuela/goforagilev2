<div class="modal" id="krModal" tabindex="-1" role="dialog" aria-labelledby="area_newLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="headerModalResultado">
            </div>
            <div class="modal-body" id="contentKr">
                {!! Form::open(['url' => 'administrarKr', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'formulario_kr']) !!}
                @csrf
                <input type="hidden" name="guardar_kr" value="true">
                <input type="hidden" name="id_okr_kr" id="id_okr_kr" value="">
                <input type="hidden" name="id_resultado" id="id_resultado" value="">
                <input type="hidden" name="pagina_kr" id="pagina_kr" value="">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Descripción *</label>
                            {!! Form::textarea('descripcion_kr', null, ['class' => 'form-control','id' => 'descripcion_kr','placeholder' => 'Escriba el nombre del Kr..','rows' => '2', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Fecha Inicia *</label>
                            {!! Form::date('fecha_inicia_kr', null, ['class' => 'form-control','id' => 'fecha_inicia_kr', 'required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label>Fecha Entrega *</label>
                            {!! Form::date('fecha_entrega_kr', null, ['class' => 'form-control','id' => 'fecha_entrega_kr', 'required']) !!}
                        </div>
                        <div class="col-md-3" id="tendencia_kr"></div>
                        <div class="col-md-3" id="medicion_kr"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">                    
                        <div class="col-md-3">
                            <label>Meta *</label>
                            {!! Form::number('meta_kr', null, ['class' => 'form-control','id' => 'meta_kr', 'required', 'onkeypress'=>'return decimalMetaNumber(this, event);']) !!}
                        </div>
                        <div class="col-md-3">
                            <label>Meta Mínima</label>
                            {!! Form::number('meta_minima_kr', null, ['class' => 'form-control','id' => 'meta_minima_kr',  'onkeypress'=>'return decimalMetaNumber(this, event);']) !!}
                        </div>
                        <div class="col-md-3">
                            <label>Meta Máxima</label>
                            {!! Form::number('meta_maxima_kr', null, ['class' => 'form-control','id' => 'meta_maxima_kr',  'onkeypress'=>'return decimalMetaNumber(this, event);']) !!}
                        </div>
                        <div class="col-md-3" id="periodo_kr"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-8" id="responsables_kr"></div>
                        <div class="col-md-4" style="align-content: center;">
                            <button type="button" class="btn btn-primary btn-block " onClick="Agregar_Responsable_KR()">Agregar Responsable</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12" style="font-size: 14px;">
                            <label>Lista responsables</label>
                            <div id="lista_responsables_kr"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row" id="botonesForm">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>
<script>
    function Agregar_Responsable_KR() {

        id_responsable = $("#id_responsable_kr").val();
        if (id_responsable) {
            responsable = $("#id_responsable_kr option:selected").text();
            if (!$('#resp_' + id_responsable).length) {
                string = '<div id="resp_ini_' + id_responsable + '"> <i class="icon-bin" onClick="Eliminar_Responsable_KR(' + id_responsable + ')"></i> <b>' + responsable + '</b> <input type="hidden" name="responsables_kr[]" value="' + id_responsable + '" ></div> ';

                $("#lista_responsables_kr").append(string);
            }
            $("#id_responsable_kr").val("");
        }
        document.getElementById("id_responsable_kr").required = false;
    }

    function Eliminar_Responsable_KR(id) {
        $("#resp_ini_" + id).html("");
    }
</script>