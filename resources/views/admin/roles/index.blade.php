@extends('master')

@section('content')
    <x-container>
        <x-slot:header>
            @livewire('modules.roles.make-role')
        </x-slot:header>
        @livewire('modules.roles.roles-table')
    </x-container>
@endsection


