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
}
