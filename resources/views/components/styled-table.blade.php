


<div class="card-body border-bottom-dashed border-bottom my-2">
    <form>
        <div class="row g-3">
            <div class="col-7">
                <div class="search-box">
                    <input type="text" class="form-control search"  {{ $attributes->wire('model') }}
                           placeholder="{{ $searchPlaceHolder }}">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
            <!--end col-->
            <div class="col-5">
                <div class="d-flex justify-content-end">
                    <a href="{{ route($route) }}" class="btn btn-outline-info me-1">
                        {{ $btn }}
                    </a>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">
                        Back
                    </a>
                </div>

            </div>
        </div>
        <!--end row-->
    </form>
</div>

<div class="card card-body">
    <div class="table-responsive table-card mb-1">
        <table class="table align-middle caption-top " id="customerTable">
            <caption class="ps-1">{{ $title }}</caption>
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
