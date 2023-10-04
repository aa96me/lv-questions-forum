<?php
/*
|--------------------------------------------------------------------------
| Created by www.aa96.me ~ AbdulKader Aliwi
| eng.aliwi@gmail.com
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{

    public function index()
    {
        $questions = Question::where('published',1)->orderBy('id', 'desc')->paginate(10);
        return view('frontend.index',compact('questions'));
    }


    public function profile(Request $request)
    {
        return view('frontend.user.user_profile');
    }

    public function my_questions(Request $request)
    {
        $questions = Question::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        return view('frontend.user.my_questions',compact('questions'));
    }

    public function question_add()
    {
        return view('frontend.user.add_question');
    }

    public function question_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|min:20',
            'description' => 'required|min:10'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors(['error' => 'At least the fields should be filled with text longer than this']);
        }

        $question = new Question();
        $question->question = $request->question;
        do {
            $temp_slug = rand(1000000000, 9999999999);
            $slug = Question::where('slug', $temp_slug)->first();
        } while (!empty($slug));
        $question->slug = strval($temp_slug);
        $question->description = $request->description;
        $question->user_id = Auth::user()->id;
        if($question->save()){
            flash('Question added successfully')->success();
            return redirect()->route('question', $question->slug);
        }
    }

    public function user_update_profile(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        //$user->email = $request->email;

        if ($request->new_password != null && ($request->new_password == $request->confirm_password)) {
            $user->password = Hash::make($request->new_password);
        }

        if ($user->save()) {
            flash('Your profile has been successfully modified')->success();
            return back();
        }

        flash('Sorry, try later')->error();
        return back();
    }

    public function question(Request $request, $slug)
    {
        $question  = Question::where('slug', $slug)->first();

        if ($question != null && $question->published) {
            return view('frontend.question_details', compact('question'));
        }
        abort(404);
    }
}
