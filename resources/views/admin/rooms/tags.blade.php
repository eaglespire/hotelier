@extends('master')

@section('content')
    <x-container>
        <x-slot:header>
            @livewire('modules.rooms.add-tag')
        </x-slot:header>
        @livewire('modules.rooms.tags-table')
    </x-container>
@endsection
