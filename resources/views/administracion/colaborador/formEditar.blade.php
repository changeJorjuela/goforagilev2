<div class="row">
    <div class="col-md-12">
        {!! Form::open(['url' => 'crearArea', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'form-area_new']) !!}
        @csrf
        <input type="hidden" name="id_empresa" id="id_empresa" value="{{ Session::get('id_empresa') }}">
        <input type="hidden" name="id_area" id="id_area" value="{{ Session::get('id_area') }}">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-2">
                    <label for="documento">Código Colaborador / Documento *</label>
                    {!! Form::text('documento',$documento,['class'=>'form-control','id'=>'documento','placeholder'=>'Código / Documento','required']) !!}
                </div>
                <div class="col-sm-2">
                    <label for="nombre">Nombre *</label>
                    {!! Form::text('nombre',$nombre,['class'=>'form-control','id'=>'nombre','placeholder'=>'Nombre Colaborador','required']) !!}
                </div>
                <div class="col-sm-2">
                    <label for="genero">Genero</label>
                    {!! Form::select('genero',$Genero,$genero,['class'=>'form-control','id'=>'genero']) !!}
                </div>
                <div class="col-sm-2">
                    <label for="fecha_ingreso">Fecha Ingreso Empresa</label>
                    {!! Form::date('fecha_ingreso',$fechaIngreso,['class'=>'form-control','id'=>'fecha_ingreso','onchange'=>'calcularAntiguedad()']) !!}
                </div>
                <div class="col-sm-2">
                    <label for="antiguedad">Antiguedad en Empresa</label>
                    {!! Form::text('antiguedad',$antiguedad,['class'=>'form-control','id'=>'antiguedad','placeholder'=>'Antiguedad Colaborador','reeadonly']) !!}
                </div>
                <div class="col-sm-2">
                    <label for="correo">Correo Empresarial *</label>
                    {!! Form::text('correo',$correo,['class'=>'form-control','id'=>'correo','placeholder'=>'Correo Empresarial','required']) !!}
                </div>
                {!! Form::hidden('antiguedad_anios',$antiguedadAnios,['class'=>'form-control','id'=>'antiguedad_anios']) !!}
                {!! Form::hidden('antiguedad_meses',$antiguedadMeses,['class'=>'form-control','id'=>'antiguedad_meses']) !!}
                {!! Form::hidden('antiguedad_dias',$antiguedadDias,['class'=>'form-control','id'=>'antiguedad_dias']) !!}
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2">
                        <label for="telefono_movil">Teléfono Móvil</label>
                        {!! Form::text('telefono_movil',$telefonoMovil,['class'=>'form-control','id'=>'telefono_movil','placeholder'=>'Teléfono Móvil']) !!}
                    </div>
                    <div class="col-md-2">
                        <label for="telefono_fijo">Teléfono Fijo</label>
                        {!! Form::text('telefono_fijo',$telefonoFijo,['class'=>'form-control','id'=>'telefono_fijo','placeholder'=>'Teléfono Fijo']) !!}
                    </div>
                    <div class="col-md-2">
                        <label for="compania">Compañia *</label>
                        {!! Form::text('compania',$unidadEstrategica,['class'=>'form-control','id'=>'compania','placeholder'=>'Compañia']) !!}
                    </div>
                    <div class="col-md-2">
                        <label for="unidad_estrategica">División / Unidad Estratégica</label>
                        {!! Form::text('unidad_estrategica',$unidadEstrategica,['class'=>'form-control','id'=>'unidad_estrategica','placeholder'=>'División / Unidad Estratégica']) !!}
                    </div>
                    <div class="col-md-2">
                        <label for="id_cargo">Cargo</label>
                        {!! Form::select('id_cargo',$Cargos,$cargo,['class'=>'form-control multiples_responsables','id'=>'id_cargo','style'=>'width: 100%']) !!}
                    </div>
                    <div class="col-md-2">
                        <label for="id_posicion">Posiciones</label>
                        {!! Form::select('id_posicion',$Posiciones,$posicion,['class'=>'form-control multiples_responsables','id'=>'id_posicion','style'=>'width: 100%']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="unidad_corporativa">Vicepresidencia</label>
                        {!! Form::select('unidad_corporativa',$Vicepresidencias,$vicepresidencia,['class'=>'form-control multiples_responsables','id'=>'unidad_corporativa','style'=>'width: 100%','onchange'=>'select_vicepresidencia(this);']) !!}
                    </div>
                    <div class="col-md-4">
                        <label for="area">Aréa</label>
                        {!! Form::select('area',$Areas,$area,['class'=>'form-control multiples_responsables','id'=>'area','style'=>'width: 100%','onchange'=>'select_area(this);']) !!}
                    </div>
                    <div class="col-md-4">
                    <label for="unidad_organizativa">Unidad Organizativa</label>
                        {!! Form::select('unidad_organizativa',$UnidadOrganizativa,$unidad_organizativa,['class'=>'form-control multiples_responsables','id'=>'unidad_organizativa','style'=>'width: 100%;']) !!}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<script>
    function calcularAntiguedad() {
        const fechaInput = document.getElementById('fecha_ingreso').value;
        const fechaSeleccionada = new Date(fechaInput + 'T00:00:00');
        const fechaActual = new Date();
        const fechaBaseUTC = new Date(fechaActual.toISOString());

        // Asegurarse de que la fecha seleccionada no esté en el futuro
        if (fechaSeleccionada > fechaBaseUTC) {
            alert("La fecha seleccionada no puede ser futura.");
            return;
        }

        let anios = fechaBaseUTC.getFullYear() - fechaSeleccionada.getFullYear();
        let meses = fechaBaseUTC.getMonth() - fechaSeleccionada.getMonth();
        let dias = fechaBaseUTC.getDate() - fechaSeleccionada.getDate();

        if (meses < 0) {
            anios--;
            meses += 12;
        }

        if (dias < 0) {
            meses--;
            const ultimoDiaDelMes = new Date(fechaBaseUTC.getFullYear(), fechaBaseUTC.getMonth(), 0).getDate();
            dias += ultimoDiaDelMes;
        } else {
            if (dias == 0) {
                dias = 0;
            }
        }

        document.getElementById('antiguedad').value = `${anios} años / ${meses} meses / ${dias} días`;

        document.getElementById('antiguedad_anios').value = anios;
        document.getElementById('antiguedad_meses').value = meses;
        document.getElementById('antiguedad_dias').value = dias;
    }

    function calcularFecha() {
        const anios = parseInt(document.getElementById('antiguedad_anios').value) || 0;
        const meses = parseInt(document.getElementById('antiguedad_meses').value) || 0;
        const dias = parseInt(document.getElementById('antiguedad_dias').value) || 0;

        if (anios === 0 && meses === 0 && dias === 0) {
            document.getElementById('fecha_ingreso').value = '{{ $fechaIngreso }}';
            return;
        }

        const fechaBase = new Date();
        const fechaBaseUTC = new Date(fechaBase.toISOString());

        fechaBaseUTC.setFullYear(fechaBaseUTC.getFullYear() - anios);
        fechaBaseUTC.setMonth(fechaBaseUTC.getMonth() - meses);

        const diaBase = fechaBaseUTC.getDate();

        let diasRestados = dias;
        if (dias > diaBase) {
            diasRestados = dias - 1;
        }

        fechaBaseUTC.setDate(fechaBaseUTC.getDate() - diasRestados);

        const diaCalculado = fechaBaseUTC.getDate();
        console.log(fechaBaseUTC);

        if (fechaBaseUTC.getDate() !== diaCalculado) {
            const ultimoDiaDelMes = new Date(fechaBaseUTC.getFullYear(), fechaBaseUTC.getMonth(), 0).getDate();
            fechaBaseUTC.setDate(ultimoDiaDelMes);
        }

        const dia = fechaBaseUTC.getDate().toString().padStart(2, '0');
        const mes = (fechaBaseUTC.getMonth() + 1).toString().padStart(2, '0');
        const anio = fechaBaseUTC.getFullYear();

        const fechaCalculada = `${anio}-${mes}-${dia}`;

        document.getElementById('fecha_ingreso').value = fechaCalculada;
    }

    window.onload = calcularFecha;
</script>