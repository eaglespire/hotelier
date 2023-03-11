<div>
    <x-styled-table :route="$route" :headers="$headers" :collection="$records" :search-term="$searchTerm" title="Records of {{$phone}}"
                    wire:model="searchTerm" btn="Browse Records">
        @if($records->count() !== 0)
            @foreach($records as $record)
                <tr wire:loading.class="opacity-75">
                    <td class="id">
                        <a href="javascript:void(0);" class="fw-medium link-primary">
                            {{ $records->firstItem() + $loop->index  }}
                        </a>
                    </td>
                    <td class="customer_name">{{ $record->title}} </td>
                    <td class="customer_name">{{ $record->firstname . " ". $record->lastname}} </td>
                    <td class="customer_name">{{ ucfirst($record->gender)}} </td>
                    <td class="customer_name">{{ $record->room->room_number}} </td>
                    <td class="customer_name">{{ $record->phone}} </td>
                    <td>
                        <div class="d-flex">
                            <a href="" class="btn btn-primary me-1" data-bs-toggle="modal" data-bs-target="#myModal_{{ $record->id }}">
                                View
                            </a>
                            <a wire:click.prevent="$emit('delete-record', {{ $record->id }})" href="" class="btn btn-danger">
                                Delete
                            </a>
                        </div>
                        @include('admin.bookings.modals.view-record')
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
            @this.on('error', message => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: message
                })
            })
            @this.on('delete-record', id => {
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
                            @this.call('deleteRecord',id)
                        }
                    })
            })
        })
    </script>
@endpush

