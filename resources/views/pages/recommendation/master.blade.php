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
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link {{(request()->is('admin/recommendation/create') ? 'active disabled' : '')}} {{(request()->is('admin/recommendation/createbytree/'.last(request()->segments())) ? 'active disabled' : '')}}" href="{{ route('admin.recommendation.create')}}">Dapatkan rekomendasi</a>
                </li>
                @if (request()->is('admin/recommendation/createbytree/'.last(request()->segments())))
                    @php
                        $rec_id = 0;
                    @endphp
                @else    
                    @if (is_numeric(last(request()->segments())))
                        @php
                            $rec_id = $recommendation->id;    
                        @endphp
                    @else
                        @php
                            $rec_id = 0;
                        @endphp
                    @endif
                @endif
                <li class="nav-item">
                    <a class="nav-link {{(request()->is('admin/recommendation/'.$rec_id) ? 'active disabled' : 'disabled')}}">Hasil rekomendasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{(request()->is('admin/recommendation') ? 'active disabled' : '')}}" href="{{ route('admin.recommendation.index')}}">Sejarah rekomendasi</a>
                </li>
            </ul>
        </div>
    </div>
    @yield('recommendation')
@endsection