<header class="app-header">
    <div class="container-fluid">
        <div class="row gutters">
            <div class="col-md-5 col-sm-3 col-4">
                <a class="mini-nav-btn" href="#" id="app-side-mini-toggler">
                    <i class="icon-menu5"></i>
                </a>
                <a href="#app-side" data-toggle="onoffcanvas" class="onoffcanvas-toggler" aria-expanded="true">
                    <i class="icon-chevron-thin-left"></i>
                </a>
            </div>
            <div class="col-md-2 col-sm-6 col-4">
                <a href="home" class="logo">
                    {!! Session::get('FotoEmpresa') !!}
                </a>
            </div>
            <div class="col-md-5 col-sm-3 col-4">
                <ul class="header-actions">
                    <li id="textRol">
                        <a href="" id="todos" data-toggle="dropdown" aria-haspopup="true">
                            <h5 id="HeaderRol"><b>{!! Session::get('NombreRol') !!}</b></h5>
                        </a>
                        @if(Session::get('role_plataforma') === 1)
                        <div class="dropdown-menu dropdown-menu-right lg" aria-labelledby="todos">
                            <ul class="stats-widget">
                                <div class="logout-btn">
                                    <a href="../lider/home" class="btn btn-primary">LÍDER DE EQUIPO</a>
                                </div>
                            </ul>
                        </div>
                        @elseif(Session::get('role_plataforma') === 2)
                        <div class="dropdown-menu dropdown-menu-right lg" aria-labelledby="todos">
                            <ul class="stats-widget">
                                <div class="logout-btn">
                                    <a href="../administrador/home" class="btn btn-primary">ADMINISTRADOR</a>
                                </div>
                            </ul>
                        </div>
                        @endif
                    </li>
                    <li>
                        <!-- <a class="btn btn-secondary btn-lg" href="logout" id="todos" data-toggle="dropdown" aria-haspopup="true"><i class="icon icon-log-out" style="color: #ffffff;"></i></a> -->
                        <a href="logout" id="todos" data-toggle="dropdown" aria-haspopup="true">
                            <div class="icon red" style="color: #ff3e61;font-size: xx-large;">
                                <i class="icon-log-out"></i>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                            {!! Session::get('FotoAvatar') !!}
                            <span class="user-name">{!! Session::get('NombreUsuario') !!}</span>
                            <i class="icon-chevron-small-down"></i>
                        </a>
                        <div class="dropdown-menu lg dropdown-menu-right" aria-labelledby="userSettings">
                            <div class="row">
                                <div class="col-md-12" style="text-align:center;">
                                {!! Session::get('NombreUsuario') !!}
                                </div>
                            </div>
                            <ul class="user-settings-list">
                                <li>
                                    <a href="profile">
                                        <div class="icon">
                                            <i class="icon-account_circle"></i>
                                        </div>
                                        <p>Perfil</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="logout">
                                        <div class="icon red">
                                            <i class="icon-switch"></i>
                                        </div>
                                        <p>Salir</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>