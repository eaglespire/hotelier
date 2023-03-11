@extends('master')

@section('content')
    <x-container>
        <x-slot:header>
            <a href="{{ route('usr.booking.create') }}" class="btn btn-primary">
                <i class="ri-add-line align-bottom me-1"></i>
                {{__('Add New Booking')}}
            </a>
        </x-slot:header>
        @livewire('booking.records-table')
    </x-container>
@endsection

