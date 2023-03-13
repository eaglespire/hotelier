<div class="card-body" wire:key="{{ Str::random() }}">
    @if(count($footers) > 0)
        <div>
            <div class="table-responsive table-card mb-1">
                <table class="table align-middle" id="customerTable">
                    <thead class="table-light text-muted">
                    <tr>
                        <th data-sort="customer_name">{{__('S/N')}}</th>
                        <th data-sort="email">{{__('Title')}}</th>
                        <th data-sort="phone">{{__('Icon')}}</th>
                        <th data-sort="date">{{__('Link')}}</th>
                        <th data-sort="action">Action</th>
                    </tr>
                    </thead>
                    <tbody class="list form-check-all">
                    @foreach($footers as $footer)
                        <tr>
                            <td class="id">{{ $loop->iteration }}</td>
                            <td class="title">{{ $footer->title }}</td>
                            <td class="email">{{ $footer->icon }}</td>
                            <td class="phone">{{ $footer->link }}</td>
                            <td>
                                <ul class="list-inline hstack gap-2 mb-0">
                                    <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Edit" data-bs-original-title="Edit">
                                        <a href="{{ route('usr.settings.edit-footer',$footer->id) }}" class="text-primary
                                        d-inline-block edit-item-btn">
                                            <i class="ri-pencil-fill fs-16"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Remove" data-bs-original-title="Remove">
                                        <a wire:click.prevent="DeleteFooter({{ $footer->id }})" class="text-danger d-inline-block remove-item-btn">
                                            <i class="ri-delete-bin-5-fill fs-16"></i>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        window.addEventListener('livewire:load', function (){
            @this.on('success', (message)=> {
                Swal.fire({
                    icon: 'success',
                    title: 'success',
                    text: message
                })
            })
        })
    </script>
@endpush
