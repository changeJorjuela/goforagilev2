<div class="modal" id="area_new" tabindex="-1" role="dialog" aria-labelledby="area_newLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Crear {!! Session::get('EtiquetaAdminArea') !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">×</span> -->
                    <span class="icon-cross"></span>
                </button>
            </div>
            {!! Form::open(['url' => 'crearArea', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'form-area_new']) !!}
            @csrf
            <div class="modal-body">

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nombre_area" class="col-form-label">Nombre {!! Session::get('EtiquetaAdminArea') !!}</label>
                            {!! Form::text('nombre_area',null,['class'=>'form-control','id'=>'nombre_area','placeholder'=>'Nombre Área','required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="padre" class="col-form-label">Padre</label>
                            {!! Form::select('padre',$AreasPadre,null,['class'=>'js-example-basic-single','id'=>'padre','style'=>'width: 100%;']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="jerarquia" class="col-form-label">Jerarquía</label>
                            {!! Form::text('jerarquia',null,['class'=>'form-control','id'=>'jerarquia','placeholder'=>'Jerarquia']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-agile">Crear {!! Session::get('EtiquetaAdminArea') !!}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal" id="area_upd" tabindex="-1" role="dialog" aria-labelledby="area_updLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Actualizar {!! Session::get('EtiquetaAdminArea') !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">×</span> -->
                    <span class="icon-cross"></span>
                </button>
            </div>
            {!! Form::open(['url' => 'actualizarArea', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'form-area_new']) !!}
            @csrf
            <div class="modal-body">
                <input type="hidden" name="id_area" id="idArea_upd">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="mod_nombre_area" class="col-form-label">Nombre {!! Session::get('EtiquetaAdminArea') !!}</label>
                            {!! Form::text('nombre_area_upd',null,['class'=>'form-control','id'=>'mod_nombre_area','placeholder'=>'Nombre Área','required']) !!}
                        </div>
                        <div class="col-md-6">
                            <label for="mod_padre" class="col-form-label">Padre</label>
                            {!! Form::select('padre_upd',$AreasPadre,null,['class'=>'js-example-basic-single','id'=>'mod_padre','style'=>'width: 100%;']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="mod_jerarquia" class="col-form-label">Jerarquía</label>
                            {!! Form::text('jerarquia_upd',null,['class'=>'form-control','id'=>'mod_jerarquia','placeholder'=>'Jerarquia']) !!}
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
                <button type="submit" class="btn btn-danger">Actualizar {!! Session::get('EtiquetaAdminArea') !!}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="modal" id="area_delete" tabindex="-1" role="dialog" aria-labelledby="area_deleteLabel3" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Eliminar {!! Session::get('EtiquetaAdminArea') !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">×</span> -->
                    <span class="icon-cross"></span>
                </button>
            </div>
            {!! Form::open(['url' => 'eliminarArea', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'form-area_new']) !!}
            @csrf
            <input type="hidden" name="id_area_delete" id="idArea_delete">
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
                        <p id="textoModal">Está a punto de eliminar un {!! Session::get('EtiquetaAdminArea') !!}, esta acción es irreversible ¿está seguro?</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">                
                <button type="submit" class="btn btn-danger">Eliminar {!! Session::get('EtiquetaAdminArea') !!}</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>