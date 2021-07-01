@extends('templates.admin.master')
@section('title', 'Dashboard')
@section('sidebar')
@endsection
@section('content_title')
    @parent
    Dashboard
@endsection
@section('content_body')
    @parent   
    @yield('filters')
    @yield('dashboard')
@endsection