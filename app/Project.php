<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
    /*
    public function boot(){
        parent::boot();
        
        static::updated
        static::deleted
        static::created(function ($project){
            Mail::to($project->owner->email)->send(new ProjectCreated($project));
        });
    }*/

	public $fillable = [
		"title",
		"description",
        "owner_id"
	];
    //

    public function user(){
        //dd($this->belongsTo(User::class, 'owner_id'));
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function tasks(){
    	return $this->hasMany(Task::class);
    }

    public function addTask($request){
    	return $this->tasks()->create($request);
    }
}
