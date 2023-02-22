@extends('master')

@section('content')
    <div class="card card-body">
        <form method="post" enctype="multipart/form-data" action="{{ route('usr.update-staff') }}">
            @csrf
            <div id="newlink">
                <div id="1">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="jobTitle" class="form-label">{{ __('FirstName') }}</label>
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                       id="jobTitle" placeholder="Job title" value="{{ $staff->user->firstname }}"
                                name="firstname">
                            </div>
                            @error('firstname')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="jobTitle" class="form-label">{{__('Lastname')}}</label>
                                <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                       id="jobTitle" placeholder="Job title" value="{{ $staff->user->lastname }}"
                                name="lastname">
                            </div>
                            @error('lastname')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="companyName" class="form-label">{{__('Staff Number')}}</label>
                                <input readonly type="text" class="form-control" id="companyName" placeholder="Company name"
                                       value="{{ $staff->staff_number }}" name="staff_number">
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="experienceYear" class="form-label">{{__('Role')}}</label>
                                        <select class="form-control" data-choices="" data-choices-search-false="" name="role" id="experienceYear">
                                            <option disabled>{{ __('Select role') }}</option>
                                            @if(sizeof($roles) !== 0)
                                                @foreach($roles as $role)
                                                    <option {{ $staff->role == $role->name ? 'selected' : null }} value="{{ $role->name }}">
                                                        {{ $role->title }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-6">
                                        <label for="experienceYear" class="form-label">{{__('Gender')}}</label>
                                        <select class="form-control" data-choices="" data-choices-search-false="" name="gender">
                                            <option disabled>{{ __('Select gender') }}</option>
                                            <option value="male">{{__('Male')}}</option>
                                            <option value="female">{{__('Female')}}</option>
                                            <option value="others">{{__('Others')}}</option>
                                        </select>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="jobDescription" class="form-label">{{__('Street')}}</label>
                                <input type="text" class="form-control @error('street') is-invalid @enderror"
                                       id="companyName" placeholder="Company name"
                                       value="{{ $staff->street }}" name="street">
                            </div>
                            @error('street')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="jobDescription" class="form-label">{{__('City')}}</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror"
                                       id="companyName" placeholder="Company name"
                                       value="{{ $staff->city }}" name="city">
                            </div>
                            @error('city')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="jobDescription" class="form-label">{{__('State')}}</label>
                                <input type="text" class="form-control @error('state') is-invalid @enderror"
                                       id="companyName" placeholder="Company name"
                                       value="{{ $staff->state }}" name="state">
                            </div>
                            @error('state')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="jobDescription" class="form-label">{{__('Country')}}</label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror"
                                       id="companyName" placeholder="Company name"
                                       value="{{ $staff->country }}" name="country">
                            </div>
                            @error('country')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="jobDescription" class="form-label">{{__('Zip')}}</label>
                                <input type="text" class="form-control @error('zip') is-invalid @enderror"
                                       id="companyName" placeholder="Company name"
                                       value="{{ $staff->zip }}" name="zip">
                            </div>
                            @error('zip')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="jobDescription" class="form-label">{{__('Age')}}</label>
                                <input type="number" class="form-control @error('age') is-invalid @enderror"
                                       id="companyName" placeholder="Company name"
                                       value="{{ $staff->age }}" name="age">
                            </div>
                            @error('age')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="jobDescription" class="form-label">{{__('Date Joined')}}</label>
                                <input type="date" class="form-control" id="companyName" name="doe" value="{{ $staff->doe }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="jobDescription" class="form-label">{{__('Photo')}}</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="companyName" name="photo">
                            </div>
                            @error('photo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--end col-->
                        <div class="hstack gap-2 justify-content-end">
                            <a class="btn btn-success" href="javascript:deleteEl(1)">Delete</a>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
            <input type="hidden" name="user_id" value="{{ $staff->id }}">
            <div id="newForm" style="display: none;">

            </div>
            <div class="col-lg-12">
                <div class="hstack gap-2">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="javascript:new_link()" class="btn btn-primary">Add New</a>
                </div>
            </div>
            <!--end col-->
        </form>
    </div>
@endsection
