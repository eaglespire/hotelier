<div>
{{--    {{ dd($records) }}--}}
    <x-styled-table :headers="$headers" :collection="$records" :search-term="$searchTerm" title="Booking History" wire:model="searchTerm">
        @if($records->count() !== 0)
            @foreach($records as $phone => $arr)
                <tr wire:loading.class="opacity-75">
                    <td class="id">
                        <a href="javascript:void(0);" class="fw-medium link-primary">
                            {{ $records->firstItem() + $loop->index  }}
                        </a>
                    </td>
                    <td>{{ $phone }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('usr.booking.booking-record',$phone) }}" class="btn btn-primary me-1">
                                View
                            </a>
                            <a wire:click.prevent="$emit('delete-record', {{ $arr }})" href="" class="btn btn-danger">
                                Delete
                            </a>
                        </div>
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
            @this.on('delete-record', phone => {
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
                            @this.call('deleteRecord',phone)
                        }
                    })
            })
        })
    </script>
@endpush


