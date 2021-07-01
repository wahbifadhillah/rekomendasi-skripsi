@extends('templates.admin.master')
@section('title', 'Training')
@section('sidebar')
@endsection
@section('content_title')
    @parent
    Data Latih
@endsection
@section('content_body')
    @parent
    <div class="d-flex justify-content-end mb-4">
        <a href="{{route('admin.training.train')}}" class="btn btn-primary {{$trainings ? '':'disabled'}}">Latih dan uji model</a>
    </div>
    @yield('training')
@endsection