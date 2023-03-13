@extends('master')
@section('content')
    <div class="row">
        <div class="col">
            <form action="{{ route('usr.settings.save-to-footer') }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <!--end col-->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="lastnameInput" class="form-label">{{__('Column Text')}}</label>
                            <input name="title" type="text" class="form-control" id="lastnameInput"
                                   placeholder="Enter column text" value="{{ $footer->title }}">
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="phonenumberInput" class="form-label">{{__('Include an icon ?')}}</label>
                            <select class="form-control select-icon-4">
                                <option value="">Please Choose</option>
                                <option value="yes">{{__('Yes')}}</option>
                                <option value="no">{{__('No')}}</option>
                            </select>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-6 choose-icon-4" id="">
                        <div class="mb-3">
                            <label for="phonenumberInput" class="form-label">{{__('Choose Icon')}}</label>
                            <select name="icon" id="" class="form-control">
                                <option value="">Please Choose</option>
                                <option value="lab la-accessible-icon ">Accessible</option>
                                <option value="las la-tty">Phone</option>
                                <option value="lab la-dropbox ">DropBox</option>
                            </select>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="phonenumberInput" class="form-label">{{__('Make this a link?')}}</label>
                            <select class="form-control" id="make-link-4">
                                <option value="Please Choose">Please Choose</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-6">
                        <div class="mb-3" id="pick-link-4">
                            <label for="phonenumberInput" class="form-label">{{__('Link to?')}}</label>
                            <select name="link" id="" class="form-control">
                                <option disabled>Please Choose</option>
                                <option value="/">Home Page</option>
                                <option value="/about">About</option>
                                <option value="/services">Services</option>
                                <option value="/contact">Contact</option>
                            </select>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-12">
                        <div class="hstack gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('dashboard/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/custom.js') }}"></script>
@endpush
