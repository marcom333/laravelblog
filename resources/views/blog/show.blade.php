@extends("../layout")

@section("title","Blog")
@section("blog","active")

@section("breadcrumbs")
	<ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="/blog">Blogs</a></li>
	    <li class="breadcrumb-item active">Registro</li>
	</ol>
@endsection

@section("content")
	<h1>{{$blog->title}}</h1>
	<div class="row">
		<div class="col-2">
			<img src="data:image/jpeg;base64,{{base64_encode(Storage::get($blog->cover))}}" class="img-fluid img-thumbnail" alt="Responsive image">
		</div>
		<div class="col-10">
			<p>
				Publicado por: <b>{{$blog->user->name}}</b> el día: <b>{{(new DateTime($blog->created_at))->format("d/m/Y")}}</b> A las <b>{{(new DateTime($blog->created_at))->format("h:i")}}</b> Tags:  
				@foreach($blog->tags as $tag)
					<a class="btn btn-light" href="/blog?tag={{$tag->name}}">{{$tag->name}} <span class="badge badge-dark">{{sizeof($tag->blogs->where("active",1))}}</span></a>
				@endforeach
			</p>
			<hr>
			<p>
				<?php 

				?>
				{!! str_replace(
				/* Comandos */
				["[st]","[tb]","[/tb]","[rg]","[/rg]","[cl]","[/cl]","[img]","[/img]","[ca]","[/ca]", "[rgc]","[/rgc]"], 
				/* traduccion */
				["<br>","<table class='table table-bordered'>","</table>","<tr>","</tr>","<td>","</td>","<img class=\"img-fluid\" src=\"","\">", "<th>","</th>", "<tr class=\"thead-dark\">","<tr>"], 
				$blog->content) !!}
			</p>
		</div>
	</div>
	<hr>
	@foreach($blog->comentarios as $comentario)
		<div class="row" style="padding-bottom: 30px;">
			<div class="col-2">
				@if(@auth()->user()->avatar=="default-avatar.jpg")
					<img class="img-fluid rounded" src="data:image-jpg;base64,{{ base64_encode(Storage::get("public/".$comentario->user->avatar )) }}">
				@else
					<img class="img-fluid rounded" src="data:image-jpg;base64,{{ base64_encode(Storage::get($comentario->user->avatar )) }}">
				@endif
				
			</div>
			<div class="col-9">
				<h3>Titulo</h3>
				<p>Creado por <b>{{$comentario->user->name}}</b>, el día: <b>{{(new DateTime($blog->created_at))->format("d/m/Y")}}</b> A las <b>{{(new DateTime($blog->created_at))->format("h:i")}}</b></p>
				<p>Contenido del blog</p>
			</div>
		</div>
	@endforeach
	@guest
		<div>
			<p>Para poder comentar requieres una cuenta. <a href="/register">Creala aquí</a>.<br>¿Ya tienes cuenta? <a href="/login">Inicia sesión aquí</a></p>
		</div>
	@else
		<div class="row" style="padding-bottom: 30px;">
			<div class="col-2">
				@if(@auth()->user()->avatar=="default-avatar.jpg")
					<img class="img-fluid rounded" src="data:image-jpg;base64,{{base64_encode(Storage::get("public/".auth()->user()->avatar))}}">
				@else
					<img class="img-fluid rounded" src="data:image-jpg;base64,{{base64_encode(Storage::get(auth()->user()->avatar))}}">
				@endif
			</div>
			<div class="col-9">
				<form method="post" action="/blog/{{$blog->id}}/comentario">
					@csrf
					<label>Título:</label><br>
					<input type="text" name="title" class="form-control">
					@error("title")
						<p> {{$message}} </p>
					@enderror
					<label>Descripción:</label><br>
					<textarea name="description" class="form-control"></textarea>
					@error("title")
						<p> {{$message}} </p>
					@enderror
					<input type="submit" class="btn btn-success" value="Enviar">
				</form>
			</div>
		</div>
	@endguest
@endsection