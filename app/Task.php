<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //

    public $fillable = [
    	"completed",
    	"project_id",
    	"description"
    ];

    public function project(){
    	return $this->belongsTo(Project::class);
    }
}
