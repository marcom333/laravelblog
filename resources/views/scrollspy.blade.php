@extends('layout',["breadcrumbs"=>[
    ["page"=>"/", "active"=>true, "title"=>"Home"]
]])

@section('title','HomeBugs')
@section('home','active')

@section('breadcrumbs')
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Home</li>
</ol>
@endsection

@section('content')
	<style type="text/css">
		img{
			height: 30px;
			width: 30px;
		}
	</style>
	<?php 
		$faker = Faker\Factory::create();

		echo $faker->name . "<br>";

		echo $faker->address . "<br>";

		echo $faker->text . "<br>";

		for ($i = 0; $i < 10; $i++) {
		  echo $faker->name, "<br>";
		}

		$dir = opendir("c:/wamp64/www/laravelblog/public/icon");
		while ($archivo = readdir($dir)){
			if(strpos($archivo, "svg")!==false){
				//echo "<img src=\"" . URL::asset("icon/".$archivo) . "\">". $archivo . "<br>";
			}
		}

	?>
@endsection