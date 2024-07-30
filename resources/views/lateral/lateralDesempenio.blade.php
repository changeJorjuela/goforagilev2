<li>
    <a href="#" class="has-arrow" aria-expanded="false">
        <span class="has-icon">
            <i class="icon-line-graph"></i>
        </span>
        <span class="nav-title">KPI</span>
    </a>
    <ul aria-expanded="false">
        <li>
            <a href="valoracion/realizar_valoracion">Consolidados Individual</a>
        </li>
        <li>
            <a href="valoracion/competencias/competencias">Mis Objetivos {{ Session::get('anio_fill') }}</a>
        </li>
        <li>
            <a href="valoracion/perfiles">Mi Seguimiento {{ Session::get('anio_fill') }}</a>
        </li>
        @if(Session::get('id_rol') === 1)
        <li>
            <a href="valoracion/programacion">Autorizaciones</a>
        </li>
        <li>
            <a href="valoracion/arbol">Indicadores</a>
        </li>
        @endif
        @if((Session::get('id_rol') === 1) || (Session::get('id_rol') === 2))
        <li>
            <a href="valoracion/seguimiento">Autorizaciones Equipo</a>
        </li>
        <li>
            <a href="valoracion/informes/individuales">Seguimiento Equipo</a>
        </li>
        @endif
        @if(Session::get('id_rol') === 1)
        <li>
            <a href="valoracion/mi_informe">Cierres</a>
        </li>
        <li>
            <a href="valoracion/mi_perfil">Consolidados</a>
        </li>
        <li>
            <a href="valoracion/historicos">Seguimiento Avance</a>
        </li>
        <li>
            <a href="valoracion/historicos">Seguimiento Individual</a>
        </li>
        @endif
        @if(Session::get('id_rol') === 2)
        <li>
            <a href="valoracion/historicos">Cierres Equipos</a>
        </li>
        <li>
            <a href="valoracion/historicos">Consolidados Equipos</a>
        </li>
        <li>
            <a href="valoracion/historicos">Informes Equipo</a>
        </li>
        @endif
        @if(Session::get('id_rol') === 1)
        <li>
            <a href="valoracion/historicos">Informes</a>
        </li>
        @endif        
    </ul>
</li>