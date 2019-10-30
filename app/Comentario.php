<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    //
    public $fillable = [
    	"blog_id",
    	"title",
    	"description",
    	"user_id"
    ];


    public function user(){
    	return $this->belongsTo(User::class);
    }
}
