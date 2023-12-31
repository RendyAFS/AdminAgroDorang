@extends('layouts.app')

@section('content')
    <style>
        .card-header {
            background-color: #475889;
            color: #FFF
        }

        .card {
            background-color: #F6FFF6
        }

        /* Mendefinisikan animasi fade-in */
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        /* Mengaplikasikan animasi ke elemen dengan kelas .animated */
        .animated {
            animation-name: fadeIn;
            /* Menetapkan nama animasi */
            animation-duration: 1s;
            /* Durasi animasi (dalam detik) */
            animation-timing-function: ease-in-out;
            /* Fungsi waktu animasi (opsional) */
            animation-fill-mode: both;
            /* Mengatur elemen tetap dalam kondisi animasi pada akhir animasi (opsional) */
        }

        /* Opsional: Menyembunyikan elemen pada awalnya */
        .animated {
            opacity: 0;
        }
    </style>
    <div class="container mt-5 pt-5 animated">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @guest
                    <div class="card ">
                        <div class="card-header fs-3">{{ __('Login') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control shadow @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control shadow @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input shadow" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary shadow">
                                            {{ __('Login') }}
                                        </button>

                                        {{-- @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                <div class="d-flex justify-content-center">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header ">
                                    <h4>Login</h4>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Anda Sudah Login Sebelumnya</h5>
                                    <p class="card-text">Silahkan Masuk dengan klik button dibawah atau di atas</p>
                                    <a href="/dasboards" class="btn btn-primary">Masuk</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endguest
            </div>
        </div>
    </div>
@endsection
