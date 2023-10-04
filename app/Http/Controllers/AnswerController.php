<?php
/*
|--------------------------------------------------------------------------
| Created by www.aa96.me ~ AbdulKader Aliwi
| eng.aliwi@gmail.com
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;
use Auth;
use DB;

class AnswerController extends Controller
{
    public function index(Request $request)
    {
        $answers = Answer::orderBy('created_at', 'desc')->paginate(15);
        return view('backend.answers_index', compact('answers'));
    }

    public function store(Request $request)
    {
        $answer = new Answer;
        $answer->question_id = $request->question_id;
        if(Auth::check()){
            $answer->user_id = Auth::user()->id;
        }else{
            $answer->user_id = 0;
            $answer->writer = $request->name;
        }
        $answer->comment = $request->comment;
        $answer->save();

        flash('Answer submitted successfully')->success();
        return back();
    }

    public function delete($id)
    {

        if(Answer::destroy($id)){
            flash('User deleted successfully')->success();
            return redirect()->route('answers.index');
        }

        flash('Something is wrong')->error();
        return back();
    }

    public function updatePublished(Request $request)
    {
        $answer = Answer::findOrFail($request->id);
        $answer->status = $request->status;
        $answer->save();

        return 1;
    }
}
