@extends('app')

@section('content')
    <div class="text-muted text-center mx-lg-3">
        <h4 class="">Verify Your Email</h4>
        <p>Please enter the 4 digit code sent to <span class="fw-semibold">the email you provided during registration</span></p>
    </div>

    <div class="mt-4">
        @if(session('errors'))
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form autocomplete="off" method="post" action="{{ route('auth.submit') }}">
            @csrf
            <div class="row">
                <div class="col-3">
                    <div class="mb-3">
                        <label for="digit1-input" class="visually-hidden">Digit 1</label>
                        <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(1, event)"
                                maxLength="1" id="digit1-input" name="digit_1" >
                    </div>
                </div><!-- end col -->

                <div class="col-3">
                    <div class="mb-3">
                        <label for="digit2-input" class="visually-hidden">Digit 2</label>
                        <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(2, event)" maxLength="1"
                               id="digit2-input" name="digit_2">
                    </div>
                </div><!-- end col -->

                <div class="col-3">
                    <div class="mb-3">
                        <label for="digit3-input" class="visually-hidden">Digit 3</label>
                        <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(3, event)" maxLength="1"
                               id="digit3-input" name="digit_3">
                    </div>
                </div><!-- end col -->

                <div class="col-3">
                    <div class="mb-3">
                        <label for="digit4-input" class="visually-hidden">Digit 4</label>
                        <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(4, event)" maxLength="1"
                               id="digit4-input" name="digit_4">
                    </div>
                </div><!-- end col -->
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success w-100">Confirm</button>
            </div>

        </form>

    </div>

    <div class="mt-5 text-center">
        <form action="{{ route('auth.resend') }}" class="d-none" method="post" id="resend-otp">
            @csrf
        </form>
        <p class="mb-0">Didn't receive a code ?
            <a href="{{ route('auth.resend') }}" class="fw-semibold text-primary text-decoration-underline" onclick="event.preventDefault();
            document.getElementById('resend-otp').submit();">
                Resend
            </a>
        </p>
    </div>
@endsection
