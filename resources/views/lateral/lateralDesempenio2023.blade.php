<li>
    <a href="#" class="has-arrow" aria-expanded="false">
        <span class="has-icon">
            <i class="icon-stats-bars2"></i>
        </span>
        <span class="nav-title">Desempeño 2023 - 2024</span>
    </a>
    <ul aria-expanded="false">
    @if((Session::get('id_rol') === 1) || (Session::get('id_rol') === 2))
        <li>
            <a href='general-elements.html'>Consolidado Desempeño</a>
        </li>
        <li>
            <a href='buttons.html'>Consolidado Competencias</a>
        </li>
        <li>
            <a href='tabs.html'>Consolidado OKR's</a>
        </l<li>
            <a href="modals.html">Mi Desempeño</a>
        </li>
        @else
        <li>
            <a href="modals.html">Mi Desempeño</a>
        </li>
        @endif
    </ul>
</li>