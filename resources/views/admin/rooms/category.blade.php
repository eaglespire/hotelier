@extends('master')

@section('content')
    <div class="card card-body">
        <form method="post" enctype="multipart/form-data" action="{{ route('usr.room.category-update') }}">
            @csrf
            @method('PUT')
            <div id="newlink">
                <div id="1">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="jobTitle" class="form-label">{{ __('Name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="jobTitle" placeholder="Name" value="{{ $category->name }}"
                                       name="name">
                            </div>
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="jobTitle" class="form-label">{{__('Description')}}</label>
                                <textarea name="description" id="" cols="30" rows="5"
                                          class="form-control @error('description') is-invalid @enderror">{{ $category->description }}</textarea>
                            </div>
                            @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
            </div>
            <input type="hidden" name="id" value="{{ $category->id }}">
            <div id="newForm" style="display: none;">

            </div>
            <div class="col-lg-12">
                <div class="hstack gap-2">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
            <!--end col-->
        </form>
    </div>
@endsection
