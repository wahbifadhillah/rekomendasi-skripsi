<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <script src="{{ URL::asset('chart.js/chart.js') }}"></script>
    <script src="{{ URL::asset('viz.js/viz.js') }}"></script>
    <script src="{{ URL::asset('viz.js/lite.render.js') }}"></script>
    <script src="{{ URL::asset('interactjs/interact.min.js') }}"></script>
</head>
<body>
    @component('components.admin.navbar')
        @slot('brand')
            Sistem Rekomendasi Bidang Skripsi
        @endslot
    @endcomponent
    <div class="container-fluid px-0">
        <div class="row g-0">
            <div class="col-2">
                <nav id="sidebar">
                    @component('components.admin.sidebar')
                    @slot('brand')
                    Sistem Rekomendasi Bidang Skripsi
                    @endslot
                    @endcomponent
                </nav>
            </div>
            <div class="col-10">
                <section id="content">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {!!Session::get('success')!!}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (Session::has('file_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {!!Session::get('file_success')!!}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (Session::has('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {!!Session::get('warning')!!}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @component('components.admin.content')
                        @slot('head')
                            @yield('content_title')
                        @endslot
                        @slot('body')
                            @yield('content_body')
                        @endslot
                    @endcomponent
                </section>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('js/app.js') }}"></script>
    @if (Session::has('success'))
    <script>
        
    </script>
    @endif
    @yield('tree_script')
</body>
</html>