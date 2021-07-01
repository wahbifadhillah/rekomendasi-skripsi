<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - @yield('title')</title>
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <script src="{{ URL::asset('chart.js/chart.js') }}"></script>
    <script src="{{ URL::asset('viz.js/viz.js') }}"></script>
    <script src="{{ URL::asset('viz.js/full.render.js') }}"></script>
    <script src="{{ URL::asset('interactjs/interact.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('svgdotjs/svg.draggable.js') }}"></script> --}}
    {{-- <script src="{{ URL::asset('svgdotjs/svg.js.map') }}"></script>
    <script src="{{ URL::asset('svgdotjs/svg.draggable.js.map') }}"></script> --}}
</head>
<body>
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
    @yield('tree_script')
</body>
</html>