<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">{{ $title }}</h4>
        <div class="flex-shrink-0">
            <div class="form-check form-switch form-switch-right form-switch-md">
                <label for="card-tables-showcode" class="form-label text-muted">{{ $switcherText }}</label>
                <input class="form-check-input code-switcher" type="checkbox" id="card-tables-showcode">
            </div>
        </div>
    </div><!-- end card header -->

    <div class="card-body">
        <div class="d-flex justify-content-between">
            <p class="text-muted mb-4 d-none d-lg-block">{{ config('app.name') }}
                <span class="text-danger">{{ $title }}</span>
            </p>
        </div>
        {{ $slot }}
    </div>
    <!-- end card-body -->
</div>


