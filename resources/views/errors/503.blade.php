<!doctype html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<title>Questions Forum</title>
    <link rel="stylesheet" href="{{ static_asset('assets/app.css') }}">
</head>
<body>
    <div class="maiin-wrapper d-flex">

        <div class="flex-grow-1">
            <section class="align-items-center d-flex h-100 bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 mx-auto text-center py-4">
                            <h3 class="fw-600 mt-5">The site is in Maintenance</h3>
                            <div class="lead">Visit us soon, we are working hard to improve your experience with us</div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    <script src="{{ static_asset('assets/app.js') }}" ></script>
    <script src="{{ static_asset('assets/notify.js') }}" ></script>


    <script type="text/javascript">
    @foreach (session('flash_notification', collect())->toArray() as $message)
        OBJ.tools.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
    @endforeach
    </script>
</body>
</html>
