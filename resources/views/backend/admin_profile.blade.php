@extends('backend.layout_app')

@section('content')

    <div class="col-lg-6  mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Profile</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                	@csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="new_password">New password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control"  name="new_password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="confirm_password">Confirm password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control"  name="confirm_password">
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
