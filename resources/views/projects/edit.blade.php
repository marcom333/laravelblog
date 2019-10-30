@extends("../layout")

@section('title','Create Project')
@section('project','active')
@section('breadcrumbs')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
    <li class="breadcrumb-item"><a href="/projects/{{$project->id}}">Show</a></li>
    <li class="breadcrumb-item active">Update</li>
</ol>
@endsection
@section('content')
<h1>Update Project</h1>

<form method="post" action="/projects/{{$project->id}}">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}
	<div class="form-group">
		<label for="title">Title:</label>
		<input type="text" class="form-control" id="title" aria-describedby="titleHelp" placeholder="Enter title" name="title" value="{{old("title")?old("title"):$project->title}}">
		@error("title")
			<p style="color: #ff0000">{{ $message }}</p>
		@enderror
	</div>
	<div class="form-group">
		<label for="description">Description:</label>
		<textarea class="form-control" id="description" rows="3" placeholder="Project Description" name="description">{{old("description")?old("description"):$project->description}}</textarea>
		@error("description")
			<p style="color: #ff0000">{{ $message }}</p>
		@enderror
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection