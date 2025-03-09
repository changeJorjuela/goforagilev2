<div class="modal" id="cargo_new" tabindex="-1" role="dialog" aria-labelledby="cargo_newLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Crear {!! Session::get('EtiquetaAdminCargos') !!}</h5>
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
                            <label for="nombre_cargo" class="col-form-label">Nombre {!! Session::get('EtiquetaAdminCargos') !!}</label>
                            {!! Form::text('nombre_cargo',null,['class'=>'form-control','id'=>'nombre_cargo','placeholder'=>'Nombre Cargo','required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="area" class="col-form-label">{!! Session::get('EtiquetaAdminArea') !!}</label>
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
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-agile">Crear {!! Session::get('EtiquetaAdminCargos') !!}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal" id="cargo_upd" tabindex="-1" role="dialog" aria-labelledby="cargo_updLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Actualizar {!! Session::get('EtiquetaAdminCargos') !!}</h5>
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
                            <label for="mod_nombre_cargo" class="col-form-label">Nombre {!! Session::get('EtiquetaAdminCargos') !!}</label>
                            {!! Form::text('nombre_cargo_upd',null,['class'=>'form-control','id'=>'mod_nombre_cargo','placeholder'=>'Nombre Cargo','required']) !!}
                        </div>
                        <div class="col-md-6">
                            <label for="mod_area" class="col-form-label">{!! Session::get('EtiquetaAdminArea') !!}</label>
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
                <button type="submit" class="btn btn-agile">Actualizar {!! Session::get('EtiquetaAdminCargos') !!}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal" id="cargo_delete" tabindex="-1" role="dialog" aria-labelledby="cargo_deleteLabel3" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Eliminar {!! Session::get('EtiquetaAdminCargos') !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">×</span> -->
                    <span class="icon-cross"></span>
                </button>
            </div>
            {!! Form::open(['url' => 'eliminarCargo', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'form-cargo_new']) !!}
            @csrf
            <input type="hidden" name="id_cargo_delete" id="idCargo_delete">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" style="text-align:center;">
                        <center>
                            <picture>
                                <source srcset="{{asset("img/uncheck.webp")}}" type="image/webp" />
                                <source srcset="{{asset("img/uncheck.png")}}" type="image/png" />
                                <img src="{{asset("img/uncheck.webp")}}" id="imgAlerts">
                            </picture>
                        </center>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <p id="textoModal">Está a punto de eliminar un {!! Session::get('EtiquetaAdminCargos') !!}, esta acción es irreversible ¿está seguro?</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Eliminar {!! Session::get('EtiquetaAdminCargos') !!}</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>