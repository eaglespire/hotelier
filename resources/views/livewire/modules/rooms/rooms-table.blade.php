<div>
    <x-styled-table :headers="$headers" :collection="$rooms" :search-term="$searchTerm" title="Rooms" wire:model="searchTerm">
        @if($rooms->count() !== 0)
            @foreach($rooms as $room)
                <tr wire:loading.class="opacity-75">
                    <td class="id">
                        <a href="javascript:void(0);" class="fw-medium link-primary">
                            {{ $rooms->firstItem() + $loop->index  }}
                        </a>
                    </td>
                    <td class="customer_name">
                        <img width="48" height="32" src="{{ $room->first_image }} " alt="image">
                    </td>
                    <td class="customer_name">{{ $room->room_number }} </td>
                    <td class="customer_name">{{ $room->title }} </td>
                    <td class="customer_name">{{ number_format($room->price,2) }} </td>
                    <td class="customer_name">{{ $room->room_category->name }} </td>
                    <td class="customer_name">{{ $room->is_available ? 'Available' : 'Booked' }} </td>
                    <td class="customer_name">{{ $room->is_clean ? 'Clean' : 'Not clean' }} </td>
                    <td>
                        <ul class="list-inline hstack gap-2 mb-0">
                            <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                data-bs-placement="top"
                                aria-label="Edit"
                                data-bs-original-title="Edit">
                                <a href="{{ route('usr.room.edit-room', ['room'=>$room->slug]) }}" class="text-primary d-inline-block
                                                edit-item-btn">
                                    <i class="ri-pencil-fill fs-16"></i>
                                </a>
                            </li>
                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Remove" data-bs-original-title="Remove">
                                <a wire:click.prevent="$emit('delete-room', {{ $room->id }})" class="text-danger d-inline-block
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
            @this.on('delete-room', id => {
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
                            @this.call('deleteRoom',id)
                        }
                    })
            })
        })
    </script>
@endpush

