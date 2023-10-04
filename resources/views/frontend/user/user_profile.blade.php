@extends('frontend.layout_app')
@section('content')
    <style>
    #add_question_button{
        display: none;
    }
    </style>
    <section class="py-5">
        <div class="container">
            <div class="d-flex align-items-start">
                <div class="user-panel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Profile</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.profile.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Username</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="name"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Email</label>
                                    <div class="col-md-10">
                                        <input type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Password</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control"
                                            name="new_password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Confirm Password</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control"
                                            name="confirm_password">
                                    </div>
                                </div>

                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                            <br>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
