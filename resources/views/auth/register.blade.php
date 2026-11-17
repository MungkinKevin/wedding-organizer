@extends('layouts.app-login')

@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100" 
     style="background: url('{{ asset('images/backlog.png') }}') no-repeat center center / cover;">
    <div class="container">
        <div class="row justify-content-center">
           
            <div class="col-md-9 col-lg-8">
                <div class="card shadow-lg bg-white bg-opacity-90 border-0 overflow-hidden">
                    
                    <div class="row g-0">
                        
                        <!-- Bagian kiri -->
                        <div class="col-md-6 p-4">
                            <div class="text-center fs-4 fw-bold mb-3">{{ __('Register') }}</div>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
                                    <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="tel">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn text-white fw-bold" style="background-color: #ff69b4; border-color: #ff69b4;">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Bagian kanan -->
                         <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center text-center p-4 position-relative"
                             style="min-height: 520px; background: url('{{ asset('images/backkananlog.png') }}') center/cover no-repeat";>
                    
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