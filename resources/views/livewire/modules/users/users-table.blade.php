<div>
    <div class="card-body border-bottom-dashed border-bottom">
        <form>
            <div class="row g-3">
                <div class="col-xl-6">
                    <div class="search-box">
                        <input type="text" class="form-control search"  wire:model="searchTerm"
                               placeholder="Search for customer, email, phone, status or something...">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <!--end col-->
                <div class="col-xl-6">
                    <div class="row g-3">
                        <div class="col-sm-4">
                            <div class="d-none">
                                <input type="text" class="form-control" id="datepicker-range" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" placeholder="Select date">
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-sm-4">
                            <div class="d-none">
                                <select class="form-control" data-plugin="choices" data-choices="" data-choices-search-false="" name="choices-single-default" id="idStatus">
                                    <option value="">Status</option>
                                    <option value="all" selected="">All</option>
                                    <option value="Active">Active</option>
                                    <option value="Block">Block</option>
                                </select>
                            </div>
                        </div>
                        <!--end col-->

                        <div class="col-sm-4">
                            <div>
                                <button wire:click.prevent="export" type="button" class="btn btn-primary w-100" onclick="SearchData();">
                                    <i class="ri-equalizer-fill me-2 align-bottom"></i>
                                    <span wire:loading.class="d-none">{{__('Export as CSV')}}</span>
                                    <span wire:loading.class.remove="d-none" class="d-none">{{__('Processing...')}}</span>
                                </button>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                </div>
            </div>
            <!--end row-->
        </form>
    </div>
    <div class="card-body">
        <div>
            <div class="table-responsive table-card mb-1">
                <table class="table align-middle" id="customerTable">
                    <thead class="table-light text-muted">
                    <tr>
                        <th scope="col" style="width: 50px;">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                            </div>
                        </th>
                        <th class="sort" data-sort="cuid">{{__('S/N')}}</th>
                        <th class="sort" data-sort="customer_name">{{__('User')}}</th>
                        <th class="sort" data-sort="email">{{__('Email')}}</th>
                        <th class="sort" data-sort="phone">{{__('Date Created')}}</th>
                        <th class="sort" data-sort="status">Status</th>
                        <th class="sort" data-sort="action">Action</th>
                    </tr>
                    </thead>
                    <tbody class="list form-check-all">
                        @if($users->total() !== 0)
                            @foreach($users as $user)
                                <tr wire:loading.class="opacity-75">
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                        </div>
                                    </th>
                                    <td class="id"><a href="javascript:void(0);" class="fw-medium link-primary">
                                            {{ $users->firstItem() + $loop->index  }}</a></td>
                                    <td class="customer_name">{{ $user->firstname }} {{ $user->lastname }}</td>
                                    <td class="email">{{ $user->email }}</td>
                                    <td class="date">{{ $user->created_at->toFormattedDateString() }}</td>
                                    <td class="status"><span class="badge badge-soft-success text-uppercase">Active</span>
                                    </td>
                                    <td>
                                        <ul class="list-inline hstack gap-2 mb-0">
                                            <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                data-bs-placement="top"
                                                aria-label="Edit"
                                                data-bs-original-title="Edit">
                                                <a href="{{ route('usr.edit-user', ['user'=>$user->slug]) }}" class="text-primary d-inline-block
                                                edit-item-btn">
                                                    <i class="ri-pencil-fill fs-16"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Remove" data-bs-original-title="Remove">
                                                <a wire:click.prevent="$emit('delete-user', {{ $user->id }})" class="text-danger d-inline-block
                                                remove-item-btn"
                                                   href="#deleteRecordModal">
                                                    <i class="ri-delete-bin-5-fill fs-16"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                <div class="pagination-wrap hstack gap-2">
                    {{ $users->links() }}
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('livewire:load', function () {
            @this.on('success', message => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: message
                })
            })
            @this.on('delete-user', id => {
                Swal.fire({
                    icon: 'question',
                    title: 'Do you want to proceed?',
                    text: 'This action cannot be reversed',
                    showCancelButton: true,
                    confirmButtonColor:'#CF4E3B',
                    confirmButtonText:'Yes, Delete',
                    confirmButtonClass:'btn btn-danger'
                })
                    .then(response => {
                        if(response.isConfirmed){
                            @this.call('deleteUser',id)
                        }
                    })
            })
        })
    </script>
@endpush
