<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use DB; 
use App\Question;
use Auth;

class PertanyaanController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('created_at', 'desc')->paginate(10);
        return view('pertanyaan.index',compact('questions'));
    }
    public function search(Request $request)
    {
        $katakunci = $request['katakunci'];
        $questions = Question::where('title', 'LIKE', "%$katakunci%")->orderBy('created_at', 'desc')->paginate(10);
        // dd($questions);
        return view('pertanyaan.index',compact('questions'));
    }
    public function detail($id)
    {
        $questions = Question::find($id);
        return view('pertanyaan.detail',compact('questions'));
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

        $questions = Question::create([
            "title"=>$request["title"],
            "category"=>$request["category"],
            "body"=>$request["body"],
            "user_id"=>Auth::user()->id
        ]);

        Alert::success('Berhasil', 'Berhasil Menambahkan Pertanyaan');

        return redirect('/pertanyaan')->with('success','Pertanyaan Berhasil Disimpan!');
    }
}
