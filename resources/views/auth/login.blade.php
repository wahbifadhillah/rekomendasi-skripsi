@extends('layouts.app')

@section('content')
<div class="row d-flex justify-content-center align-middle" id="login-box">
    <aside class="col-sm-3">
        <div class="card shadow" id="login-card">
        <article class="card-body">
        <h4 class="card-title mb-1 mt-1">{{ __('Login') }}</h4>
        <small class="mb-4 d-block">Sistem Rekomendasi Bidang Skripsi</small>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label>{{ __('E-mail') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email')}}" placeholder="Alamat e-mail" required  autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> <!-- form-group// -->
                <div class="form-group">
                    <label>{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="••••••" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> <!-- form-group// --> 
                @if (Session::has('error'))
                <div class="text-danger">
                    <small>
                        {{ Session::get('error') }}
                    </small>
                </div>
                @endif
                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Login') }}
                    </button>
                </div> <!-- form-group// -->                                                           
            </form>
        </article>
        </div> <!-- card.// -->

    </aside> <!-- col.// -->
</div>
@endsection
