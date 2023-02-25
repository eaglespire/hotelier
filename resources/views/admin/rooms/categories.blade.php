@extends('master')

@section('content')
    <x-container>
        <x-slot:header>
            @livewire('modules.rooms.add-category')
        </x-slot:header>
        @livewire('modules.rooms.room-categories-table')
    </x-container>
@endsection
