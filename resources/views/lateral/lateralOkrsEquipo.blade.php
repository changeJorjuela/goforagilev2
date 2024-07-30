<li>
    <a href="#" class="has-arrow" aria-expanded="false">
        <span class="has-icon">
            <i class="icon-pie-chart2"></i>
        </span>
        <span class="nav-title">Reportes</span>
    </a>
    <ul aria-expanded="false">
        @if(Session::get('id_rol') === 1)
        <li>
            <a href='general-elements.html'>Consolidado General</a>
        </li>
        <li>
            <a href='general-elements.html'>Consolidado Equipo</a>
        </li>
        <li>
            <a href='general-elements.html'>Consolidado por Áreas</a>
        </li>
        <li>
            <a href='general-elements.html'>Reporte Individual</a>
        </li>
        @endif
        @if(Session::get('id_rol') === 2)
        <li>
            <a href='general-elements.html'>Consolidado Equipo</a>
        </li>
        <li>
            <a href='general-elements.html'>Consolidado por Áreas</a>
        </li>
        <li>
            <a href='general-elements.html'>Reporte Individual</a>
        </li>
        @endif
        @if(Session::get('id_rol') === 3)
        <li>
            <a href='general-elements.html'>Reporte Individual</a>
        </li>
        @endif
    </ul>
</li>

<li>
    <a href="#" class="has-arrow" aria-expanded="false">
        <span class="has-icon">
            <i class="icon-stats-bars"></i>
        </span>
        <span class="nav-title">Visualizaciones</span>
    </a>
    <ul aria-expanded="false">
        <li>
            <a href='general-elements.html'>Derivación de OKR's</a>
        </li>
        <li>
            <a href='buttons.html'>Tabla General OKR's</a>
        </li>
        <li>
            <a href='tabs.html'>Mapas de Calor</a>
        </li>
        <li>
            <a href="modals.html">Timeline</a>
        </li>
    </ul>
</li>

<li id="laretalOkrsEquipo">
    <a href="#" class="has-arrow" aria-expanded="false">
        <span class="has-icon">
            <i class="icon-shareable"></i>
        </span>
        <span class="nav-title">OKR's</span>
    </a>
    <ul aria-expanded="false" id="navOkrs">
        <li>
            <a href='general-elements.html'>Crear OKR's</a>
        </li>
        <li>
            <a href='buttons.html'>Gestionar Mis OKR's</a>
        </li>
        <li>
            <a href='tabs.html'>Gestionar Mis Resultados</a>
        </li>
        <li>
            <a href="modals.html">Gestionar Mis Iniciativas</a>
        </li>
        <li>
            <a href="okrsOrganizacion" id="menuOkrsOrganizacion">Todos los OKR's</a>
        </li>
    </ul>
</li>