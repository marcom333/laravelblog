<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    public $fillable=[
        	"title",
            "resume",
        	"content",
        	"slug",
        	"user_id",
        	"active",
        	"cover"
        ];


    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,"tag_blogs");//,"blog_id","tag_id");
    }
}
