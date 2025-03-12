<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['url' => 'asignarLider', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'form-area_new']) !!}
                @csrf
                <input type="hidden" name="id_colaborador" id="id_colaborador" value="{{ $idColaborador }}">
                <input type="hidden" name="id_empresa" id="id_empresa" value="{{ Session::get('id_empresa') }}">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="lider" class="col-form-label">Lider a asignar</label>
                            {!! Form::select('lider',$LideresEmpresa,null,['class'=>'form-control multiples_responsables','id'=>'lider','style'=>'width: 100%;']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12" style="text-align: end;">
                            <button type="submit" class="btn btn-agile btn-sm btn-rounded">Asignar</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <table border="0" id="liderColaborador" class="display table m-0" style="width:100%;">
                    <thead class="thead-success">
                        <tr>
                            <th scope="col">Documento</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nombre Completo</th>
                            <th scope="col">{!! Session::get('EtiquetaAdminVicepresidencia') !!}</th>
                            <th scope="col">{!! Session::get('EtiquetaAdminArea') !!}</th>
                            <th scope="col">{!! Session::get('EtiquetaAdminUnidadOrganizativa') !!}</th>
                            <th scope="col">{!! Session::get('EtiquetaAdminCargos') !!}</th>
                            <th scope="col" width="100">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Lideres as $value)
                        <tr>
                            <td>{{$value['documento']}}</td>
                            <td>{!!$value['foto_tabla']!!}</td>
                            <td>{{$value['nombre']}}</td>
                            <td>{{$value['nombre_vp']}}</td>
                            <td>{{$value['nombre_area']}}</td>
                            <td>{{$value['nombre_unidad_organizativa']}}</td>
                            <td>{{$value['nombre_cargo']}}</td>
                            <td><a href="#" class="btn btn-danger btn-rounded" title="Eliminar" onClick="EliminarLider({{$value['id']}},{!! Session::get('id_user') !!},{{$value['id_empleado']}})" id="tableDeleteButton"><i class="icon-trash"></i></a></td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>