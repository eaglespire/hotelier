@extends('master')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#column1" role="tab" aria-selected="false" tabindex="-1">
                                <i class="fas fa-home"></i> Column 1
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#column2" role="tab" aria-selected="false" tabindex="-1">
                                <i class="far fa-user"></i> Column 2
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#column3" role="tab" aria-selected="false" tabindex="-1">
                                <i class="far fa-envelope"></i> Column 3
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#column4" role="tab" aria-selected="true">
                                <i class="far fa-envelope"></i> Column 4
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        @include('partials.footer-settings._column_1')
                        @include('partials.footer-settings._column_2')
                        @include('partials.footer-settings._column-3')
                        @include('partials.footer-settings._column_4')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('dashboard/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/custom.js') }}"></script>
@endpush
