<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentAnswer extends Model
{
    protected $table    = "comments_answers";

    protected $fillable = ["body","user_id","answer_id"];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function answer()
    {
        return $this->belongsTo('App\Answer','answer_id');
    }
}
