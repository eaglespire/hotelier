<div wire:key="{{ Str::random() }}">
    <x-styled-table :headers="$headers" :collection="$permissions" title="Permissions" wire:model="searchTerm">
        @if($permissions->total() !== 0)
            @foreach($permissions as $permission)
                <tr wire:loading.class="opacity-75">
                    <td class="id">
                        <a href="javascript:void(0);" class="fw-medium link-primary">
                            {{ $permissions->firstItem() + $loop->index  }}
                        </a>
                    </td>
                    <td class="email">{{ $permission->name }}</td>
                    <td class="customer_name">{{ $permission->title }}</td>
                    <td class="email">3</td>
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


