@extends('templates.admin.master')
@section('title', 'Testing')
@section('sidebar')
@endsection
@section('content_title')
    @parent
    Data Uji
@endsection
@section('content_body')
    @parent
    {{-- @parent
    nav tabs --}}
    @yield('testing')
@endsection