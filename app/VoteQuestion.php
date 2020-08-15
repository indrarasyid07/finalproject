<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteQuestion extends Model
{
    protected $table = "votes_questions";
    protected $fillable = ["question_id","user_id","upvote","downvote"];
    public function question()
    {
        return $this->belongsTo('App\Question','question_id');
    }
    public function vote()
    {
        return $this->hasMany('App\VoteAnswer');
    }
}
