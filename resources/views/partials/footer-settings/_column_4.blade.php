<div class="tab-pane active show" id="column4" role="tabpanel">
    <form action="{{ route('usr.settings.save-to-footer') }}" method="post">
        @csrf
        <input type="hidden" name="column" value="four">
        <div class="row">
            <!--end col-->
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="lastnameInput" class="form-label">{{__('Newsletter Text')}}</label>
                    <input name="newsletter_text" type="text" class="form-control" id="lastnameInput"
                           placeholder="Enter column text" value="{{ $footerFour?->newsletter_text }}">
                </div>
            </div>
            <!--end col-->
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="lastnameInput" class="form-label">{{__('Newsletter Placeholder')}}</label>
                    <input name="newsletter_placeholder" type="text" class="form-control" id="lastnameInput"
                           placeholder="Enter column text" value="{{ $footerFour?->newsletter_placeholder }}"
                    >
                </div>
            </div>
            <!--end col-->

            <div class="col-lg-12">
                <div class="hstack gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </form>
</div>
<!--end tab-pane-->
