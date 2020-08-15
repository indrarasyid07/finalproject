<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use App\CommentQuestion;
use App\CommentAnswer;
use App\Question;
use App\Answer;

class KomentarController extends Controller
{
    public function storekomentarpertanyaan($id, Request $request)
    {
        $question = Question::find($id);
        $jmlkomentar = CommentQuestion::where('user_id', Auth::user()->id)->where('question_id', $id)->count();
        if ($jmlkomentar==0) {
            if ($question->user_id != Auth::user()->id) {
                $request->validate([
                    'komentar_isi'=>'required'
                ]);
                $comment = CommentQuestion::create([
                    "body"=>$request["komentar_isi"],
                    "user_id"=>Auth::user()->id,
                    "question_id"=>$id
                ]);
                Alert::success('Berhasil', 'Berhasil Menambahkan Komentar');
            }else{
                Alert::error('Perhatian', 'Anda tidak dapat menambahkan komentar di pertanyaan anda sendiri');
            }
        }else{
            Alert::error('Perhatian', 'Anda sudah pernah berkomentar');
        }

        return redirect('/pertanyaan/'.$id);
    }
    public function storekomentarjawaban($id, Request $request)
    {
        $answer = Answer::find($id);
        $idpertanyaan = $answer->question_id;
        $jmlkomentar = CommentAnswer::where('user_id', Auth::user()->id)->where('answer_id', $id)->count();
        if ($jmlkomentar==0) {
            if ($answer->user_id != Auth::user()->id) {
                $request->validate([
                    'komentar_jawaban'=>'required'
                ]);
                $comment = CommentAnswer::create([
                    "body"=>$request["komentar_jawaban"],
                    "user_id"=>Auth::user()->id,
                    "answer_id"=>$id
                ]);
                Alert::success('Berhasil', 'Berhasil Menambahkan Komentar');
            }else{
                Alert::error('Perhatian', 'Anda tidak dapat menambahkan komentar di jawaban anda sendiri');
            }
        }else{
            Alert::error('Perhatian', 'Anda sudah pernah berkomentar');
        }

        return redirect('/pertanyaan/'.$idpertanyaan);
    }
    public function destroykomentarpertanyaan($id)
    {
        $comment = CommentQuestion::find($id);
        $pertanyaan_id = $comment->question_id;
        if ($comment->user_id==Auth::user()->id) {
            $comment->delete();
            Alert::success('Berhasil', 'Berhasil Menghapus Komentar');
        }else{
            Alert::error('Perhatian', 'Anda tidak berhak menghapus komentar ini');
        }

        return redirect('/pertanyaan/'.$pertanyaan_id);
    }
    public function destroykomentarjawaban($id)
    {
        $comment = CommentAnswer::find($id);
        $pertanyaan_id = $comment->answer->question_id;
        if ($comment->user_id==Auth::user()->id) {
            $comment->delete();
            Alert::success('Berhasil', 'Berhasil Menghapus Komentar');
        }else{
            Alert::error('Perhatian', 'Anda tidak berhak menghapus komentar ini');
        }

        return redirect('/pertanyaan/'.$pertanyaan_id);
    }
}
