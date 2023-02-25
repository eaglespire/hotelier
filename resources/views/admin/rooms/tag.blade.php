@extends('master')

@section('content')
    <div class="card card-body">
        <form method="post" action="{{ route('usr.room.tag-update') }}">
            @csrf
            @method('PUT')
            <div id="newlink">
                <div id="1">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="customername-field" class="form-label">{{__('Name')}}</label>
                                <input name="title" value="{{ $tag->title }}" type="text" id="customername-field"
                                       class="form-control @error('title') is-invalid @enderror"
                                       placeholder="Enter name"
                                       required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
            <input type="hidden" name="id" value="{{ $tag->id }}">
            <div class="col-lg-12">
                <div class="hstack gap-2">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
            <!--end col-->
        </form>
    </div>
@endsection
