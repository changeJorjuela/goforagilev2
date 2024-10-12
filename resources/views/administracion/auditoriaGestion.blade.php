@extends("layout")

@section('styles')

@endsection

@section('titulo')
Auditoria Gestión GFA
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
                    <h4>Reporte Auditoria Gestión Go For Agile</h4>
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
            
            <div class="card-body">
                <table border="0" id="auditoria" class="display table m-0" style="width:100%;">
                    <thead class="thead-success">
                        <tr>
                            <th scope="col" width="15">Nro.</th>
                            <th scope="col">Realizado Por</th>
                            @if(Session::get('id_empresa') == 1)
                            <th scope="col">Vicepresidencia</th>
                            @endif
                            <th scope="col">Área</th>
                            <th scope="col">Acción</th>
                            <th scope="col">Descripción de la Acción</th>
                            <th scope="col">Módulo</th>
                            <th scope="col">Fecha</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Auditoria as $value)
                        <tr>
                            <td>{{$value['cont']}}</td>
                            <td>{{$value['usuario']}}</td>
                            @if(Session::get('id_empresa') == 1)
                            <td>{{$value['vp']}}</td>
                            @endif
                            <td>{{$value['area']}}</td>
                            <td><span class="text-{{$value['label']}}" id="estadoLabel"><b>{{$value['accion']}}</b></span></td>
                            <td>{{$value['descripcion']}}</td>
                            <td>{{$value['modulo']}}</td>
                            <td>{{$value['fecha']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $("#lateralAdmin").addClass("active selected");
        $("#navAdmin").addClass("in");
        $("#menuAuditoriaGFA").addClass("current-page");
        $('.js-example-basic-single').select2();
    });
</script>

@endsection