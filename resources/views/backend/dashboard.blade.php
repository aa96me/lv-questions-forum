@extends('backend.layout_app')

@section('content')
@if(Auth::user()->id == 1)
<div class="row gutters-10">
            <div class="col-4">
                <div class="card">
                    <div class="bg-grad-3 text-white rounded-lg overflow-hidden" style=" padding: 10px; ">
                        <div class="media align-items-center">
                            <div class="avatar avatar-icon avatar-lg avatar-cyan">
                                <i class="las la-user" style=" font-size: 70px; "></i>
                            </div>
                            <div class="m-l-15">
                                <h2 class="m-b-0">{{ \App\Models\User::all()->count() }}</h2>
                                <p class="m-b-0">Users</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="bg-grad-3 text-white rounded-lg overflow-hidden" style=" padding: 10px; ">
                        <div class="media align-items-center">
                            <div class="avatar avatar-icon avatar-lg avatar-cyan">
                                <i class="las la-question-circle" style=" font-size: 70px; "></i>
                            </div>
                            <div class="m-l-15">
                                <h2 class="m-b-0">{{ \App\Models\Question::all()->count() }}</h2>
                                <p class="m-b-0">Questions</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="bg-grad-3 text-white rounded-lg overflow-hidden" style=" padding: 10px; ">
                        <div class="media align-items-center">
                            <div class="avatar avatar-icon avatar-lg avatar-cyan">
                                <i class="las la-chart-pie" style=" font-size: 70px; "></i>
                            </div>
                            <div class="m-l-15">
                                <h2 class="m-b-0">{{ \App\Models\Answer::all()->count() }}</h2>
                                <p class="m-b-0">Answers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
@endif

@endsection



