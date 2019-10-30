<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notifications\SubscriptionRenewalFailed;

class PagesController extends Controller
{
    // Home Page
    public function home(){
    	//auth()->user()->notify(new SubscriptionRenewalFailed());
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
    }

    // Home Page
    public function about(){
    	return view('about');
    }

    // Home Page
    public function contact(){
		return view('contact');
    }
}
