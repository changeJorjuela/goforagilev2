@extends("layout")

@push('styles')

@endpush

@section('titulo')
Áreas
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
                    <h4>Áreas</h4>
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
                        <button type="button" class="btn btn-agile btn-rounded" data-toggle="modal" data-target="#area_new" data-whatever="@mdo"><i class="icon-plus"></i>&nbsp;&nbsp;Crear Área</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table border="0" id="areas" class="display table m-0" style="width:100%;">
                    <thead class="thead-success">
                        <tr>
                            <th scope="col" width="15">Nro.</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Estado</th>
                            <th scope="col" width="100">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Areas as $value)
                        <tr>
                            <td>{{$value['cont']}}</td>
                            <td>{{$value['nombre_area']}}</td>
                            <td><span class="{{$value['label']}}" id="estadoLabel"><b>{{$value['estado']}}</b></span></td>
                            <td><a href="#" class="btn btn-warning" title="Editar" data-toggle="modal" data-target="#area_upd" onclick="obtener_datos_area('{{$value['id']}}');" id="tableEditButton"><i class="icon-pencil2"></i></a></td>
                            <input type="hidden" value="{{$value['id']}}" id="id{{$value['id']}}">
                            <input type="hidden" value="{{$value['nombre_area']}}" id="nombre_area{{$value['id']}}">
                            <input type="hidden" value="{{$value['padre']}}" id="padre{{$value['id']}}">
                            <input type="hidden" value="{{$value['jerarquia']}}" id="jerarquia{{$value['id']}}">
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
@include("modals.modalAreas")
@push('scripts')

<script>
    $(document).ready(function() {
        $("#lateralAdmin").addClass("active selected");
        $("#navAdmin").addClass("in");
        $("#menuAreas").addClass("current-page");
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
@endpush