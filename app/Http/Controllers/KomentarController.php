<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments_questions;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    function komenp()
    {
        return view('pertanyaan.komentarp');
    }
    function store(Request $request)
    {
        // dd($request->all());
        $comment = Comments_questions::create([
            "body"      => $request["body"],
            "user_id"   => Auth::user()->id,
            "question_id" => 1
        ]);
    }
    function show($id)
    {
        $comment = Comments_questions::find($id);
        return view('pertanyaan.detail', compact('comment'));
    }
}
