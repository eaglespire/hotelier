<div id="myModal_{{ $booking->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Booking Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <h5 class="fs-15">
                  {{ $booking->guest->title }}  {{ $booking->guest->firstname . " ". $booking->guest->lastname }}
                </h5>
                <div class="table-responsive">
                    <!-- Small Tables -->
                    <table class="table table-sm table-nowrap">
                        <thead>
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Name</th>
                            <th scope="col">Title</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Phone</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">{{ $booking->id }}</th>
                            <th>{{ $booking->guest->firstname . " ". $booking->guest->lastname }}</th>
                            <td>{{ $booking->guest->title }}</td>
                            <td><span class="badge badge-soft-primary">{{ ucfirst($booking->guest->gender) }}</span></td>
                            <td>{{ $booking->guest->phone }}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-nowrap">
                        <thead>
                        <tr>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Amount Paid</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>{{ $booking->guest->email }}</th>
                            <td>{{ $booking->guest->address }}</td>
                            <td>23,000</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-nowrap">
                        <thead>
                        <tr>
                            <th scope="col">Rm No</th>
                            <th scope="col">Nights</th>
                            <th scope="col">Arrival</th>
                            <th scope="col">Departure</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">{{ $booking->room->room_number }}</th>
                            <td>{{ $booking->nights }}</td>
                            <td><span class="badge badge-soft-primary">{{ $booking->arrival->toFormattedDateString() }}</span></td>
                            <td>{{ build_departure_date($booking->arrival,$booking->nights)->toFormattedDateString() }}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <!--
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Check Guest Out</button>
            </div>
            -->

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
