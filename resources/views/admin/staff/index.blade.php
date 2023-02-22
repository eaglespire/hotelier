@extends('master')

@section('content')
    <x-container>
        <x-slot:header>
            @livewire('modules.staff.add-staff')
        </x-slot:header>
        @livewire('modules.staff.staff-table')
    </x-container>
@endsection

