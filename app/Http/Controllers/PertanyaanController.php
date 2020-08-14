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
        // $questions = DB::table('questions')->get();
        $questions = Question::all();
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

        // $query=DB::table('questions')->insert([
        //     "title"=>$request["title"],
        //     "body"=>$request["body"],
        //     "category"=>$request["category"],
        //     "user_id"=>Auth::user()->id
        // ]);

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
