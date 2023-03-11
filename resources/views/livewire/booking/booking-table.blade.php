<div>
    <x-styled-table :headers="$headers" :collection="$bookings" :search-term="$searchTerm" title="Bookings" wire:model="searchTerm">
        @if($bookings->count() !== 0)
            @foreach($bookings as $booking)
                <tr wire:loading.class="opacity-75">
                    <td class="id">
                        <a href="javascript:void(0);" class="fw-medium link-primary">
                            {{ $bookings->firstItem() + $loop->index  }}
                        </a>
                    </td>
                    <td class="customer_name">
                        <a href="{{ url("usr/booking/record/".$booking->guest->phone) }}">{{ $booking->guest->firstname . " ".
                        $booking->guest->lastname }}
                        </a>
                    </td>
                    <td class="customer_name">{{ $booking->room->room_number}} </td>
                    <td class="customer_name">{{ $booking->arrival->toFormattedDateString() }} </td>
                    <td class="customer_name">{{ build_departure_date($booking->arrival,$booking->nights)->toFormattedDateString() }} </td>
                    <td>
                        <div class="d-flex">
                            <a href="" class="btn btn-primary me-1" data-bs-toggle="modal" data-bs-target="#myModal_{{ $booking->id }}">
                                View
                            </a>
                            @if($booking->departure <= now())
                                <a wire:click.prevent="$emit('check-out-guest', {{ $booking->id }},'{{ build_departure_date($booking->arrival,$booking->nights)->toFormattedDateString() }}')" href="" class="btn btn-danger">
                                    Check Out
                                </a>
                            @else
                                <a wire:click.prevent="$emit('check-out-guest-earlier', {{ $booking->id }},'{{ build_departure_date($booking->arrival,
                                $booking->nights)->toFormattedDateString() }}')" href="" class="btn btn-danger">
                                    Check Out Earlier
                                </a>
                            @endif
                        </div>
                        @include('admin.bookings.modals.view-modal')
                    </td>
                </tr>
            @endforeach
        @endif
    </x-styled-table>

</div>

@push('scripts')
    <script>
        window.addEventListener('livewire:load', function () {
            @this.on('check-out-guest-earlier', (id,dept) => {
                Swal.fire({
                    icon: 'question',
                    title: 'Checkout Guest Earlier Than The Departure Date?',
                    text: "This action cannot be reversed.",
                    showCancelButton: true
                }).then(response => {
                    if(response.isConfirmed){
                        @this.call('CheckOutGuest', id,dept)
                    }
                })
            })
            @this.on('check-out-guest', (id,dept) => {
                Swal.fire({
                    icon: 'question',
                    title: 'Checkout Guest?',
                    text: "This action cannot be reversed.",
                    showCancelButton: true
                }).then(response => {
                    if(response.isConfirmed){
                        @this.call('CheckOutGuest', id,dept)
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

