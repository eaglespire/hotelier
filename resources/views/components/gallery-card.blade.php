<div class="element-item col-xxl-3 col-lg-3 col-sm-6" data-category="" style="position: absolute; left: 0px; top: 0px;">
    <div class="gallery-box card">
        <div class="gallery-container">
            <a class="image-popup" href="{{ $src }}" title="{{ $title }}">
                <img class="gallery-img img-fluid mx-auto" src="{{ $src }}" alt="">
                <div class="gallery-overlay">
                    <h5 class="overlay-caption">{{ $title }}</h5>
                    <a href="#" class="text-body text-truncate" {{ $attributes }}>
                        <i class="bx bx-trash text-danger" style="font-size: 1.5rem;"></i>
                    </a>
                </div>
            </a>
        </div>

        <div class="box-content">
            <div class="d-flex align-items-center mt-1">
                <div class="flex-grow-1 text-muted">

                </div>
            </div>
        </div>
    </div>
</div>
