@extends('master')

@section('content')
    @livewire('booking.record-table',['phone' => $phone])
@endsection
