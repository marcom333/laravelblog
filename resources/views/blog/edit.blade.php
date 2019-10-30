@extends("../layout")

@section("title","Blog")
@section("blog","active")

@section("breadcrumbs")
	<ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="/blog">Blogs</a></li>
	    <li class="breadcrumb-item active">Actualizar</li>
	</ol>
@endsection

@section("content")
	<h1>Introducción al blog</h1>
	title:<input type="text" name="title">
@endsection