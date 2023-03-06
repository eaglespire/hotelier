@extends('master')

@section('content')
    <div class="card card-header d-flex">
        <a href="{{ route('usr.room.all') }}" class="btn btn-primary align-self-end">{{__('All Rooms')}}</a>
    </div>
    <form action="{{ route('usr.room.store-room') }}" method="post" id="createproduct-form" autocomplete="off" class="needs-validation">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label>{{__('Description')}}</label>
                            <textarea
                                name="description" id="description"
                                class="form-control @error('description') is-invalid @enderror">{!! old('description') !!}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>{{__('Add extra information for room')}}</label>
                            <textarea name="extra" id="extra"
                                      class="form-control @error('extra') is-invalid @enderror">{!! old('extra') !!}</textarea>
                            @error('extra')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info" role="tab" aria-selected="true">
                                    General Info
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#addproduct-metadata" role="tab" aria-selected="false" tabindex="-1">
                                    Meta Data
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#addproduct-images" role="tab" aria-selected="false" tabindex="-1">
                                    Images
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- end card header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">{{__('Room Title')}}</label>
                                            <input name="title" type="text" value="{{ old('title') }}"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   id="title" placeholder="{{__('Enter room title')}}">
                                            @error('title')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="">{{__('Room Number')}}</label>
                                            <input name="room_number" type="number" value="{{ old('room_number') }}"
                                                   class="form-control @error('room_number') is-invalid @enderror" id=""
                                                   placeholder="{{ __('Enter Room Number') }}">
                                            @error('room_number')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="product-price-input">Price</label>
                                            <div class="input-group has-validation mb-3">
                                                <span class="input-group-text" id="product-price-addon">$</span>
                                                <input name="price" type="number" class="form-control @error('price') is-invalid @enderror"
                                                       id="product-price-input" placeholder="Enter price" value="{{ old('price') }}"
                                                       aria-label="Price" aria-describedby="product-price-addon" required="">
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end tab-pane -->

                            <div class="tab-pane" id="addproduct-metadata" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="meta-title-input">Meta title</label>
                                            <input name="meta_title" type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                                   placeholder="Enter meta title" id="meta-title-input" value="{{ old('meta_title') }}">
                                            @error('meta_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="meta-keywords-input">Meta Keywords</label>
                                            <input name="meta_keywords" type="text" class="form-control @error('meta_keywords') is-invalid @enderror"
                                                   placeholder="Enter meta keywords" id="meta-keywords-input" value="{{ old('meta_keywords') }}">
                                             @error('meta_keywords')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div>
                                    <label class="form-label" for="meta-description-input">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror"
                                      name="meta_description"
                                      placeholder="Enter meta description" rows="3">{{ old('meta_description') }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane" id="addproduct-images" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="choices-publish-status-input" class="form-label">{{__('First Image')}}</label>

                                            @if(!empty($images))
                                                <select class="form-select" id="choices-publish-status-input" name="image_1">
                                                    <option disabled>{{__('Please select')}}</option>
                                                    <option>{{__('None')}}</option>
                                                    @foreach($images as $image)
                                                        <option value="{{ $image->src }}">{{ $image->title }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="choices-publish-status-input" class="form-label">{{__('Second Image')}}</label>

                                            @if(!empty($images))
                                                <select class="form-select" id="choices-publish-status-input" name="image_2">
                                                    <option disabled>{{__('Please select')}}</option>
                                                    <option>{{__('None')}}</option>
                                                    @foreach($images as $image)
                                                        <option value="{{ $image->src }}">{{ $image->title }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="choices-publish-status-input" class="form-label">{{__('Third Image')}}</label>

                                            @if(!empty($images))
                                                <select class="form-select" id="choices-publish-status-input" name="image_3">
                                                    <option disabled>{{__('Please select')}}</option>
                                                    <option>{{__('None')}}</option>
                                                    @foreach($images as $image)
                                                        <option value="{{ $image->src }}">{{ $image->title }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="choices-publish-status-input" class="form-label">{{__('Fourth Image')}}</label>

                                            @if(!empty($images))
                                                <select class="form-select" id="choices-publish-status-input" name="image_4">
                                                    <option disabled>{{__('Please select')}}</option>
                                                    <option>{{__('None')}}</option>
                                                    @foreach($images as $image)
                                                        <option value="{{ $image->src }}">{{ $image->title }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="choices-publish-status-input" class="form-label">{{__('Fifth Image')}}</label>

                                            @if(!empty($images))
                                                <select class="form-select" id="choices-publish-status-input" name="image_5">
                                                    <option disabled>{{__('Please select')}}</option>
                                                    <option>{{__('None')}}</option>
                                                    @foreach($images as $image)
                                                        <option value="{{ $image->src }}">{{ $image->title }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="choices-publish-status-input" class="form-label">{{__('Sixth Image')}}</label>

                                            @if(!empty($images))
                                                <select class="form-select" id="choices-publish-status-input" name="image_6">
                                                    <option disabled>{{__('Please select')}}</option>
                                                    <option>{{__('None')}}</option>
                                                    @foreach($images as $image)
                                                        <option value="{{ $image->src }}">{{ $image->title }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                            </div>
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
            <!-- end col -->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{__('Status')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">{{__('Availability')}}</label>

                            <select class="form-select" id="choices-publish-status-input" name="available">
                                <option disabled>{{__('Please select')}}</option>
                                <option value="1" selected="">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div>
                            <label for="choices-publish-visibility-input" class="form-label">{{__('Cleaned')}}</label>
                            <select class="form-select" id="choices-publish-visibility-input" name="clean">
                                <option disabled>{{__('Please select')}}</option>
                                <option value="1" selected="">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{__('Category')}}</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2"> <a href="{{ route('usr.room.categories') }}" class="float-end text-decoration-underline">Add
                                New</a>{{__('Select room category')}}</p>
                        @if(!empty($categories))
                            <select class="form-select" id="choices-publish-status-input" name="category">
                                <option disabled>{{__('Please select')}}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id}}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{__('Tags')}}</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2"> <a href="{{ route('usr.room.tags') }}" class="float-end text-decoration-underline">Add
                                New</a>{{__('Select tags')}}</p>
                        @if(!empty($tags))
                            <select name="tags[]" class="form-select @error('tags') is-invalid @enderror" multiple>
                                <option disabled>{{__('Please select')}}</option>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id}}">{{ $tag->title }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{__('Features')}}</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2"> <a href="{{ route('usr.room.features') }}" class="float-end text-decoration-underline">Add
                                New</a>{{__('Select features')}}</p>
                        @if(!empty($features))
                            <select name="features[]" class="form-select @error('features') is-invalid @enderror" multiple>
                                <option disabled>{{__('Please select')}}</option>
                                @foreach($features as $feature)
                                    <option value="{{ $feature->id}}">{{ $feature->title }}</option>
                                @endforeach
                            </select>
                            @error('features')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->


            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </form>
@endsection

@section('scripts')

    <script src="{{ asset('dashboard/js/ckeditor/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#extra' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection

