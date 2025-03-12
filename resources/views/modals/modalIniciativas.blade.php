<div class="modal" id="iniciativaModal" tabindex="-1" role="dialog" aria-labelledby="area_newLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="headerModalIniciativa">
            </div>
            <div class="modal-body" id="contentIniciativa">
                {!! Form::open(['url' => 'administrarIniciativa', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'formulario_iniciativa']) !!}
                @csrf
                <input type="hidden" name="guardar_iniciativa" value="true">
                <input type="hidden" name="id_okr_ini" id="id_okr_ini" value="">
                <input type="hidden" name="id_resultado_ini" id="id_resultado_ini" value="">
                <input type="hidden" name="id_iniciativa" id="id_iniciativa" value="">
                <input type="hidden" name="pagina_ini" id="pagina_ini" value="">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Descripción *</label>
                            {!! Form::textarea('descripcion_ini', null, ['class' => 'form-control','id' => 'descripcion_ini','placeholder' => 'Escriba el nombre de la iniciativa..','rows' => '2', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Fecha Entrega *</label>
                            {!! Form::date('fecha_entrega_ini', null, ['class' => 'form-control','id' => 'fecha_entrega_ini', 'required']) !!}
                        </div>
                        <div class="col-md-4">
                            <label>Meta *</label>
                            {!! Form::number('meta_ini', null, ['class' => 'form-control','id' => 'meta_ini', 'required', 'onkeypress'=>'return decimalMetaNumber(this, event);']) !!}
                        </div>
                        <div class="col-md-4" id="tendencia_ini"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-8" id="responsables_ini"></div>
                        <div class="col-md-4" style="align-content: center;">
                            <button type="button" class="btn btn-primary btn-block " onClick="Agregar_Responsable_Iniciativa()">Agregar Responsable</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12" style="font-size: 14px;">
                        <label>Lista responsables</label>
                        <div id="lista_responsables_ini"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row" id="botonesForm">
                        <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-danger btn-rounded" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            
        </div>
    </div>
</div>
<script>
    function Agregar_Responsable_Iniciativa() {

        id_responsable = $("#id_responsable_ini").val();
        if (id_responsable) {
            responsable = $("#id_responsable_ini option:selected").text();
            if (!$('#resp_' + id_responsable).length) {
                string = '<div id="resp_' + id_responsable + '"> <i class="icon-bin" onClick="Eliminar_Responsable_Ini(' + id_responsable + ')"></i> <b>' + responsable + '</b> <input type="hidden" name="responsables_ini[]" value="' + id_responsable + '" ></div> ';

                $("#lista_responsables_ini").append(string);
            }
            $("#id_responsable_ini").val("");
        }
        document.getElementById("id_responsable_ini").required = false;
    }

    function Eliminar_Responsable_Ini(id) {
        $("#resp_" + id).html("");
    }
    
</script>
