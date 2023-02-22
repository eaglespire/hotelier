<div wire:key="{{ Str::random() }}">
    <x-styled-table :headers="$headers" :collection="$users" title="Staff" wire:model="searchTerm">
        @if($users->count() !== 0)
            @foreach($users as $user)
                <tr wire:loading.class="opacity-75">
                    <td class="id">
                        <a href="javascript:void(0);" class="fw-medium link-primary">
                            {{ $users->firstItem() + $loop->index  }}
                        </a>
                    </td>
                    <td class="email">
                        <img width="48" height="48"  class="img-thumbnail rounded-circle"
                             src="{{ $user->photo ?? asset('dashboard/images/users/user-dummy-img.jpg') }}" alt="avatar image">
                    </td>
                    <td class="customer_name">{{ $user->user->firstname }} {{ $user->user->lastname }}</td>
                    <td class="email">{{ $user->gender }}</td>
                    <td class="email">{{ $user->staff_number }}</td>
                    <td class="date">{{ \Carbon\Carbon::parse($user->doe)->toFormattedDateString() }}</td>
                    <td class="email">{{ $user->role }}</td>
                    <td>
                        <ul class="list-inline hstack gap-2 mb-0">
                            <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                data-bs-placement="top"
                                aria-label="Edit"
                                data-bs-original-title="Edit">
                                <a href="{{ route('usr.staff', ['id'=>$user->staff_number]) }}" class="text-primary d-inline-block
                                                edit-item-btn">
                                    <i class="ri-pencil-fill fs-16"></i>
                                </a>
                            </li>
                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Remove" data-bs-original-title="Remove">
                                <a wire:click.prevent="$emit('delete-staff', {{ $user->id }})" class="text-danger d-inline-block
                                                remove-item-btn"
                                   href="#deleteRecordModal">
                                    <i class="ri-delete-bin-5-fill fs-16"></i>
                                </a>
                            </li>
                            @if($user->user->status)
                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top"
                                    aria-label="{{__('Suspend this staff')}}" data-bs-original-title="{{__('Suspend this staff')}}">
                                    <a wire:click.prevent="$emit('suspend-staff', {{ $user->id }})"
                                       class="text-info d-inline-block remove-item-btn"
                                       href="#deleteRecordModal">
                                        <i class="ri-hammer-fill fs-16"></i>
                                    </a>
                                </li>
                            @else
                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top"
                                    aria-label="{{__('Remove Ban')}}" data-bs-original-title="{{__('Remove Ban')}}">
                                    <a wire:click.prevent="$emit('remove-ban', {{ $user->id }})"
                                       class="text-success d-inline-block remove-item-btn"
                                       href="#deleteRecordModal">
                                        <i class="ri-anticlockwise-line fs-16"></i>
                                    </a>
                                </li>
                            @endif
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
            @this.on('delete-staff', id => {
                Swal.fire({
                    icon: 'question',
                    title: 'Remove this staff?',
                    text: 'This action is irreversible',
                    showCancelButton: true
                }).then(response => {
                    if(response.isConfirmed){
                        @this.call('DeleteStaff',id)
                    }
                })
            })
            @this.on('suspend-staff', id => {
                Swal.fire({
                    icon: 'question',
                    title: 'Suspend This Staff Account?',
                    text: 'This will result in the staff unable to log into their account',
                    showCancelButton: true
                }).then(response => {
                    if(response.isConfirmed){
                        @this.call('SuspendStaff',id)
                    }
                })
            })
            @this.on('remove-ban', id => {
                Swal.fire({
                    icon: 'question',
                    title: 'Unban This Staff Account?',
                    text: 'This will restore the staff\'s privileges',
                    showCancelButton: true
                }).then(response => {
                    if(response.isConfirmed){
                        @this.call('UnbanStaff',id)
                    }
                })
            })
            @this.on('success', message => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: message
                })
            })
            @this.on('error', message => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: message
                })
            })
        })
    </script>
@endpush


