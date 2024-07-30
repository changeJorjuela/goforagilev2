<li>
    <a href="#" class="has-arrow" aria-expanded="false">
        <span class="has-icon">
            <i class="icon-open-book"></i>
        </span>
        <span class="nav-title">Lecciones Aprendidas</span>
    </a>
    <ul aria-expanded="false">
        @if((Session::get('id_rol') === 1) || (Session::get('id_rol') === 2))
        <li>
            <a href="valoracion/realizar_valoracion">Crear Lección</a>
        </li>
        @endif
        <li>
            <a href="valoracion/realizar_valoracion">Visualización Lecciones Aprendidas</a>
        </li>
    </ul>
</li>