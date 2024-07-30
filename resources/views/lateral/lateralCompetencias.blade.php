<li>
    <a href="#" class="has-arrow" aria-expanded="false">
        <span class="has-icon">
            <i class="icon-users"></i>
        </span>
        <span class="nav-title">Competencias</span>
    </a>
    <ul aria-expanded="false">

        @if(Session::get('id_rol') === 1)
        <li>
            <a href="valoracion/realizar_valoracion">Realizar Valoración</a>
        </li>
        <li>
            <a href="valoracion/competencias/competencias">Competencias</a>
        </li>
        <li>
            <a href="valoracion/perfiles">Perfiles</a>
        </li>
        <li>
            <a href="valoracion/programacion">Programación</a>
        </li>
        <li>
            <a href="valoracion/arbol">Arbol Valoración</a>
        </li>
        <li>
            <a href="valoracion/seguimiento">Seguimiento</a>
        </li>
        <li>
            <a href="valoracion/informes/individuales">Informes</a>
        </li>
        @endif
        @if((Session::get('id_rol') === 2) || (Session::get('id_rol') === 3))
        <li>
            <a href="valoracion/mi_informe">Informes</a>
        </li>

        <li>
            <a href="valoracion/mi_perfil">Perfiles</a>
        </li>
        @endif
        @if((Session::get('id_rol') === 1) || (Session::get('id_empresa') === 6))
        <li>
            <a href="valoracion/historicos">Historial</a>
        </li>
        @endif
    </ul>
</li>