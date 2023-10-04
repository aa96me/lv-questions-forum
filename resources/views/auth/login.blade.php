@extends('frontend.layout_app')

@section('content')
    <style>
    #add_question_button{
        display: none;
    }
    </style>
    <section class="gry-bg py-5">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-header">Log in</div>

                            <div class="px-4 py-3 py-lg-4">
                                <form class="pad-hor" method="POST" role="form" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email">

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <label class="checkboxx">
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <span class=opacity-60>Remember me</span>
                                                    <span class="square-check"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div>
                                            <button type="submit" class="btn btn-primary btn-lg btn-block">Log in</button>
                                        </div>
                                </form>
                                <div class="mt-3">
                                    Not a member ?<a href="{{route('register')}}" class="btn-link mar-rgt text-bold"> Signup Now </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
