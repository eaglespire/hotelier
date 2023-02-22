@extends('master')

@section('content')
    <div class="card" id="customerList">
        <div class="card-header border-bottom-dashed">

            <div class="row g-4 align-items-center">
                <div class="col-sm">
                    <div>
                        <h5 class="card-title mb-0">{{__('Edit Role')}}</h5>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="d-flex flex-wrap align-items-start gap-2">

                    </div>
                </div>
            </div>
        </div>
        @livewire('modules.roles.edit-role', ['role'=>$role])
    </div>
@endsection
