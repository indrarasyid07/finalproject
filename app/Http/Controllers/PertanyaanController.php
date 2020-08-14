<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use Auth;
// use App\questions;

class PertanyaanController extends Controller
{
    public function index()
    {
        $questions = DB::table('questions')->get();
        return view('pertanyaan.index',compact('questions'));
    }
    public function detail($id)
    {
        return view('pertanyaan.detail');
    }
    public function create()
    {
        return view('pertanyaan.create');
    }
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'title'=>'required|unique:questions',
            'category'=>'required',
            'body'=>'required'
        ]);

        $query=DB::table('questions')->insert([
            "title"=>$request["title"],
            "body"=>$request["body"],
            "category"=>$request["category"],
            "user_id"=>Auth::user()->id
        ]);

        return redirect('/pertanyaan')->with('success','Pertanyaan Berhasil Disimpan!');
    }
}
