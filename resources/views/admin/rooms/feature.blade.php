@extends('master')

@section('content')
    @livewire('modules.rooms.edit-feature', ['feature'=>$feature])
@endsection
