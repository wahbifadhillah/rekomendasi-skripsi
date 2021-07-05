@extends('templates.admin.master')
@section('title', 'Dapatkan Rekomendasi')
@section('sidebar')
@endsection
@section('content_title')
    @parent
    Dapatkan Rekomendasi
@endsection
@section('content_body')
    @parent
    @yield('filters')
    @php($route_prefix = NULL)
    @if (auth()->user()->role == 'kaprodi')
        @php($route_prefix = 'admin')
    @else
        @php($route_prefix = 'kjfd')
    @endif
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link {{(\Request::is('*/recommendation/create') ? 'active disabled' : '')}} {{(\Request::is('*/recommendation/createbytree/'.last(request()->segments())) ? 'active disabled' : '')}}" href="{{ route($route_prefix.'.recommendation.create')}}">Dapatkan rekomendasi</a>
                </li>
                @if (\Request::is('*/recommendation/createbytree/'.last(request()->segments())))
                    @php($rec_id = 0)
                @else    
                    @if (is_numeric(last(request()->segments())))
                        @php($rec_id = $recommendation->id)
                    @else
                        @php($rec_id = 0)
                    @endif
                @endif
                <li class="nav-item">
                    <a class="nav-link {{(\Request::is('*/recommendation/'.$rec_id) ? 'active disabled' : 'disabled')}}">Hasil rekomendasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{(\Request::is('*/recommendation') ? 'active disabled' : '')}}" href="{{ route($route_prefix.'.recommendation.index')}}">Sejarah rekomendasi</a>
                </li>
            </ul>
        </div>
    </div>
    @yield('recommendation')
@endsection