@extends('master')

@section('content')
    <x-container>
        <x-slot:header>
            @livewire('modules.users.create-user')
        </x-slot:header>
        @livewire('modules.users.users-table')
    </x-container>
@endsection

