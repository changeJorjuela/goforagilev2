<aside class="app-side is-open" id="app-side">
	<!-- <aside class="app-side is-open is-mini" id="app-side"> -->
	<div class="side-content ">
		<div class="user-profile">
			{!! Session::get('FotoAside') !!}
			<h6 class="profile-name">{!! Session::get('NombreUsuario') !!}</h6>
			@if(Session::get('id_rol') != 3)
			<h6 class="profile-name">Cambiar de Perfil</h6>
			@if(Session::get('role_plataforma') === 1)
			<h6 class="profile-name"><a href="../lider/home" class="btn btn-primary btn-rounded">LIDER</a></h6>
			@elseif(Session::get('role_plataforma') === 2)
			<h6 class="profile-name"><a href="../admin/home" class="btn btn-primary btn-rounded">ADMINISTRADOR</a></h6>
			@endif
			@endif
		</div>
		<!-- <div class="sidebarNavScroll"> -->
			<nav class="side-nav">
				<ul class="unifyMenu" id="unifyMenu">
					@if(Session::get('id_empresa') === 1)
					@include("lateral.lateralDesempenio2023")
					@endif

					@if(Session::get('ModOkrsEquipo') === 1)
					@include("lateral.lateralOkrsEquipo")
					@endif

					@if(Session::get('ModValoracion') === 1)
					@include("lateral.lateralCompetencias")
					@endif

					@if(Session::get('ModDesempenio') === 1)
					@if(Session::get('id_empresa') === 1)
					@include("lateral.lateralDesempenioPc")
					@else
					@include("lateral.lateralDesempenio")
					@endif
					@endif

					@if(Session::get('ModEndomarketing') === 1)
					@include("lateral.lateralLeccionesAprendidas")
					@include("lateral.lateralEndomarketing")
					@endif

					@if(Session::get('ModAdmin') === 1)
					@if(Session::get('role_plataforma') === 1)
					@include("lateral.lateralAdmin")
					@endif
					@endif
				</ul>
			</nav>
		<!-- </div> -->
	</div>
</aside>