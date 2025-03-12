<div class="modal" id="colaborador_delete" tabindex="-1" role="dialog" aria-labelledby="colaborador_deleteLabel3" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Eliminar Colaborador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">×</span> -->
                    <span class="icon-cross"></span>
                </button>
            </div>
            {!! Form::open(['url' => 'Colaborador', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'form-colaborador_new']) !!}
            @csrf
            <input type="hidden" name="id_colaborador_delete" id="idcolaborador_delete">
            <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <p id="textoModal">Está a punto de eliminar un colaborador, esta acción es irreversible ¿está seguro?</p>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-rounded" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger btn-rounded">Eliminar colaborador</button>
            </div>
            {!! Form::close() !!}   
        </div>
    </div>
</div>