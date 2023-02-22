<div>
    <x-styled-table :headers="$headers" :collection="$users" :search-term="$searchTerm" title="Users" wire:model="searchTerm">
        @if($users->count() !== 0)
            @foreach($users as $user)
                @php
                    $usr = json_decode(json_encode($user),true)
                @endphp
                <tr wire:loading.class="opacity-75">
                    <td class="id">
                        <a href="javascript:void(0);" class="fw-medium link-primary">
                            {{ $users->firstItem() + $loop->index  }}
                        </a>
                    </td>
                    <td class="customer_name">{{ $user->fullname }} </td>
                    <td class="email">{{ $user->email }}</td>
                    <td class="date">{{ \Carbon\Carbon::parse($user->created_at)->toFormattedDateString() }}</td>
                    <td class="status">
                        <span class="badge badge-soft-{{ $user->status ? 'success' : 'danger' }} text-uppercase">
                            {{ $user->status ? 'Active' : 'Not Active' }}
                        </span>
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
    </x-styled-table>
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
