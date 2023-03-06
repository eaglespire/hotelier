@extends('master')

@php
    $subAmount = $booking['price'] * $booking['nights'];
    $totalAmount = 10.00 + $subAmount;
    $email = $booking['email']
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="d-flex">
                                <h5 class="card-title flex-grow-1 mb-0">{{__('Room Details')}}</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0 vstack gap-3">
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ $booking['src'] }}" alt="" class="avatar-sm rounded">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-14 mb-1">{{ $booking['title'] }}</h6>
                                            <p class="fs-14 mb-1">Single</p>
                                            <p class="text-muted mb-0">{{ __('Room No') }} {{ $booking['number'] }}</p>
                                            <p class="fs-14 mb-1">$ {{ number_format($booking['price'],2) }}</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i>
                                {{__('Guest Information')}}
                            </h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                                <li class="fw-medium fs-14">{{ $booking['firstname'] }} {{ $booking['lastname'] }}</li>
                                <li>{{ $booking['email'] }}</li>
                                <li>{{ $booking['phone'] }}</li>
                                <li>{{ $booking['address'] }}</li>
                            </ul>
                            <h6>Date of arrival is {{ $booking['arrival'] }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i>
                                {{__('Order Details')}}
                            </h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                                <li class="fw-medium fs-14">{{ $booking['nights'] }} nights</li>
                                <li>Tax - $10.00</li>
                                <li>Sub-amount : {{ number_format($subAmount,2) }} </li>
                                <li>Total - $ {{ number_format($totalAmount,2) }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @include('partials.payment_popup', ['email' => $email,'amount' => $totalAmount])
        </div>
    </div>
@endsection
