@extends('layouts.app-login')

@section('content')
<!-- BACKGROUND UTAMA -->
<div class="min-vh-100 d-flex align-items-center justify-content-center py-5" 

     style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('{{ asset('images/backlog.png') }}') center/cover no-repeat fixed;">

    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-lg-8 col-xl-7">
                <div class="card shadow-lg border-0 overflow-hidden" style="background: rgba(255, 255, 255, 0.95);">
                    
                    <div class="row g-0">
                        <!-- KOLOM KIRI (Form Login) -->
                        <div class="col-md-6 d-flex flex-column justify-content-center">
                            <div class="card-body p-4 p-md-5">
                                <h4 class="text-center fw-bold mb-4" style="color: #9b7599;">Login</h4>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="email" class="form-label text-muted small">{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label text-muted small">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label small text-muted" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a class="small text-decoration-none" style="color: #c5aeb5;" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>

                                    <div class="d-grid mb-2">
                                        <button type="submit" class="btn fw-bold py-2" style="background-color: #dfcbd7; color: white;">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- KOLOM KANAN (Banner Gambar & Teks) -->
                        <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center text-center p-4 position-relative"
                             style="min-height: 520px; background: url('{{ asset('images/backkananlog.png') }}') center/cover no-repeat";>
                            
                            <!-- Pembungkus Teks Agar Pas Di Tengah Bingkai Putih -->
                            <div style="max-width: 250px;">
                                <h3 class="fw-bold mb-4" style="color: #b8860b; font-family: serif;">Satria Wedding Organizer</h3>
                                <p class="fst-italic mb-2" style="color: #8b5a2b; font-size: 0.85rem;">Wujudkan Pernikahan Impian Anda</p>
                                <p class="text-muted" style="font-size: 0.75rem; line-height: 1.3;">
                                    Temukan vendor terbaik, inspirasi unik, dan kelola perencanaan pernikahan Anda dengan mudah dan spesial.
                                </p>
                            </div>

                        </div>
                    </div> 

                </div>
            </div>
        </div>
    </div>

</div>
@endsection