@extends("../layout")

@section("title","Blog")
@section("blog","active")

@section("breadcrumbs")
	<ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
	    <li class="breadcrumb-item active">Blogs</li>
	</ol>
@endsection

@section("content")
	<h1>Entradas recientes</h1>
	<hr>
	@if(auth()->guest())
		<p>Para registrar una entrada necesitas una cuenta. <a href="/login">Inicia sesión aquí</a><br> ¿No tienes una cuenta? <a href="/register">Registrate aquí</a></p>
	@else
		<h4>Opciones de usuario:</h4>
		<p><a class="btn btn-primary" href="/blog/create">Crear entrada</a></p>
	@endif
	@if($total > 9)
		<?php
			$paginas = ceil($total/9);

			$pagina = request('page')?request('page'):1;

			$init = $pagina-5 < 0?1:$pagina-5;
			$final = $pagina+5 > $paginas?$paginas:$pagina+5;

			$diferencia = $final - $init;

			if($diferencia < 10 && $final + $diferencia < $paginas){
				$final += 10-$diferencia;
			}
			else if($diferencia < 10 && $init - $diferencia > 1){
				$init -= 10-$diferencia;
			}

			$paginacion = $final-$init;

		?>
		<nav aria-label="Page navigation example">
		    <ul class="pagination justify-content-center">
			    <li class="page-item @if($pagina<=1) disabled @endif"><a class="page-link" href="/blog?page={{$pagina-1}}" tabindex="-1">Anterior</a></li>
				@for($x=$init; $x<=$final;$x++)
					@if($x > 0)
			    		<li class="page-item @if($pagina==$x) active @endif"><a class="page-link" href="/blog?page={{$x}}">{{$x}}</a></li>
			    	@endif
			    @endfor
			    <li class="page-item @if($pagina>=$total/9) disabled @endif"><a class="page-link" 
			    	href="/blog?page={{ ($pagina>=1)?$pagina+1:2}}">Siguiente</a></li>
			</ul>
	    </nav>
	@endif
	<hr>
	<div class="row">
		@foreach($blogs as $blog)
			<div class="col">
				<div class="card" style="width: 18rem;">
			        <img class="card-img-top" src="data:image/jpeg;base64,{{ base64_encode(Storage::get($blog->cover)) }}" alt="Card image cap">
			        <div class="card-body">
			            <h5 class="card-title">{{$blog->title}}</h5>
			            <p class="card-text">{{str_limit($blog->resume, 250, '...')}}</p>
			            <p>Tags:
			            	@foreach($blog->tags as $tag)
			            		<a href="?tag={{$tag->name}}">{{$tag->name}}</a>, 
			            	@endforeach
			            </p>
			            <a class="btn btn-primary" href="/blog/{{$blog->slug}}" role="button">Ver más</a><br>
			        </div>
				</div>
			</div>
		@endforeach
	</div>

	<hr>
	<!-- paginación -->
	@if($total > 9)
		<nav aria-label="Page navigation example">
		    <ul class="pagination justify-content-center">
			    <li class="page-item @if($pagina<=1) disabled @endif"><a class="page-link" href="/blog?page={{$pagina-1}}"tabindex="-1">Anterior</a></li>
				@for($x=$init; $x<=$final;$x++)
					@if($x > 0)
			    		<li class="page-item @if($pagina==$x) active @endif"><a class="page-link" href="/blog?page={{$x}}">{{$x}}</a></li>
			    	@endif
			    @endfor
			    <li class="page-item @if($pagina>=$total/9) disabled @endif"><a class="page-link" 
			    	href="/blog?page={{ ($pagina>=1)?$pagina+1:2}}">Siguiente</a></li>
			</ul>
	    </nav>
	@endif

@endsection