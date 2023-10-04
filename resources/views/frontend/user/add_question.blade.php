@extends('frontend.layout_app')

@section('content')
    <style>
        #add_question_button{
            display: none;
        }
    </style>
    <div id="section_featured">
        <section class="mb-4 mt-4">
            <div class="container">
                <h3 class="h5 fw-700 mb-0" style=" background-color: #de4e07; padding: 10px 10px 0px 0px; color: #fff; ">
                    <span class="pb-3 d-inline-block ml-3">Add a Question</span>
                </h3>
                <div class="bg-white shadow-sm rounded p-4">
                    <div class="p-4">
                        @if (Auth::check())
                            <div class="pt-4">
                                <form class="form-default" role="form" action="{{ route('question.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Question</label>
                                        <input class="form-control" name="question" value="{{ old('text') }}" required />
                                        <small>* Write the question clearly (min:20)</small>
                                        <br>
                                    </div>
                                    <div class="form-group">
                                        <label>Additional details</label>
                                        <textarea class="form-control" rows="4" name="description" required>{{ old('description') }}</textarea>
                                        <small>* Write any details accompanying the question (min:10)</small>
                                    </div>

                                    @if ($errors->has('error'))
                                        <ul>
                                            <li><strong style=" color: red; ">{{ $errors->first() }}</strong></li>
                                        </ul>
                                    @endif

                                    <div class="text-right">

                                        <button type="submit" class="btn btn-primary mt-3">
                                            Add
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <p>Only registered members can add questions</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('script')
@endsection
