<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentQuestion extends Model
{
    protected $table    = "comments_questions";

    protected $fillable = ["body","user_id","question_id"];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function question()
    {
        return $this->belongsTo('App\Question','question_id');
    }
}