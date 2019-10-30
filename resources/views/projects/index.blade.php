@extends("../layout")

@section('title','Projects')
@section('project','active')
@section('breadcrumbs')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Projects</li>
</ol>
@endsection
@section('content')
<h1>Projects</h1>

<table class="table table-bordered">
	<caption>Showing <?= sizeof($projects) ?> of N </caption>
	<thead class="thead-dark">
		<th>Name</th>
		<th>Owner</th>
		<th>Created At</th>
		<th>Updated At</th>
		<th>Option</th> 
	</thead>
	@foreach($projects as $project)
		<tr>
			<td>{{$project->title}}</td>
			<td>{{$project->user->name}}</td>
			<td>{{$project->created_at}}</td> 
			<td>{{$project->updated_at}}</td> 
			<td>
				<form method="post" action="/projects/{{$project->id}}">
					@csrf
					@method("DELETE")
					<a class="btn btn-light" href="/projects/{{$project->id}}"><img src="{{ URL::asset('icon/eye.svg') }}" alt="icon name"> View</a>
					<a class="btn btn-primary" href="/projects/{{$project->id}}/edit"><img src="{{ URL::asset('icon/pencil.svg') }}" alt="icon name"> Update</a>
					<button class="btn btn-danger" href="/projects/{{$project->id}}"><img src="{{ URL::asset('icon/alert.svg') }}" alt="icon name"> Delete</button>
				</form>
			</td>
	@endforeach
</table>
@endsection