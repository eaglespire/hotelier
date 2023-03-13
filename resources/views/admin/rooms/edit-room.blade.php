@extends('master')


@section('content')
    <div class="card card-header d-flex">
        <a href="{{ route('usr.room.all') }}" class="btn btn-primary align-self-end">{{__('All Rooms')}}</a>
    </div>
    <form action="{{ route('usr.room.update-room',$room->id) }}" method="post" id="createproduct-form" autocomplete="off" class="needs-validation">
        @csrf
        @method('PUT')
        <input type="hidden" name="slug" value="{{ $room->slug }}">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label>{{__('Description')}}</label>
                            <textarea
                                name="description" id="description"
                                class="form-control @error('description') is-invalid @enderror">{!! $room->description !!}</textarea>
                            @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>{{__('Add extra information for room')}}</label>
                            <textarea name="extra" id="extra"
                                      class="form-control @error('extra') is-invalid @enderror">{!! $room->extra !!}</textarea>
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
                                            <input name="title" type="text" value="{{ $room->title }}"
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
                                            <input name="room_number" type="number" value="{{ $room->room_number }}"
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
                                                       id="product-price-input" placeholder="Enter price" value="{{ $room->price }}"
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
                                                   placeholder="Enter meta title" id="meta-title-input" value="{{ $room->meta_title }}">
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
                                                   placeholder="Enter meta keywords" id="meta-keywords-input" value="{{ $room->meta_keywords }}">
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
                                              placeholder="Enter meta description" rows="3">{{ $room->meta_description }}</textarea>
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
                                                        <option @if($image->src == $room->first_image) selected @endif value="{{ $image->src }}">
                                                            {{ $image->title }}
                                                        </option>
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
                                                        <option @if($image->src == $room->second_image) selected @endif value="{{ $image->src }}">
                                                            {{ $image->title }}
                                                        </option>
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
                                                        <option @if($image->src == $room->third_image) selected @endif value="{{ $image->src }}">
                                                            {{ $image->title }}
                                                        </option>
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
                                                        <option @if($image->src == $room->fourth_image) selected @endif value="{{ $image->src }}">
                                                            {{ $image->title }}
                                                        </option>
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
                                                        <option @if($image->src == $room->fifth_image) selected @endif value="{{ $image->src }}">
                                                            {{ $image->title }}
                                                        </option>
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
                                                        <option @if($image->src == $room->sixth_image) selected @endif value="{{ $image->src }}">
                                                            {{ $image->title }}
                                                        </option>
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
                                    <option @if($category->id == $room->room_category_id) selected @endif value="{{ $category->id}}">
                                        {{  $category->name }}
                                    </option>
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
                                    <option  value="{{ $tag->id}}">{{ $tag->title }}</option>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/super-build/ckeditor.js"></script>
    <script src="https://cdn.ckbox.io/ckbox/1.3.2/ckbox.js"></script>

    <script>
        CKEDITOR.ClassicEditor.create(document.getElementById("description"), {
            ckbox: {
                tokenUrl: 'https://96154.cke-cs.com/token/dev/eOsKmglukokSyAO27Se8IBd0tK8O2mXXV7wo?limit=10 ',
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
            toolbar: {
                items: [
                    'ckbox', 'imageUpload','|',
                    'exportPDF','exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing',
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: 'Welcome to CKEditor 5!',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }
                ]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                //'CKBox',
                'CKFinder',
                'EasyImage',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType
                'MathType'
            ]
        });
        CKEDITOR.ClassicEditor.create(document.getElementById("extra"), {
            ckbox: {
                tokenUrl: 'https://96154.cke-cs.com/token/dev/eOsKmglukokSyAO27Se8IBd0tK8O2mXXV7wo?limit=10 ',
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
            toolbar: {
                items: [
                    'ckbox', 'imageUpload','|',
                    'exportPDF','exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing',
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: 'Welcome to CKEditor 5!',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }
                ]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                //'CKBox',
                'CKFinder',
                'EasyImage',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType
                'MathType'
            ]
        });
    </script>
@endsection

