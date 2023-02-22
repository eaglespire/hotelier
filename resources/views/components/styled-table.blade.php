
<div class="card-body border-bottom-dashed border-bottom">
    <form>
        <div class="row g-3">
            <div class="col-xl-6">
                <div class="search-box">
                    <input type="text" class="form-control search"  {{ $attributes->wire('model') }}
                           placeholder="{{ $searchPlaceHolder }}">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
            <!--end col-->
            <div class="col-xl-6 order-first">
                <div>
                    <h5 class="card-title mb-0">{{ $title }}</h5>
                </div>
            </div>
        </div>
        <!--end row-->
    </form>
</div>

<div class="card-body">
    <div class="table-responsive table-card mb-1">
        <table class="table align-middle" id="customerTable">
            @if(sizeof($headers) !== 0)
                <thead class="table-light text-muted">
                <tr>
                    @foreach($headers as $header)
                        <th class="sort" data-sort="{{ $header }}">{{ $header }}</th>
                    @endforeach
                </tr>
                </thead>
            @endif

            <tbody class="list form-check-all">
                {{ $slot }}
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
        <div class="pagination-wrap hstack gap-2">
            {{ $collection->links() ?? null }}
        </div>
    </div>
</div>
