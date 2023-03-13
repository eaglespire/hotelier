<div class="tab-pane" id="column1" role="tabpanel">
    <div class="card card-header">
        @if(!empty($footerOneTitle) && $footerOneTitle->title_type == 'text')
            <div class="mb-3">
                <label for="" class="form-label">Configured Title</label>
                <input disabled type="text" class="form-control" value="{{ $footerOneTitle->title }}">
            </div>
        @endif

            @if(!empty($footerOneTitle) && $footerOneTitle->title_type == 'image')
                <div class="mb-3">
                    <label for="" class="form-label">Configured Image</label> <br>
                    <img src="{{ $footerOneTitle->title }}" alt="image" width="100" height="50">
                </div>
            @endif

        <form action="{{ route('usr.settings.save-to-footer-title') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="column" value="one">
            <div class="mb-3">
                <label for="firstnameInput" class="form-label">{{__('Column Type')}}</label>
                <select class="form-control column-title" name="title_type">
                    <option disabled>Please Choose</option>
                    <option value="text">Text</option>
                    <option value="image">Image</option>
                </select>
            </div>
            <div class="mb-3 title-string">
                <label for="" class="form-label">Title</label>
                <input name="title" type="text" class="form-control" placeholder="Enter Title" value="">
            </div>
            <div class="mb-3 title-image">
                <label for="" class="form-label">Image</label>
                <input name="image" type="file" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    @livewire('footer.footer-settings-table', ['footers' => $footerOne])

    <form action="{{ route('usr.settings.save-to-footer') }}" method="post">
        @csrf
        <input type="hidden" name="column" value="one">
        <div class="row">
            <!--end col-->
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="lastnameInput" class="form-label">{{__('Column Text')}}</label>
                    <input name="title" type="text" class="form-control" id="lastnameInput" placeholder="Enter column text">
                </div>
            </div>
            <!--end col-->
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="phonenumberInput" class="form-label">{{__('Include an icon ?')}}</label>
                    <select class="form-control select-icon">
                        <option value="">Please Choose</option>
                        <option value="yes">{{__('Yes')}}</option>
                        <option value="no">{{__('No')}}</option>
                    </select>
                </div>
            </div>
            <!--end col-->
            <div class="col-lg-6 choose-icon" id="">
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
                    <select class="form-control" id="make-link">
                        <option value="Please Choose">Please Choose</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
            <!--end col-->
            <div class="col-lg-6">
                <div class="mb-3" id="pick-link">
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
<!--end tab-pane-->
