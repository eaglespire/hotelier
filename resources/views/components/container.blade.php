<div class="card" id="customerList">
    <div class="card-header border-bottom-dashed">
        <div class="row g-4 align-items-center">
            <div class="col-sm">
                <div>
                    <h5 class="card-title mb-0">{{__('Actions')}}</h5>
                </div>
            </div>
            <div class="col-sm-auto">
                <div class="d-flex flex-wrap align-items-start gap-2">
                    {{ $header ?? null }}
                </div>
            </div>
        </div>
    </div>
    {{ $slot }}
</div>
