<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments_questions extends Model
{
    protected $tabel = "comments_questions";
    protected $fillable = ["body", "user_id", "question_id"];
}
