<div class="modal" id="colaborador_new" tabindex="-1" role="dialog" aria-labelledby="colaborador_newLabel1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Crear Colaborador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">×</span> -->
                    <span class="icon-cross"></span>
                </button>
            </div>
            {!! Form::open(['url' => 'crearColaborador', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'form-colaborador_new']) !!}
            @csrf
            <div class="modal-body">

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="documento">Documento *</label>
                            {!! Form::text('documento',null,['class'=>'form-control','id'=>'documento','placeholder'=>'Documento', 'required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="nombre_colaborador">Nombre Completo*</label>
                            {!! Form::text('nombre_colaborador',null,['class'=>'form-control','id'=>'nombre_colaborador','placeholder'=>'Nombre Completo', 'required']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="genero" class="col-form-label">Genero</label>
                            {!! Form::select('genero',$Genero,null,['class'=>'form-control','id'=>'genero','style'=>'width: 100%;']) !!}
                        </div>
                        
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-agile">Crear Colaborador</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>