<div class="modal" id="iniciativaModal" tabindex="-1" role="dialog" aria-labelledby="area_newLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="headerModal">
            </div>
            <div class="modal-body" id="contentIniciativa">
                {!! Form::open(['url' => 'administrarIniciativa', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'formulario_iniciativa']) !!}
                @csrf
                <input type="hidden" name="guardar_iniciativa" value="true">
                <input type="hidden" name="id_okr" id="id_okr" value="">
                <input type="hidden" name="id_resultado" id="id_resultado" value="">
                <input type="hidden" name="id_registro" id="id_registro" value="">
                <input type="hidden" name="pagina" id="pagina" value="">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Descripción *</label>
                            {!! Form::textarea('descripcion', null, ['class' => 'form-control','id' => 'descripcion','placeholder' => 'Escriba el nombre de la iniciativa..','rows' => '2', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Fecha Entrega *</label>
                            {!! Form::date('fecha_entrega', null, ['class' => 'form-control','id' => 'fecha_entrega', 'required']) !!}
                        </div>
                        <div class="col-md-4">
                            <label>Meta *</label>
                            {!! Form::number('meta', null, ['class' => 'form-control','id' => 'meta', 'required', 'onkeypress'=>'return decimalMetaNumber(this, event);']) !!}
                        </div>
                        <div class="col-md-4" id="tendencia"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-8" id="responsables"></div>
                        <div class="col-md-4" style="align-content: center;">
                            <button type="button" class="btn btn-primary btn-block " onClick="Agregar_Responsable()">Agregar Responsable</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12" style="font-size: 14px;">
                        <label>Lista responsables</label>
                        <div id="lista_responsables"></div>
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
    function Agregar_Responsable() {

        id_responsable = $("#id_responsable").val();
        if (id_responsable) {
            responsable = $("#id_responsable option:selected").text();
            if (!$('#resp_' + id_responsable).length) {
                string = '<div id="resp_' + id_responsable + '"> <i class="icon-bin" onClick="Eliminar_Responsable(' + id_responsable + ')"></i> <b>' + responsable + '</b> <input type="hidden" name="responsables[]" value="' + id_responsable + '" ></div> ';

                $("#lista_responsables").append(string);
            }
            $("#id_responsable").val("");
        }
        document.getElementById("id_responsable").required = false;
    }

    function Eliminar_Responsable(id) {
        $("#resp_" + id).html("");
    }

    function decimalMetaNumber(element, event) {
        result = (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46;
        if (result) {
            let t = element.value;
            if (t === '' && event.charCode === 46) {
                return false;
            }
            let dotIndex = t.indexOf(".");
            let valueLength = t.length;
            if (dotIndex > 0) {
                if (dotIndex + 2 < valueLength) {
                    return false;
                } else {
                    return true;
                }
            } else if (dotIndex === 0) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
</script>