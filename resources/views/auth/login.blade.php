@extends('app')

@section('content')
    <div>
        <h5 class="text-primary">Welcome Back !</h5>
        <p class="text-muted">Sign in to continue to {{ config('app.name') }}.</p>
    </div>

    <div class="mt-4">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Staff ID or Email</label>
                <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Enter staff id or email">
                 @error('username')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <div class="float-end">
                    <a href="auth-pass-reset-cover.html" class="text-muted">Forgot password?</a>
                </div>
                <label class="form-label" for="password-input">Password</label>
                <div class="position-relative auth-pass-inputgroup mb-3">
                    <input name="password" type="password" class="form-control pe-5 @error('password') is-invalid @enderror" placeholder="Enter password"
                           id="password-input">
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                </div>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                <label class="form-check-label" for="auth-remember-check">Remember me</label>
            </div>

            <div class="mt-4">
                <button class="btn btn-success w-100" type="submit">Sign In</button>
            </div>
        </form>
    </div>
    <div class="mt-5 text-center">
        <p class="mb-0">Don't have an account ? <a href="{{ route('register') }}" class="fw-semibold text-primary text-decoration-underline"> Signup</a>
        </p>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('dashboard/js/pages/password-addon.init.js') }}"></script>
@endpush
