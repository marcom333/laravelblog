@extends('layout')

@section('title','Actualizar avatar')
@section('user','active')
@section('breadcrumbs')
	<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Actualizar avatar</li>
    </ol>
@endsection
@section('content')
	@if(auth()->user()->avatar == "default-avatar.jpg")
		<img src="data:image/jpeg;base64,{{base64_encode(Storage::get("public/".auth()->user()->avatar))}} ">
	@else
		<img src="data:image/jpeg;base64,{{base64_encode(Storage::get(auth()->user()->avatar))}} ">
	@endif
	<form action="/user" method="post" enctype="multipart/form-data">
		@csrf
		@method("patch")

		<label>Avatar Perrón</label><br>
        <input type="file" name="avatar" id="avatar" hidden />
		<label id="btn-avatar" for="avatar" class="btn btn-info">Seleccionar archivo: </label> <span id="archivo"></span>

		<script type="text/javascript">
			$('input[type="file"]').change(function(e){
				$("#archivo").text(e.target.files[0].name);
				$("#btn-avatar").removeClass("btn-info");
				$("#btn-avatar").addClass("btn-primary");
			});
		</script>
		<br>
		<button class="btn btn-success">
			Enviar
		</button>
	</form>

@endsection