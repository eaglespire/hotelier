@extends('app')

@section('content')
    <div>
        <h5 class="text-primary">Register Account</h5>
        <p class="text-muted">Get your Free {{ config('app.name') }} account now.</p>
    </div>

    <div class="mt-4">
        <form class="needs-validation" action="{{ route('register') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email address"
                       required value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Firstname <span class="text-danger">*</span></label>
                <input name="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror"  placeholder="Enter firstname"
                       required value="{{ old('firstname') }}">
                @error('firstname')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Lastname <span class="text-danger">*</span></label>
                <input name="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" placeholder="Enter lastname"
                       required value="{{ old('lastname') }}">
                @error('lastname')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="password-input">Password</label>
                <div class="position-relative auth-pass-inputgroup">
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror pe-5 password-input"
                           onpaste="return false"
                           placeholder="Enter password"
                           id="password-input" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Password Confirmation <span class="text-danger">*</span></label>
                <input name="password_confirmation" type="password" class="form-control"
                       placeholder="Enter password again" required>
            </div>

            <div class="mb-4">
                <p class="mb-0 fs-12 text-muted fst-italic">By registering you agree to the Velzon <a href="#" class="text-primary text-decoration-underline fst-normal fw-medium">Terms of Use</a></p>
            </div>

            <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                <h5 class="fs-13">Password must contain:</h5>
                <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>
            </div>

            <div class="mt-4">
                <button class="btn btn-success w-100" type="submit">Sign Up</button>
            </div>

            <div class="mt-4 text-center">
                <div class="signin-other-title">
                    <h5 class="fs-13 mb-4 title text-muted">Create account with</h5>
                </div>

                <div>
                    <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-facebook-fill fs-16"></i></button>
                    <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-google-fill fs-16"></i></button>
                    <button type="button" class="btn btn-dark btn-icon waves-effect waves-light"><i class="ri-github-fill fs-16"></i></button>
                    <button type="button" class="btn btn-info btn-icon waves-effect waves-light"><i class="ri-twitter-fill fs-16"></i></button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-5 text-center">
        <p class="mb-0">Already have an account ? <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-underline"> Signin</a>
        </p>
    </div>
@endsection

@push('scripts')
    <!-- validation init -->
    <script src="/dashboard/js/pages/form-validation.init.js"></script>
    <!-- password create init -->
    <script src="/dashboard/js/pages/passowrd-create.init.js"></script>
@endpush
