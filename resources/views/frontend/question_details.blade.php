@php
$photos = explode(',', $question->photos);
@endphp
@extends('frontend.layout_app')

@section('meta_title'){{ $question->question }}@stop

@section('meta_description'){{ $question->description }}@stop

@section('content')
    <section class="mb-4 pt-3">
        <div class="container">
            <h3 class="h5 fw-700 mb-0" style=" background-color: #de4e07; padding: 10px 10px 0px 0px; color: #fff; ">
                <span class="pb-3 d-inline-block ml-3">Question</span>
            </h3>
            <div class="bg-white shadow-sm rounded pr-4 pl-4 pt-2 pb-2">
                <div class="row ">
                    <div class="col-xl-2 col-lg-6 mb-6 p-3 bg-light text-center" style="min-height: 100px">
                        @if ($question->user)
                            <h4>{{ $question->user->name }}</h4>
                            <img src="{{ static_asset('assets/img/avatar.webp') }}"
                                alt="{{ $question->user->name }}" class="mw-100 h-40px h-md-100px">
                            <table class="table table-striped mb-0">
                                <tbody>
                                    <tr>
                                        <td class="p-0">Membership</td>
                                        <td class="p-0">{{ $question->user->id }}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-0">Join Date</td>
                                        <td class="p-0">
                                            {{ $question->user->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-0">Activities</td>
                                        <td class="p-0">
                                            {{ \App\Models\Question::where('user_id', $question->user->id)->count() + \App\Models\Answer::where('user_id', $question->user->id)->count() }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <h4>Anonymous</h4>
                            <img src="{{ static_asset('assets/img/avatar.webp') }}" alt="Anonymous"
                                class="mw-100 h-40px h-md-100px">

                        @endif
                    </div>
                    <div class="col-xl-10 col-lg-6">
                        <div id="title" class="text-left">
                            <h5 class="mb-2 fw-600 text-break">
                                {{ $question->question }}
                            </h5>
                            <p class="text-break">{{ $question->description }}</p>
                            <br>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="mb-4 pt-3">
        <div class="container">
            <h3 class="h5 fw-700 mb-0" style=" background-color: #de4e07; padding: 10px 10px 0px 0px; color: #fff; ">
                <span class="pb-3 d-inline-block ml-3">Answers</span>
            </h3>
            <div class="bg-white shadow-sm rounded pr-4 pl-4 pt-2 pb-2">
                @foreach ($question->answers as $key => $answer)
                    @if ($answer->user != null)
                        <div class="row ">
                            <div class="col-xl-2 col-lg-6 mb-6 p-3 text-center"
                                style="background-color: #efefef40;min-height: 300px">
                                @if ($answer->user->name)
                                    <h4>{{ $answer->user->name }}</h4>
                                    <img src="{{ static_asset('assets/img/avatar.webp') }}"
                                        alt="{{ $answer->user->name }}" class="mw-100 h-40px h-md-100px">
                                    <table class="table table-striped mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="p-0">Activities</td>
                                                <td class="p-0">
                                                    {{ \App\Models\Question::where('user_id', $answer->user->id)->count() + \App\Models\Answer::where('user_id', $answer->user->id)->count() }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <h4>Guest</h4>
                                    <img src="{{ static_asset('assets/img/avatar.webp') }}" alt="guest"
                                        class="mw-100 h-40px h-md-100px">
                                @endif
                            </div>
                            <div class="col-xl-9 col-lg-5">
                                <div id="title">
                                    <p>{{ $answer->comment }}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @elseif($answer->user == 0)
                        <div class="row ">
                            <div class="col-xl-2 col-lg-6 mb-6 p-3 text-center"
                                style="background-color: #efefef40;min-height: 100px">
                                <h4>{{ $answer->writer }}</h4>
                                <img src="{{ static_asset('assets/img/avatar.webp') }}" alt="guest"
                                    class="mw-100 h-40px h-md-100px">
                                <p class="text-muted p-2">Guest</p>
                            </div>
                            <div class="col-xl-9 col-lg-5">
                                <div id="title">
                                    <p>{{ $answer->comment }}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endif

                @endforeach

                @if (count($question->answers) <= 0)
                    <div class="p-4">
                        <div class="text-center fs-18 opacity-70">There are no answers yet, if you have an answer add it.</div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="mb-4 pt-3">
        <div class="container">
            <h3 class="h5 fw-700 mb-0" style=" background-color: #de4e07; padding: 10px 10px 0px 0px; color: #fff; ">
                <span class="pb-3 d-inline-block ml-3">Add Answer</span>
            </h3>
            <div class="bg-white shadow-sm rounded p-4">
                <div class="p-4">
                    @if (Auth::check())
                        <div class="pt-4">
                            <form class="form-default" role="form" action="{{ route('answers.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="question_id" value="{{ $question->id }}">
                                <div class="form-group">
                                    <label class="opacity-60">Answer</label>
                                    <textarea class="form-control" rows="4" name="comment" required></textarea>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary mt-3">
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="pt-4">
                            <form class="form-default" role="form" action="{{ route('answers.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="question_id" value="{{ $question->id }}">
                                <div class="form-group">
                                    <label class="opacity-60">Your Name</label>
                                    <input class="form-control" name="name" required />
                                </div>
                                <div class="form-group">
                                    <label class="opacity-60">Your answer</label>
                                    <textarea class="form-control" rows="4" name="comment" required></textarea>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary mt-3">
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
