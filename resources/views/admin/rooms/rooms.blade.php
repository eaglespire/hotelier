@extends('master')
@section('content')
    <x-container>
        <x-slot:header>
            <a href="{{ route('usr.room.create-room') }}" class="btn btn-primary">
                <i class="ri-add-line align-bottom me-1"></i>
                {{__('Add New Room')}}
            </a>
        </x-slot:header>
        @livewire('modules.rooms.rooms-table')
    </x-container>
@endsection


