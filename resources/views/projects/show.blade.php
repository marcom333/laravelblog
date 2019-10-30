@extends("../layout")

@section('title','Show Project')
@section('project','active')
@section('breadcrumbs')
	<ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="/">Home</a></li>
	    <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
	    <li class="breadcrumb-item active">Show</li>
	</ol>
@endsection
@section('content')

<h1>Show Project</h1>
<p>
	<form method="post" action="/projects/{{$project->id}}">
		@csrf
		@method("DELETE")
		<a class="btn btn-primary" href="/projects/{{$project->id}}/edit"><img src="{{ URL::asset('icon/eye.svg') }}" alt="icon name"> Update</a>
		<button class="btn btn-danger"><img src="{{ URL::asset('icon/alert.svg') }}" alt="icon name"> Delete</button>
	</form>
</p>
<table class="table table-bordered">
	<tr>
		<th>ID</th>
		<td>{{$project->id}}</td>
	</tr>
	<tr>
		<th>Title</th>
		<td>{{$project->title}}</td>
	</tr>
	<tr>
		<th>Owner</th>
		<td>{{$project->user->name}}</td>
	</tr>
	<tr>
		<th>Description</th>
		<td>{{$project->description}}</td>
	</tr>
	<tr>
		<th>Create At</th>
		<td>{{$project->created_at}}</td>
	</tr>
	<tr>
		<th>Update At</th>
		<td>{{$project->updated_at}}</td>
	</tr>
</table>

	<h1>Tasks</h1>
	<table class="table table-bordered">
		<tr>
			<th>Description</th>
			<th>Finished</th>
			<th>Options</th>
		</tr>
		@foreach($project->tasks as $task)
			<tr>
				<td>{{$task->description}}</td>
				<td>
					<form method="POST" action="/tasks/{{$task->id}}">
						@csrf
						@method("PATCH")
						<input type="checkbox" name="completed" {{$task->completed?"checked":""}} onchange="this.form.submit()">
					</form>
					
				</td>
				<td>
					<form method="post" action="/tasks/{{$task->id}}">
						@csrf
						@method("DELETE")
						<a class="btn btn-primary" href="/tasks/{{$task->id}}/edit"><img src="{{ URL::asset('icon/pencil.svg') }}" alt="icon name"> Update</a>
						<button class="btn btn-danger"><img src="{{ URL::asset('icon/alert.svg') }}" alt="icon name"> Delete</button>
					</form>
				</td>
			</tr>
		@endforeach
		<tr>
			<form method="POST" action="/projects/{{$project->id}}/tasks">
				@csrf
				<td>Add Task</td>
				<td>
					<input class="form-control @error("description")is-invalid @enderror" type="text" name="description" value="{{old("description")}}">
					@error("description")
						<p style="color: #ff0000">{{$message}}</p>
					@enderror
				</td>
				<td><button class="btn btn-success">Add Task</button></td>
			</form>
		</tr>
	</table>

@if($project->tasks->count() > 0)
	<!--Hay tareas :v -->
@endif
@endsection