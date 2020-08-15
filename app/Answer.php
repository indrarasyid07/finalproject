<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = "answers";

    protected $fillable = ["body","user_id","question_id"];
    // public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function question()
    {
        return $this->belongsTo('App\Question','question_id');
    }
    public function vote()
    {
        return $this->hasMany('App\VoteAnswer');
    }
}