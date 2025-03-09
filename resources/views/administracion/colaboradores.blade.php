@extends("layout")

@push('styles')

@endpush

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
                        <a href="detalleColaborador" class="btn btn-agile btn-rounded"><i class="icon-plus"></i>&nbsp;&nbsp;Crear Colaborador</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table border="0" id="colaboradores" class="display table m-0" style="width:100%;">
                    <thead class="thead-success">
                        <tr>
                            <th scope="col">Documento</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nombre Completo</th>
                            <th scope="col">Correo</th>
                            <th scope="col">{!! Session::get('EtiquetaAdminCArgos') !!}</th>
                            <th scope="col">{!! Session::get('EtiquetaAdminVicepresidencia') !!}</th>
                            <th scope="col">{!! Session::get('EtiquetaAdminArea') !!}</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Verificación</th>
                            <th scope="col" width="100">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Colaboradores as $value)
                        <tr>
                            <td>{{$value['documento']}}</td>
                            <td>{!!$value['foto_tabla']!!}</td>
                            <td>{{$value['nombre']}}</td>
                            <td>{{$value['correo']}}</td>
                            <td>{{$value['nombre_cargo']}}</td>
                            <td>{{$value['nombre_vp']}}</td>
                            <td>{{$value['nombre_area']}}</td>
                            <td>{{$value['nombre_rol']}}</td>
                            <td><span class="{{$value['label']}}" id="estadoLabel"><b>{{$value['estado']}}</b></span></td>
                            <td><span class="{{$value['label_verificar']}}" id="estadoLabel"><b>{{$value['verificar']}}</b></span></td>
                            <td><a href="detalleColaborador?colaborador={{$value['id']}}" class="btn btn-warning" title="Editar" id="tableEditButton"><i class="icon-pencil2"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $("#lateralAdmin").addClass("active selected");
        $("#navAdmin").addClass("in");
        $("#menuColaboradores").addClass("current-page");
        $('.js-example-basic-single').select2();
    });
</script>
<script>
    @if(session("mensaje"))
    toastr.success("{{ session("mensaje ") }}");
    @endif

    @if(session("precaucion"))
    toastr.warning("{{ session("precaucion ") }}");
    @endif

    @if(count($errors) > 0)
    @foreach($errors -> all() as $error)
    toastr.error("{{ $error }}");
    @endforeach
    @endif
</script>
@endpush