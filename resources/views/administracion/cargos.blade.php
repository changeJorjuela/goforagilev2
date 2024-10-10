@extends("layout")

@section('styles')

@endsection

@section('titulo')
Cargos
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
                    <h4>Cargos</h4>
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
                        <button type="button" class="btn btn-agile btn-rounded" data-toggle="modal" data-target="#cargo_new" data-whatever="@mdo"><i class="icon-plus"></i>&nbsp;&nbsp;Crear Cargo</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table border="0" id="cargos" class="display table m-0" style="width:100%;">
                    <thead class="thead-success">
                        <tr>
                            <th scope="col" width="15">Nro.</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Área</th>
                            <th scope="col" width="100">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Cargos as $value)
                        <tr>
                            <td>{{$value['cont']}}</td>
                            <td>{{$value['nombre_cargo']}}</td>
                            <td>{{$value['nivel_jerarquico']}}</td>
                            <td><span class="{{$value['label']}}" id="estadoLabel"><b>{{$value['estado']}}</b></span></td>
                            <td><a href="#" class="btn btn-warning" title="Editar" data-toggle="modal" data-target="#cargo_upd" onclick="obtener_datos_cargo('{{$value['id']}}');" id="tableEditButton"><i class="icon-pencil2"></i></a></td>
                            <input type="hidden" value="{{$value['id']}}" id="id{{$value['id']}}">
                            <input type="hidden" value="{{$value['nombre_cargo']}}" id="nombre_cargo{{$value['id']}}">
                            <input type="hidden" value="{{$value['nivel_jerarquico']}}" id="nivel_jerarquico{{$value['id']}}">
                            <input type="hidden" value="{{$value['id_area']}}" id="id_area{{$value['id']}}">
                            <input type="hidden" value="{{$value['id_empresa']}}" id="id_empresa{{$value['id']}}">
                            <input type="hidden" value="{{$value['estado_activo']}}" id="estado_activo{{$value['id']}}">
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@include("modals.modalCargos")
@section('scripts')

<script>
    $(document).ready(function() {
        $("#lateralAdmin").addClass("active selected");
        $("#navAdmin").addClass("in");
        $("#menuCargos").addClass("current-page");
        $('.js-example-basic-single').select2();
    });
</script>
<script>
        @if (session("mensaje"))
            toastr.success("{{ session("mensaje") }}");
        @endif

        @if (session("precaucion"))
            toastr.warning("{{ session("precaucion") }}");
        @endif

        @if (count($errors) > 0)
            @foreach($errors -> all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
@endsection