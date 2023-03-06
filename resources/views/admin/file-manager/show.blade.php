@extends('master')

@section('content')
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                @livewire('modules.files.folder', ['folder' => $folder] )
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
