<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteAnswer extends Model
{
    protected $table = "votes_answers";
    protected $fillable = ["answer_id","user_id","upvote","downvote"];
    public function answer()
    {
        return $this->belongsTo('App\Answer','answer_id');
    }
}
