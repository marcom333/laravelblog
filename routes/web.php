<?php

//require_once 'c:/wamp64/www/laravelblog/vendor/shuchkin/simplexlsx/src/SimpleXLSX.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','PagesController@home');
Route::get('/contact','PagesController@contact');
Route::get('/about','PagesController@about');

Route::resource('projects','ProjectController');//->middleware('auth')->middleware('can:use.project');
Route::resource('blog','BlogController');

Route::patch('/tasks/{task}','ProjectTasksController@update');
Route::post('projects/{project}/tasks','ProjectTasksController@store');
Route::post('blog/{id}/comentario','ComentarioController@store');

Route::delete('tasks/{task}','ProjectTasksController@destroy');

Route::get('/test', function () {
	return view('scrollspy');
});

Auth::routes();

Route::get('/user/avatar','UserAvatarController@edit');
Route::patch('/user','UserAvatarController@update');


Route::get('/phpinfo', function(){
	echo phpinfo();
});
Route::get('/exceltest', function(){
	$file = 'c:/wamp64/www/doc.xls';
	// LIBRARY COMPOSER CODE:
	/*
		composer require phpoffice/phpspreadsheet
	*/
	//$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
	$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
	$spreadsheet = $reader->load($file);
	$exit = false;
	echo "<table border='1px'><tr><th>Dato administrativo</th><th>Importe</th><th>Número de tarjeta</th><th>Aprobación</th><th>Motivo rechazo</th>";
	for($i=10; !$exit; $i++){
		echo "<tr>";
		for($j=1; $j<=5; $j++){
			$val = $spreadsheet->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();
			if(is_null($val) && $j == 1){
				$exit = true;
				break;
			}
			else{
				echo "<td>" .$val . "</td>";
			}
		}
		echo "</tr>";
	}
});

Route::post("/push/event", function (Request $request){
	shell_exec( 'cd /wamp64/www/laravelblog && git pull' );
});

Route::get("hook",function (){
	return "<img src='https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.nextgov.com%2Fit-modernization%2F2020%2F10%2Fmicrosoft-spacex-team-bring-cloud-computing-space%2F169377%2F&psig=AOvVaw2obp4RFufXYEFWgsNWodd6&ust=1619714512323000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCNiasPywofACFQAAAAAdAAAAABAD' style='width: 100%; height: 100%'>";
});


//Route::get('/home', 'HomeController@index')->name('home');



/*
// GET /projects (index)
Route::get('/projects','ProjectController@index');
// GET /projects/create (create)
Route::get('/projects/create','ProjectController@create');
// GET /projects/1 (show)
Route::get('/projects/{project}','ProjectController@view');
// GET /projects/1/edit (edit)
Route::get('/projects/{projects}/edit','ProjectController@edit');
// POST /projects (store)
Route::post('/projects','ProjectController@store');
// PATCH /projects/1 (update)
Route::patch('/projects/{project}','ProjectController@update');
// DELETE /projects/1 (destroy)
Route::delete('/projects/{project}','ProjectController@destroy');
*/

/*
Route::get('/', function () {
	$tasks = [
		"Go to View",
		"Go to Use",
		"Go to Feel",
		'Go Inside'
	];
	$paramTest = '<div style="height:50px;width: 50px; background-color: #ff0000;">=}:{v</div>';

	//return view('welcome')->withTasks($tasks)->withParamTest($paramTest);
	return view('welcome')->with([
		"tasks" => $tasks,
		"paramTest"=>$paramTest,
	]);
    //return view('welcome',["tasks"=>$tasks, $paramTest]);
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});
*/