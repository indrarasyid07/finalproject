<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments_questions;
use Auth;

class KomentarController extends Controller
{

    function store(Request $request,$id)
    {
        dd($request->all());
        $comments = Comments_questions::find($id);
        $comment = Comments_questions::create([
            "body"      => $request["komentar_isi"],
            "user_id"   => Auth::user()->id,
            "question_id" => $request["komentar_question_id"]
        ]);
        return redirect('/pertanyaan/'.$id);
    }
}
