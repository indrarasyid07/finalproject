<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use DB;
use App\Question;
use App\VoteQuestion;
use App\Comments_questions;
use Auth;

class PertanyaanController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('created_at', 'desc')->paginate(10);
        return view('pertanyaan.index', compact('questions'));
    }
    public function search(Request $request)
    {
        $katakunci = $request['katakunci'];
        $questions = Question::where('title', 'LIKE', "%$katakunci%")->orderBy('created_at', 'desc')->paginate(10);
        // dd($questions);
        return view('pertanyaan.index', compact('questions'));
    }
    public function detail($id)
    {
        $questions = Question::find($id);
        $datavotes = VoteQuestion::where('question_id', $id)->get();
        $comment = Comments_questions::find($id);
        // dd($datavotes);
        return view('pertanyaan.detail', compact('questions', 'datavotes', 'comment'));
    }
    public function create()
    {
        return view('pertanyaan.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|unique:questions',
            'category' => 'required',
            'body' => 'required'
        ]);

        $questions = Question::create([
            "title" => $request["title"],
            "category" => $request["category"],
            "body" => $request["body"],
            "user_id" => Auth::user()->id
        ]);

        Alert::success('Berhasil', 'Berhasil Menambahkan Pertanyaan');

        return redirect('/pertanyaan')->with('success', 'Pertanyaan Berhasil Disimpan!');
        return redirect('/pertanyaan')->with('success', 'Pertanyaan Berhasil Disimpan!');
    }
    public function upvote(Request $request)
    {
        $idpertanyaan = $request['upvote_idpertanyaan'];
        if (Auth::check()) {
            $countvote = VoteQuestion::where('question_id', $idpertanyaan)
                ->where('user_id', Auth::user()->id)
                ->count();
            if ($countvote == 0) {
                $question = Question::find($idpertanyaan);
                if ($question->user_id == Auth::user()->id) {
                    Alert::error('Perhatian', 'Anda tidak bisa melakukan vote pada pertanyaan anda sendiri');
                } else {
                    $upvote = VoteQuestion::create([
                        "question_id" => $idpertanyaan,
                        "user_id" => Auth::user()->id,
                        "upvote" => 1,
                        "downvote" => 0
                    ]);
                    //tambah reputasi
                    $user = User::find($question->user_id);
                    $user->reputation = ($user->reputation) + 10;
                    $user->save();
                    Alert::success('Berhasil', 'Berhasil Melakukan Up Vote');
                }
            } else {
                Alert::error('Perhatian', 'Anda sudah melakukan vote sebelumnya');
            }
            return redirect('/pertanyaan/' . $idpertanyaan);
        } else {
            Alert::error('Perhatian', 'Anda harus login untuk melakukan vote');
            return redirect('/login');
        }
    }
    public function downvote(Request $request)
    {
        $idpertanyaan = $request['downvote_idpertanyaan'];
        if (Auth::check()) {
            if (Auth::user()->reputation > 14) {
                $countvote = VoteQuestion::where('question_id', $idpertanyaan)
                    ->where('user_id', Auth::user()->id)
                    ->count();
                if ($countvote == 0) {
                    $question = Question::find($idpertanyaan);
                    if ($question->user_id == Auth::user()->id) {
                        Alert::error('Perhatian', 'Anda tidak bisa melakukan vote pada pertanyaan anda sendiri');
                    } else {
                        $upvote = VoteQuestion::create([
                            "question_id" => $idpertanyaan,
                            "user_id" => Auth::user()->id,
                            "upvote" => 0,
                            "downvote" => 1
                        ]);
                        //tambah reputasi
                        $user = User::find($question->user_id);
                        $user->reputation = ($user->reputation) - 1;
                        $user->save();
                        Alert::success('Berhasil', 'Berhasil Melakukan Down Vote');
                    }
                } else {
                    Alert::error('Perhatian', 'Anda sudah melakukan vote sebelumnya');
                }
            } else {
                Alert::error('Perhatian', 'Reputasi anda tidak cukup untuk melakukan downvote, anda harus memiliki reputasi minimal 15 ');
            }

            return redirect('/pertanyaan/' . $idpertanyaan);
        } else {
            Alert::error('Perhatian', 'Anda harus login untuk melakukan vote');
            return redirect('/login');
        }
    }
    public function destroy($id)
    {
        $question = Question::find($id);
        if ($question->user_id == Auth::user()->id) {
            VoteQuestion::where('question_id', $id)->delete();
            $question->delete();
            Alert::success('Berhasil', 'Berhasil Melakukan Hapus Data');
            return redirect('/pertanyaan');
        } else {
            Alert::error('Perhatian', 'Anda tidak berhak menghapus data ini');
            return redirect('/pertanyaan/' . $id);
        }
    }
}
