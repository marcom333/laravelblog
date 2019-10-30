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
	<h1>Agregar entrada al blog</h1>
	<form method="post" action="/blog" enctype="multipart/form-data">
		@csrf
		<label>Título:</label>
		<input id="title" name="title" type="text" class="form-control" placeholder="Titulo" aria-label="titulo" aria-describedby="basic-addon1" value="{{old('title')}}">
	    @error("title")
        	<div class="alert alert-danger">
        		{{$message}}
        	</div>
        @enderror

        <label>Resumen:</label>
        <input id="title" name="resume" type="text" class="form-control" placeholder="Resumen" aria-label="Resumen" aria-describedby="Resumen" value="{{old('resume')}}">
        @error("resume")
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror

		<label>Contenido:</label>
	    <textarea id="content" class="form-control" name="content" rows="15">{{old('content')}}</textarea>
	    @error("content")
        	<div class="alert alert-danger">
        		{{$message}}
        	</div>
        @enderror

        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <span data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><img src="{{ URL::asset('icon/info.svg') }}" alt="icon name"> Comandos "especiales" para contenido.</span>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                    	<table class="table table-bordered">
                    		<tr>
                    			<th>Comando</th>
                    			<th>Descripción</th>
                    			<th>Opciones</th>
                    		</tr>
                    		<tr>
                    			<td code>[st]</td>
                    			<td>Crea un salto de línea.</td>
                    			<td><span class="code btn btn-primary">Agregar</span></td>
                    		</tr>
                    		<tr>
                    			<td code>[img]url[/img]</td>
                    			<td>Permite renderizar una imagen en la entrada del blog.</td>
                    			<td><span class="code btn btn-primary">Agregar</span></td>
                    		</tr>
                    		<tr>
                    			<td code>
                                    [tb]&#013;&#010;<br>
                                        [rgc]&#013;&#010;<br>
                                            [ca]Cabezera #1[/ca][ca]Cabezera #2[/ca][ca]Cabezera #3[/ca]&#013;&#010;<br>
                                        [/rgc]&#013;&#010;<br>
                                        [rg]&#013;&#010;<br>
                                            [cl]Contenido #1[/cl][cl]Contenido #2[/cl][cl]Contenido #3[/cl]&#013;&#010;<br>
                                        [/rg]&#013;&#010;<br>
                                    [/tb]&#013;&#010;
                                </td>
                    			<td>Crea una tabla con un renglon y una columna.</td>
                    			<td><span class="code btn btn-primary">Agregar</span></td>
                    		</tr>
                    	</table>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
            	$("span.code").on("click",function(){
            		data = $(this).parent().parent().children("td[code]").text();
            		$("#content").val($("#content").val()+data);
            	});
            </script>
        </div>

	    <label>Título del URL:</label>
		<input id="slug" type="text" class="form-control" placeholder="ej. luna-llena" aria-label="slug" aria-describedby="basic-addon1" name="slug" value="{{old('slug')}}">
	    @error("slug")
        	<div class="alert alert-danger">
        		{{$message}}
        	</div>
        @enderror

        <script type="text/javascript">
        	$("#slug").on("focus",function(){
        		$("#slug").val($("#title").val().replace(/[^a-zA-Z0-9]/g,"_"));
        	});
        </script>

        <label>Tags:</label>
        <span data-toggle="tooltip" data-placement="top" title="Cada tag puede ir separada por comas (,)">
            <img src="{{URL::asset('icon/info.svg')}}">
        </span>
        <input id="tags" type="text" class="form-control" placeholder="deportes, futbol, jugador perron" aria-label="tags" aria-describedby="tags" name="tags" value="{{old('tags')}}">
        @error("slug")
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror

        <label>Visibilidad:</label><br>
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
		    <label class="btn btn-outline-dark active">
		    	<input type="radio" name="active" id="option1" autocomplete="off" value="1" checked> Publico
		    </label>
		    <label class="btn btn-outline-dark">
		    	<input type="radio" name="active" id="option2" autocomplete="off" value="0"> Oculto
		    </label>
	    </div>
	    @error("active")
        	<div class="alert alert-danger">
        		{{$message}}
        	</div>
        @enderror

        <br><br>
        <label>Cover del blog</label><br>
        <input type="file" name="cover" id="cover" hidden />
		<label id="btn-cover" for="cover" class="btn btn-info">Seleccionar archivo</label> <span id="archivo"></span>

		<script type="text/javascript">
			$('input[type="file"]').change(function(e){
				$("#archivo").text(e.target.files[0].name);
				$("#btn-cover").removeClass("btn-info");
				$("#btn-cover").addClass("btn-primary");
			});
		</script>

        <br><br>
	    <button type="submit" class="btn btn-success">Enviar</button>
	</form>

    @if ($errors->any())
        @foreach($errors->all as $error)
            <h3>$error</h3>
        @endforeach
    @endif

@endsection