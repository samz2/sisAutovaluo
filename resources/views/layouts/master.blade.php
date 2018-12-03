<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Universidad Nacional de Ucayali</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="sidebar-mini" style="height: auto;">
    <div class="wrapper" id="app">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
				</li>
			</ul>
    
			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<!-- Messages Dropdown Menu -->
				<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						@switch(Auth::user()->tipo)
							@case(1)
								Administrador <span class="caret"></span>	
								@break
							@case(2)
								Notificador <span class="caret"></span>	
								@break
							@case(3)
								Usuario <span class="caret"></span>	
								@break
							@default
								
						@endswitch
						{{-- {{ Auth::user()->user }} <span class="caret"></span> --}}
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<a class="dropdown-item" href="{{ route('logout') }}"
							onclick="event.preventDefault();
										  document.getElementById('logout-form').submit();">
							 {{ __('Cerrar Sesión') }}
						 </a>

						 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							 @csrf
						 </form>
					</div>
				</li>
			</ul>
		</nav>
    
		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 600px;">
			<!-- Brand Logo -->
			<router-link to="/home" class="brand-link text-center">
				<span class="brand-text font-weight-light">Sistema Autovaluo</span>
			</router-link>
    
			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user (optional) -->
				{{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="#" class="d-block">Usuario Autenticado</a>
					</div>
				</div> --}}
    
				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

						@switch(Auth::user()->tipo)
							@case(1)
							<li class="nav-item has-treeview">
								<a href="#" class="nav-link">
									<i class="nav-icon fa fa-folder"></i>
									<p>
										Predio
										<i class="fa fa-angle-right right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<router-link to="/predio-lista" class="nav-link">
											<i class="fa fa-list-ol nav-icon"></i>
											<p>Lista</p>
										</router-link>
									</li>
									<li class="nav-item">
										<router-link to="/predio-agregar" class="nav-link">
											<i class="fa fa-plus-circle nav-icon"></i>
											<p>Agregar</p>
										</router-link>
									</li>
									<li class="nav-item">
										<router-link to="/predio-editar" class="nav-link">
											<i class="fa fa-pencil-square nav-icon"></i>
											<p>Editar</p>
										</router-link>
									</li>
								</ul>
							</li>
							<li class="nav-item has-treeview">
								<a href="#" class="nav-link">
									<i class="nav-icon fa fa-folder"></i>
									<p>
										Registrar
										<i class="fa fa-angle-right right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<router-link to="/addUser" class="nav-link">
											<i class="fa fa-plus-circle nav-icon"></i>
											<p>agregar usuario</p>
										</router-link>
									</li>
									<li class="nav-item">
										<router-link to="/usuarios" class="nav-link">
											<i class="fa fa-address-book nav-icon"></i>
											<p>Lista de usuarios</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="../examples/profile.html" class="nav-link">
											<i class="fa fa-pencil-square nav-icon"></i>
											<p>Editar</p>
										</a>
									</li>
								</ul>
							</li>
							@break
							@case(2)
								<li class="nav-item has-treeview">
									<a href="#" class="nav-link">
										<i class="nav-icon fa fa-folder" aria-hidden="true"></i>
										<p>
											Usuarios
											<i class="fa fa-angle-left right"></i>
										</p>
									</a>
									<ul class="nav nav-treeview">
										<li class="nav-item">
											<router-link to="/visualize" class="nav-link">
												<i class="fa fa-map-o nav-icon" aria-hidden="true"></i>
												<p>Visualizar</p>
											</router-link>
										</li>
										<li class="nav-item">
											<router-link to="/listado" class="nav-link">
												<i class="fa fa-address-card-o nav-icon" aria-hidden="true"></i>
												<p>Listado</p>
											</router-link>
										</li>	
									</ul>
								</li>
								@break
							@case(3)
								<li class="nav-item has-treeview">
									<a href="#" class="nav-link">
										<i class="nav-icon fa fa-user-o" aria-hidden="true"></i>
										<p>
											Usuario
											<i class="fa fa-angle-left right"></i>
										</p>
									</a>
									<ul class="nav nav-treeview">
										<li class="nav-item">
											<router-link to="/manager" class="nav-link">
												<i class="fa fa-edit nav-icon"></i>
												<p>Active</p>
											</router-link>
										</li>	
									</ul>
								</li>	
								@break
							@default
								
						@endswitch

						{{-- <li class="nav-header">EXAMPLES</li>
						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-book"></i>
								<p>
									Pages
									<i class="fa fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="../examples/invoice.html" class="nav-link">
										<i class="fa fa-circle-o nav-icon"></i>
										<p>Invoice</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="../examples/profile.html" class="nav-link">
										<i class="fa fa-circle-o nav-icon"></i>
										<p>Profile</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-plus-square-o"></i>
								<p>
									Extras
									<i class="fa fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="../examples/404.html" class="nav-link">
										<i class="fa fa-circle-o nav-icon"></i>
										<p>Error 404</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="../examples/500.html" class="nav-link">
										<i class="fa fa-circle-o nav-icon"></i>
										<p>Error 500</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="../examples/blank.html" class="nav-link">
										<i class="fa fa-circle-o nav-icon"></i>
										<p>Blank Page</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="../../starter.html" class="nav-link">
										<i class="fa fa-circle-o nav-icon"></i>
										<p>Starter Page</p>
									</a>
								</li>
							</ul>
						</li> --}}
					</ul>
				</nav>
			</div>
		</aside>
    
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper" style="min-height: 600px;">
    
			<!-- Main content -->
			<section class="content mt-4">
                @yield('content')
			</section>
		</div>
		<footer class="main-footer">
			<div class="float-right d-none d-sm-block">
				<b>Versión</b> 1.0
			</div>
			<strong>Copyright © 2018 <a href="http://www.google.com">Sistema de Autovaluo</a>.</strong> Todos los derechos reservados.
		</footer>
    </div>
	
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>
</html>