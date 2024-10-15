<div class="modal" id="colaboradorPc_new" tabindex="-1" role="dialog" aria-labelledby="colaboradorPc_newLabel1" aria-hidden="true">
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
                            <label for="documento">Código Colaborador / Documento *</label>
                            {!! Form::text('documento',null,['class'=>'form-control','id'=>'documento','placeholder'=>'Código / Documento', 'required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="nombre_colaborador">Nombre Completo*</label>
                            {!! Form::text('nombre_colaborador',null,['class'=>'form-control','id'=>'nombre_colaborador','placeholder'=>'Nombre Completo', 'required']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="genero" class="col-form-label">Genero</label>
                            {!! Form::select('genero',$Genero,null,['class'=>'form-control','id'=>'genero','style'=>'width: 100%;']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="antiguedad_anios">Antiguedad Años</label>
                            {!! Form::text('antiguedad_anios',null,['class'=>'form-control','id'=>'antiguedad_anios','placeholder'=>'Años']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="antiguedad_meses">Antiguedad Meses</label>
                            {!! Form::text('antiguedad_meses',null,['class'=>'form-control','id'=>'antiguedad_meses','placeholder'=>'Meses']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="antiguedad_dias">Antiguedad Días</label>
                            {!! Form::text('antiguedad_dias',null,['class'=>'form-control','id'=>'antiguedad_dias','placeholder'=>'Días']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="correo">Correo Empresarial *</label>
                            {!! Form::text('correo',null,['class'=>'form-control','id'=>'correo','placeholder'=>'Correo Empresarial','required']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="correo_personal">Correo Personal</label>
                            {!! Form::text('correo_personal',null,['class'=>'form-control','id'=>'correo_personal','placeholder'=>'Correo Personal']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="telefono_movil">Teléfono Móvil</label>
                            {!! Form::text('telefono_movil',null,['class'=>'form-control','id'=>'telefono_movil','placeholder'=>'Teléfono Móvil']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="telefono_fijo">Teléfono Fijo</label>
                            {!! Form::text('telefono_fijo',null,['class'=>'form-control','id'=>'telefono_fijo','placeholder'=>'Teléfono Fijo']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="compania">Compañia</label>
                            {!! Form::text('compania',null,['class'=>'form-control','id'=>'compania','placeholder'=>'Compañia']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="unidad_estrategica">División / Unidad Estratégica</label>
                            {!! Form::text('unidad_estrategica',null,['class'=>'form-control','id'=>'unidad_estrategica','placeholder'=>'División / Unidad Estratégica']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="unidad_corporativa" class="col-form-label">Vicepresidencia / Gerencia / Dirección *</label>
                            {!! Form::select('unidad_corporativa',$Vp,null,['class'=>'js-example-basic-single form-control','id'=>'unidad_corporativa','style'=>'width: 100%;','required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="area" class="col-form-label">Área / Equipo*</label>
                            {!! Form::select('area',$Areas,null,['class'=>'js-example-basic-single form-control','id'=>'area','style'=>'width: 100%;','required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="unidad_organizativa" class="col-form-label">Unidad Organizativa</label>
                            {!! Form::select('unidad_organizativa',$EE,null,['class'=>'js-example-basic-single form-control','id'=>'unidad_organizativa','style'=>'width: 100%;']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="nivel_jerarquico" class="col-form-label">Nivel Jerárquico</label>
                            {!! Form::select('nivel_jerarquico',$NivelJ,null,['class'=>'form-control','id'=>'nivel_jerarquico','style'=>'width: 100%;']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="cargo" class="col-form-label">Cargo</label>
                            {!! Form::select('cargo',$Cargos,null,['class'=>'form-control js-example-basic-single','id'=>'cargo','style'=>'width: 100%;']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="posicion" class="col-form-label">Posiciones</label>
                            {!! Form::select('posicion',$Posiciones,null,['class'=>'form-control js-example-basic-single','id'=>'posicion','style'=>'width: 100%;']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="password">Contraseña</label>
                            {!! Form::text('password',null,['class'=>'form-control','id'=>'password','placeholder'=>'Contraseña']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                    <div class="col-md-2">
                        <label for="estado" class="col-form-label">Estado *</label>
                        {!! Form::select('estado',$Estado,null,['class'=>'form-control','id'=>'estado','style'=>'width: 100%;','required']) !!}
                    </div>
                    <div class="col-md-2">
                        <label for="rol" class="col-form-label">Rol *</label>
                        {!! Form::select('rol',$Roles,null,['class'=>'form-control','id'=>'rol','style'=>'width: 100%;','required']) !!}
                    </div>
                    <div class="col-md-8">
                        <label for="foto" class="col-form-label">Foto</label>
                        <input type="file" name="foto" id="foto" accept=".jpg,.png" required class="form-control" size="2048" required>
                        <div align="right"><small class="text-muted">Tamaño maximo en total permitido (2MB), si se supera este tamaño, su archivo no será cargado. Solo se permite formato jpg y png.</small><span id="cntDescripHechos" align="right"> </span></div>
                        <span id="field2_area" hidden><input type="file" id="foto1" name="foto1" class="form-control" /></span>
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