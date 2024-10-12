@extends("layout")

@section('styles')

@endsection

@section('titulo')
Colaboradores
@endsection

@section('headerPage')
<header class="main-heading">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-icon">
                    <i class="icon-network"></i>
                </div>
                <div class="page-title">
                    <h4>Colaboradores</h4>
                </div>
            </div>

        </div>
    </div>
</header>
@endsection

@section('contenido')
<div class="row guttes">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header" id="header-page">
                <div class="col-sm-12">
                    <div class="right-actions">
                        @if(Session::get('id_empresa') == 1)
                        <button type="button" class="btn btn-agile btn-rounded" data-toggle="modal" data-target="#colaboradorPc_new" data-whatever="@mdo"><i class="icon-plus"></i>&nbsp;&nbsp;Crear Colaborador</button>
                        @else
                        <button type="button" class="btn btn-agile btn-rounded" data-toggle="modal" data-target="#colaborador_new" data-whatever="@mdo"><i class="icon-plus"></i>&nbsp;&nbsp;Crear Colaborador</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table border="0" id="colaboradores" class="display table m-0" style="width:100%;">
                    <thead class="thead-success">
                        <tr>
                            <th scope="col" width="15">Nro.</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nombre Completo</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Cargo</th>
                            @if(Session::get('id_empresa') == 1)
                            <th scope="col">Vicepresidencia</th>
                            @endif
                            <th scope="col">Área</th>
                            <th scope="col">Compañia</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Estado</th>
                            <th scope="col" width="100">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Colaboradores as $value)
                        <tr>
                            <td>{{$value['cont']}}</td>
                            <td>{{$value['documento']}}</td>
                            <td>{!!$value['foto_tabla']!!}</td>
                            <td>{{$value['nombre']}}</td>
                            <td>{{$value['correo']}}</td>
                            <td>{{$value['nombre_cargo']}}</td>
                            @if(Session::get('id_empresa') == 1)
                            <td>{{$value['nombre_vp']}}</td>
                            @endif
                            <td>{{$value['nombre_area']}}</td>
                            <td>{{$value['compania']}}</td>
                            <td>{{$value['nombre_rol']}}</td>
                            <td><span class="{{$value['label']}}" id="estadoLabel"><b>{{$value['estado']}}</b></span></td>
                            @if(Session::get('id_empresa') == 1)
                            <td><a href="#" class="btn btn-warning" title="Editar" data-toggle="modal" data-target="#colaboradorPc_upd" onclick="obtener_datos_colaborador ('{{$value['id']}}');" id="tableEditButton"><i class="icon-pencil2"></i></a></td>
                            @else
                            <td><a href="#" class="btn btn-warning" title="Editar" data-toggle="modal" data-target="#colaborador_upd" onclick="obtener_datos_colaborador ('{{$value['id']}}');" id="tableEditButton"><i class="icon-pencil2"></i></a></td>
                            @endif
                            <input type="hidden" value="{{$value['id']}}" id="id{{$value['id']}}">
                            <input type="hidden" value="{{$value['id_area']}}" id="id_area{{$value['id']}}">
                            <input type="hidden" value="{{$value['id_vp']}}" id="id_vp{{$value['id']}}">
                            <input type="hidden" value="{{$value['id_cargo']}}" id="id_cargo{{$value['id']}}">
                            <input type="hidden" value="{{$value['unidad_organizativa']}}" id="unidad_organizativa{{$value['id']}}">
                            <input type="hidden" value="{{$value['nivel_jerarquico']}}" id="nivel_jerarquico{{$value['id']}}">
                            <input type="hidden" value="{{$value['id_posicion']}}" id="id_posicion{{$value['id']}}">
                            <input type="hidden" value="{{$value['id_rol']}}" id="id_rol{{$value['id']}}">
                            <input type="hidden" value="{{$value['nombre']}}" id="nombre{{$value['id']}}">
                            <input type="hidden" value="{{$value['documento']}}" id="documento{{$value['id']}}">
                            <input type="hidden" value="{{$value['correo']}}" id="correo{{$value['id']}}">
                            <input type="hidden" value="{{$value['correo_personal']}}" id="correo_personal{{$value['id']}}">
                            <input type="hidden" value="{{$value['genero']}}" id="genero{{$value['id']}}">
                            <input type="hidden" value="{{$value['antiguedad_anios']}}" id="antiguedad_anios{{$value['id']}}">
                            <input type="hidden" value="{{$value['antiguedad_meses']}}" id="antiguedad_meses{{$value['id']}}">
                            <input type="hidden" value="{{$value['antiguedad_dias']}}" id="antiguedad_dias{{$value['id']}}">
                            <input type="hidden" value="{{$value['telefono_movil']}}" id="telefono_movil{{$value['id']}}">
                            <input type="hidden" value="{{$value['telefono_fijo']}}" id="telefono_fijo{{$value['id']}}">
                            <input type="hidden" value="{{$value['compania']}}" id="compania{{$value['id']}}">
                            <input type="hidden" value="{{$value['unidad_estrategica']}}" id="unidad_estrategica{{$value['id']}}">
                            <input type="hidden" value="{{$value['password']}}" id="password{{$value['id']}}">
                            <input type="hidden" value="{{$value['foto']}}" id="foto{{$value['id']}}">

                            <input type="hidden" value="{{$value['estado_activo']}}" id="estado_activo{{$value['id']}}">
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@if(Session::get('id_empresa') == 1)
@include("modals.modalColaboradoresPC")
@else
@include("modals.modalColaboradores")
@endif
@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $("#lateralAdmin").addClass("active selected");
        $("#navAdmin").addClass("in");
        $("#menuColaboradores").addClass("current-page");
        $('.js-example-basic-single').select2();
    });

    @if(session("mensaje"))
    toastr.success("{{ session("mensaje") }}");
    @endif

    @if(session("precaucion"))
    toastr.warning("{{ session("precaucion") }}");
    @endif

    @if(count($errors) > 0)
    @foreach($errors - > all() as $error)
    toastr.error("{{ $error }}");
    @endforeach
    @endif
</script>
@endsection