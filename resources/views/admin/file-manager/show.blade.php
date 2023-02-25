@extends('master')

@section('content')
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="row gallery-wrapper" style="position: relative; height: 1015.47px;">
                    @if(sizeof($files) !== 0)
                        @foreach($files as $file)
                           <x-gallery-card :src="$file->src" :title="$file->title" />
                        @endforeach
                    @else
                        <div class="card card-body">
                            <p class="card-text">{{ __('Folder is empty')  }}</p>
                        </div>
                    @endif
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end row -->
    </div>
@endsection

@section('scripts')
    <script src="/dashboard/libs/glightbox/js/glightbox.min.js"></script>
    <script src="/dashboard/libs/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/dashboard/js/pages/gallery.init.js"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="/dashboard/libs/glightbox/css/glightbox.min.css">
@endsection
