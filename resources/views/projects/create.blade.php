@extends("../layout")

@section('title','Create Project')
@section('project','active')
@section('breadcrumbs')
	<ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="/">Home</a></li>
	    <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
	    <li class="breadcrumb-item active">Create</li>
	</ol>
@endsection
@section('content')
<h1>Create Project</h1>

<form method="post" action="/projects">
	{{ csrf_field() }}
	<div class="form-group">
		<label for="title">Title:</label>
		<input type="text" class="form-control @error("title") is-invalid @enderror" id="title" aria-describedby="titleHelp" placeholder="Enter title" name="title" value="{{old('title')}}">
			@error("title")
				<p style="color: #ff0000">{{ $message }}</p>
			@enderror
	</div>
	<div class="form-group">
		<label for="description">Description:</label>
		<textarea class="form-control @error("description") is-invalid @enderror" id="description" rows="3" placeholder="Project Description" name="description">{{old('content')}}</textarea>
		@error("description")
			<p style="color: #ff0000">{{ $message }}</p>
		@enderror
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection