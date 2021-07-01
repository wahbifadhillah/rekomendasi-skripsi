@extends('templates.admin.master')
@section('title', 'Dataset')
@section('sidebar')
@endsection
@section('content_title')
    @parent
    Dataset
@endsection
@section('content_body')
    @parent
    @yield('filters')
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link {{(request()->is('admin/dataset') ? 'active disabled' : '')}}" href="{{ route('admin.dataset.index')}}">Dataset</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{(request()->is('admin/dataset/create') ? 'active disabled' : '')}}" href="{{ route('admin.dataset.create')}}">Input .csv</a>
                </li>
            </ul>
        </div>
    </div>
    @yield('dataset')
@endsection