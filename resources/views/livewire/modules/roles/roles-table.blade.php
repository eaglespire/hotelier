<div class="live-preview" wire:key="{{ Str::random() }}">
    <x-styled-table :headers="$headers" :collection="$roles" title="Roles" wire:model="searchTerm">
        @if($roles->total() !== 0)
            @foreach($roles as $role)
                @if($loop->first) @continue @endif
                <tr wire:loading.class="opacity-75">
                    <td class="id">
                        <a href="javascript:void(0);" class="fw-medium link-primary">
                            {{ $roles->firstItem() + $loop->index - 1 }}
                        </a>
                    </td>
                    <td class="customer_name">{{ $role->title }}</td>
                    <td class="email">3</td>
                    <td class="date">{{ \Carbon\Carbon::parse($role->created_at)->toFormattedDateString() }}</td>
                    <td>
                        <ul class="list-inline hstack gap-2 mb-0">
                            <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                data-bs-placement="top"
                                aria-label="Edit"
                                data-bs-original-title="Edit">
                                <a href="{{ route('usr.edit-role', ['id'=>$role->id]) }}" class="text-primary d-inline-block
                                                edit-item-btn">
                                    <i class="ri-pencil-fill fs-16"></i>
                                </a>
                            </li>
                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Remove" data-bs-original-title="Remove">
                                <a wire:click.prevent="$emit('delete-role', {{ $role->id }})" class="text-danger d-inline-block
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
    </x-styled-table>
</div>

@push('scripts')
    <script>
        window.addEventListener('livewire:load', function () {
            @this.on('delete-role', id => {
                Swal.fire({
                    icon: 'question',
                    title: 'Remove this role?',
                    text: 'This action is irreversible',
                    showCancelButton: true
                }).then(response => {
                    if(response.isConfirmed){
                        @this.call('DeleteRole',id)
                    }
                })
            })
        })
    </script>
@endpush

