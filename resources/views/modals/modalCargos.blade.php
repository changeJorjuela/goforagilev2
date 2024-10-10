<div class="modal" id="cargo_new" tabindex="-1" role="dialog" aria-labelledby="cargo_newLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Crear Cargo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">×</span> -->
                    <span class="icon-cross"></span>
                </button>
            </div>
            {!! Form::open(['url' => 'crearCargo', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'form-cargo_new']) !!}
            @csrf
            <div class="modal-body">

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nombre_cargo" class="col-form-label">Nombre Cargo</label>
                            {!! Form::text('nombre_cargo',null,['class'=>'form-control','id'=>'nombre_cargo','placeholder'=>'Nombre Cargo','required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="area" class="col-form-label">Área</label>
                            {!! Form::select('area',$Areas,null,['class'=>'js-example-basic-single','id'=>'area','style'=>'width: 100%;']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nivel_jerarquico" class="col-form-label">Nivel Jerárquico</label>
                            {!! Form::text('nivel_jerarquico',null,['class'=>'form-control','id'=>'nivel_jerarquico','placeholder'=>'Nivel Jerárquico']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-agile">Crear Cargo</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal" id="cargo_upd" tabindex="-1" role="dialog" aria-labelledby="cargo_updLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Actualizar Cargo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">×</span> -->
                    <span class="icon-cross"></span>
                </button>
            </div>
            {!! Form::open(['url' => 'actualizarCargo', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'form-cargo_new']) !!}
            @csrf
            <div class="modal-body">
            <input type="hidden" name="id_cargo" id="idCargo_upd">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="mod_nombre_cargo" class="col-form-label">Nombre Cargo</label>
                            {!! Form::text('nombre_cargo_upd',null,['class'=>'form-control','id'=>'mod_nombre_cargo','placeholder'=>'Nombre Cargo','required']) !!}
                        </div>                    
                        <div class="col-md-6">
                            <label for="mod_area" class="col-form-label">Área</label>
                            {!! Form::select('area_upd',$Areas,null,['class'=>'js-example-basic-single','id'=>'mod_area','style'=>'width: 100%;']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="mod_nivel_jerarquico" class="col-form-label">Nivel Jerárquico</label>
                            {!! Form::text('nivel_jerarquico_upd',null,['class'=>'form-control','id'=>'mod_nivel_jerarquico','placeholder'=>'Jerarquia']) !!}
                        </div>
                        <div class="col-md-6">
                        <label for="mod_estado">Estado</label>
                        {!! Form::select('estado_upd',$Estado,null,['class'=>'form-control','id'=>'mod_estado']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-agile">Actualizar Cargo</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>