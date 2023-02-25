@extends('master')

@section('content')
    <x-container>
        <x-slot:header>
            @livewire('modules.files.add-file')
        </x-slot:header>
        <div class="file-manager-content w-100 p-3 py-0">
            <div id="folder-list" class="mb-2">
                <div class="row" id="folderlist-data">
                    <div class="col-xxl-3 col-6">
                        <x-folder name="Posts" folder="posts" />
                    </div>
                    <div class="col-xxl-3 col-6">
                        <x-folder name="Rooms" folder="rooms" />
                    </div>
                    <div class="col-xxl-3 col-6">
                        <x-folder name="Gallery" folder="gallery" />
                    </div>
                    <div class="col-xxl-3 col-6">
                        <x-folder name="Others" folder="others" />
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </x-container>
@endsection
