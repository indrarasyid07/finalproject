<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{   
    protected $table = "questions";

    protected $fillable = ["title","category","body","user_id"];
    // public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function answer()
    {
        return $this->hasMany('App\Answer');
    }
    public function vote()
    {
        return $this->hasMany('App\VoteQuestion');
    }
    public function comment()
    {
        return $this->hasMany('App\CommentQuestion');
    }
}
