{!! Form::open(['url' => 'administrador/okrsOrganizacion', 'method' => 'get', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'formulario_filtro']) !!}
@csrf
<div class="form-group">
    <div class="row">

        @if(Session::get('id_empresa') == 1)
        <div class="col-md-4">
            {!! Form::select('vicepresidencia_fill',$VicepresidenciasFiltro,Session::get('vicepresidencia_fill'),['class'=>'form-control','id'=>'vicepresidencia_fill']) !!}
        </div>
        @endif
        <div class="col-md-4">
            {!! Form::select('areas_fill',$AreasFiltro,Session::get('areas_fill'),['class'=>'form-control','id'=>'areas_fill']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::select('responsable_fill',$ResponsablesFiltro,Session::get('responsable_fill'),['class'=>'form-control','id'=>'responsable_fill']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::select('objestrategico_fill',$ObjEstrategicoFiltro,Session::get('objestrategico_fill'),['class'=>'form-control','id'=>'objestrategico_fill']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::select('okr_fill',$OkrsFiltro,Session::get('okr_fill'),['class'=>'form-control','id'=>'okr_fill']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::select('tipo_okr_fill',$TipoOkrFiltro,Session::get('tipo_okr_fill'),['class'=>'form-control','id'=>'tipo_okr_fill']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::select('anio_fill',$AnioOkrFiltro,Session::get('anio_fill'),['class'=>'form-control','id'=>'anio_fill']) !!}
        </div>
        <div class="col-md-1 col-sm-2" style="align-content: center;">
            Periodo:
        </div>
        <div class="col-md-1 col-sm-2" style="align-content: center;">
            <input type="checkbox" name="Q1" id="Q1" value="on" class="form-control-input" {{ Session::get('Q1') == 'on' ? 'checked' : '' }}>&nbsp;Q1
        </div>
        <div class="col-md-1 col-sm-2" style="align-content: center;">
            <input type="checkbox" name="Q2" id="Q2" value="on" class="form-control-input" {{ Session::get('Q2') == 'on' ? 'checked' : '' }}>&nbsp;Q2
        </div>
        <div class="col-md-1 col-sm-2" style="align-content: center;">
            <input type="checkbox" name="Q3" id="Q3" value="on" class="form-control-input" {{ Session::get('Q3') == 'on' ? 'checked' : '' }}>&nbsp;Q3
        </div>
        <div class="col-md-1 col-sm-2" style="align-content: center;">
            <input type="checkbox" name="Q4" id="Q4" value="on" class="form-control-input" {{ Session::get('Q4') == 'on' ? 'checked' : '' }}>&nbsp;Q4
        </div>
        <div class="col-md-1 col-sm-2" style="align-content: center;">
            <input type="checkbox" name="Anual" id="Anual" value="on" class="form-control-input" {{ Session::get('Anual') == 'on' ? 'checked' : '' }}>&nbsp;Anual
        </div>
    </div>
    <div class="row" style="text-align: right;">
        <div class="col-md-12" style="align-content: center;">
            <button type="button" class="btn btn-primary mb-2" id="LimpiarFiltro" onClick="LimpiarFormulario()"><span class="icon-loop2"></span>&nbsp;Limpiar filtros</button>        
            <button type="submmit" class="btn btn-success mb-2"><span class="icon-search"></span>&nbsp;Filtrar</button>
        </div>
    </div>
</div>
{!! Form::close() !!}