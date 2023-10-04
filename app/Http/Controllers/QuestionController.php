<?php
/*
|--------------------------------------------------------------------------
| Created by www.aa96.me ~ AbdulKader Aliwi
| eng.aliwi@gmail.com
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Auth;
use Session;
use ImageOptimizer;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Artisan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

class QuestionController extends Controller
{

    public function index(Request $request)
    {

        $questions = Question::orderBy('id', 'desc');
        $publication = $request->publication;
        if (isset($publication) && $publication != 'all') {
            $questions = $questions->where('published', $publication);
        }

        $questions = $questions->paginate(20);

        return view('backend.questions.index', compact('questions', 'publication'));
    }

    public function create()
    {
        return view('backend.questions.create');
    }

    public function store(Request $request)
    {
        $question = new Question;
        $question->question = $request->question;
        do {
            $temp_slug = rand(1000000000, 9999999999);
            $slug = Question::where('slug', $temp_slug)->first();
        } while (!empty($slug));
        $question->slug = strval($temp_slug);;
        $question->user_id = Auth::user()->id;
        $question->description = $request->description;
        $question->save();

        flash('Question added successfully')->success();

        Artisan::call('view:clear');
        Artisan::call('cache:clear');

        return redirect()->route('questions.index');
    }

    public function edit(Request $request, $id)
    {
      $question = Question::findOrFail($id);
      return view('backend.questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->question          = $request->question;
        $question->save();

            flash('Question edited successfully')->success();
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
        return back();
    }

    public function delete($id)
    {
        if (Question::destroy($id)) {

            flash('Question deleted successfully')->success();

            Artisan::call('view:clear');
            Artisan::call('cache:clear');

            return redirect()->route('questions.index');
        } else {
            flash('Sorry! There is something wrong.')->error();
            return back();
        }
    }

    public function updatePublished(Request $request)
    {
        $question = Question::findOrFail($request->id);
        $question->published = $request->status;
        $question->save();
        return 1;
    }

}
