@extends('templates.admin.master')
@section('title', 'Configuration')
@section('sidebar')
@endsection
@section('content_title')
    @parent
    Konfigurasi
@endsection
@section('content_body')
    @parent
    {{-- @parent
    nav tabs --}}
    @yield('configuration')
@endsection