<!doctype html>
<html lang="en">
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="{{ static_asset('assets/img/icon.png') }}">
    <title>Questions Forum</title>
	<link rel="stylesheet" href="{{ static_asset('assets/app.css') }}">
	<script>var OBJ = OBJ || {};</script>
</head>
<body class="">
	<div class="maiin-wrapper">
        <div class="sidebar-wraap">
            <div class="sidebar2 left c-scrollbar">
                <div class="side-nav-logo-wrap">
                    <a href="{{ route('admin.dashboard') }}" class="d-block text-center">
                        <h6 style="font-weight: bold;line-height: 1.5;color: white;">{{ env('APP_NAME') }}</h6>
                    </a>
                </div>
                <div class="side-nav-wrap">
                    <ul class="side-nav-list" id="main-menu">

                        <li class="aiz-side-nav-item">
                            <a href="{{route('admin.dashboard')}}" class="side-nav-link {{ areActiveRoutes(['admin.dashboard']) }}">
                                <i class="las la-home side-nav-icon"></i>
                                <span class="side-nav-text">Dashboard</span>
                            </a>
                        </li>

                        <li class="aiz-side-nav-item">
                            <a href="{{route('questions.index')}}" class="side-nav-link {{ areActiveRoutes(['questions.index','questions.edit','questions.create']) }}">
                                <i class="las la-question-circle side-nav-icon"></i>
                                <span class="side-nav-text"> Questions </span>
                            </a>
                        </li>

                        <li class="aiz-side-nav-item">
                            <a href="{{route('answers.index')}}" class="side-nav-link {{ areActiveRoutes(['answers.index']) }}">
                                <i class="las la-chart-pie side-nav-icon"></i>
                                <span class="side-nav-text"> Answers </span>
                            </a>
                        </li>


                        <li class="aiz-side-nav-item">
                            <a href="{{route('users.index')}}" class="side-nav-link {{ areActiveRoutes(['users.index']) }}">
                                <i class="las la-user-friends side-nav-icon"></i>
                                <span class="side-nav-text"> Users </span>
                            </a>
                        </li>

                        <li class="aiz-side-nav-item">
                            <a href="{{route('settings.index')}}" class="side-nav-link {{ areActiveRoutes(['settings.index']) }}">
                                <i class="las la-dharmachakra side-nav-icon"></i>
                                <span class="side-nav-text"> Settings </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sidebar2-overlay"></div>
        </div>

		<div class="wrapper-c">
            <div class="topbar-a px-15px px-lg-25px d-flex align-items-stretch justify-content-between" style=" position: absolute !important; ">
                <div class="d-flex justify-content-between align-items-stretch flex-grow-xl-1" style="flex-direction: row-reverse;">
                    <div class="d-flex justify-content-around align-items-center align-items-stretch">

                        <div class="topbar-a-item ml-2">
                            <div class="align-items-stretch d-flex dropdown">
                                <a class="dropdown-toggle no-arrow text-dark" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                    <div class="d-flex align-items-center">
                                        <div class="d-none d-md-block">
                                            <h5 style=" margin-bottom: 0 !important;color: white;" class="fw-500">{{Auth::user()->name}}</h5>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-md">
                                    <a href="{{ route('profile.index') }}" class="dropdown-item">
                                        <i class="las la-user-circle"></i>
                                        <span>Profile</span>
                                    </a>

                                    <a href="{{ route('logout')}}" class="dropdown-item">
                                        <i class="las la-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </div>
                        </div><!-- .topbar-a-item -->
                    </div>
                </div>
            </div><!-- .topbar-a -->
			<div class="m-content">
				<div class="px-15px px-lg-25px">
                    @yield('content')
				</div>
			</div><!-- .m-content -->
		</div><!-- .wrapper-c -->
	</div><!-- .maiin-wrapper -->

    @yield('modal')


	<script src="{{ static_asset('assets/app.js') }}" ></script>
	<script src="{{ static_asset('assets/notify.js') }}" ></script>

    @yield('script')

    <script type="text/javascript">
	    @foreach (session('flash_notification', collect())->toArray() as $message)
            OBJ.tools.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
	    @endforeach
    </script>

</body>
</html>
