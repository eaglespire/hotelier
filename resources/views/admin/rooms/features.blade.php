@extends('master')

@section('content')
    <x-container>
        <x-slot:header>
            @livewire('modules.rooms.add-feature')
        </x-slot:header>
        @livewire('modules.rooms.features-table')
    </x-container>
@endsection
