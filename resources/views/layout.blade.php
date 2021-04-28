<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">
    <title>@yield('title','Larabugs')</title>
</head>
<body>

	<div id="container">
		<div id="header">
			<div class="container">
				<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
					<a class="navbar-brand" href="/">
						<img class="large-icon" src="{{ URL::asset('img/logo.jpg') }}" width="30" height="30" class="d-inline-block align-top" alt="">
						LaraPost
					</a>
					
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
						<ul class="navbar-nav">
							<li class="nav-item @yield('home','')">
								<a class="nav-link" href="/">Inicio</a>
							</li>
							<li class="nav-item @yield('about','')">
								<a class="nav-link" href="/about">Nosotros</a>
							</li>
							<li class="nav-item @yield('contact','')">
								<a class="nav-link" href="/contact" tabindex="-1" aria-disabled="true">Contacto</a>
							</li>
							<li class="nav-item @yield('blog','')">
								<a class="nav-link" href="/blog" tabindex="-1" aria-disabled="true">Publicaciones</a>
							</li>
							@guest
		                        <li class="nav-item">
		                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
		                        </li>
		                        @if (Route::has('register'))
		                            <li class="nav-item">
		                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
		                            </li>
		                        @endif
		                    @else
			                    <li class="nav-item dropdown @yield('project','')">
			                    	<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Projects</a>
			                    	<div class="dropdown-menu">
			                    		<a class="dropdown-item" href="/projects">Index</a>
			                    		<div class="dropdown-divider"></div>
			                    		<a class="dropdown-item" href="/projects/create">Create</a>
			                    	</div>
			                    </li>
		                        <li class="nav-item dropdown @yield('user','')">
		                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
		                                {{ Auth::user()->name }} <span class="caret"></span>
		                            </a>

		                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
		                                <a class="dropdown-item" href="{{ route('logout') }}"
		                                   onclick="event.preventDefault();
		                                                 document.getElementById('logout-form').submit();">
		                                    {{ __('Logout') }}
		                                </a>
		                                <a class="dropdown-item" href="/user/avatar">Actualizar avatar</a>
		                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                                    @csrf
		                                </form>
		                            </div>
		                        </li>
		                    @endguest
						</ul>
					</div>
				</nav>
			</div>
		</div>
		<div id="body">
		    <div class="container" style="background-color: #eee; border-radius: 10px;">
				@yield('breadcrumbs')
		    	@if(session("flash"))
					<div class="alert alert-success" role="alert">
						{{session("flash")}}
					</div>
				@endif
				@yield('content')
		    </div>
	    </div>
    	<div id="footer">
		    <div style="background-color: #000; color: #00ff00;">
			    <div class="container">
			    	<div class="row" style="border-top: 1px solid black; padding: 10px;">
			    		<div class="col-12">
							<p style="text-align: center;">
								<img class="large-icon" src="{{URL::asset("icon/shield-check.svg")}}" style="filter: invert(42%) sepia(93%) saturate(1352%) hue-rotate(87deg) brightness(119%) contrast(100%);"> 
								Desarrollado por Jonh Titor 
								<img class="large-icon" src="{{URL::asset("icon/shield-check.svg")}}" style="filter: invert(42%) sepia(93%) saturate(1352%) hue-rotate(87deg) brightness(119%) contrast(100%);">
								<br> 
								<img class="large-icon" src="{{URL::asset("icon/quote.svg")}}" style="filter: invert(42%) sepia(93%) saturate(1352%) hue-rotate(87deg) brightness(119%) contrast(100%);"> 
								Vengo del futuro y tu mamá es Hombre
								<img class="large-icon" src="{{URL::asset("icon/flame.svg")}}" style="filter: invert(23%) sepia(85%) saturate(5419%) hue-rotate(354deg) brightness(99%) contrast(127%);"> 
							</p>
			    		</div>
			    	</div>
				</div>
		    </div>
    	</div>
    </div>
	<!--
    <script type="text/javascript">
		$(function () {
		  $('[data-toggle="popover"]').popover({trigger: 'focus'})
		})
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
		$('[data-spy="scroll"]').each(function () {
		  var $spy = $(this).scrollspy('refresh')
		})
    </script> -->
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>
</body>
</html>



