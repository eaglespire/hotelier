<div>
    <form autocomplete="on" class="" wire:submit.prevent="SaveInformation">
        @csrf
        <div class="row">
            <div wire:loading.block wire:target="SaveInformation" class="alert alert-primary">
                {{__('Processing data...please wait...')}}
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">{{__('Guest Information')}}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label>{{__('FirstName')}}</label>
                                    <input wire:model.defer="firstname" placeholder="Enter firstname" type="text"
                                           class="form-control @error('firstname') is-invalid @enderror">
                                    @error('firstname')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label>{{__('LastName')}}</label>
                                    <input wire:model.defer="lastname" type="text" placeholder="Enter lastname"
                                           class="form-control @error('lastname') is-invalid @enderror">
                                    @error('lastname')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label>{{__('Email')}}</label>
                                    <input wire:model.defer="email" type="email" placeholder="Enter email"
                                           class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label>{{__('Phone')}}</label>
                                    <input wire:model.defer="phone" type="text" placeholder="Enter phone"
                                           class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label>{{__('Address')}}</label>
                                    <input wire:model.defer="address" type="text" placeholder="Enter address"
                                           class="form-control @error('address') is-invalid @enderror">
                                    @error('address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-header">{{__('Room Details')}}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if(isset($categories))
                                    <div class="mb-3">
                                        <label>{{__('Room Type')}}</label>
                                        <select wire:model="type" class="form-control @error('type') is-invalid @enderror">
                                            <option>{{__('Please choose')}}</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label>{{__('Room')}}</label>
                                    @if(sizeof($rooms) !== 0)
                                        <select wire:model.defer="room" class="form-control @error('room') is-invalid @enderror">
                                            <option >{{__('Please choose')}}</option>
                                            @foreach($rooms as $room)
                                                <option value="{{ $room->id }}">{{ $room->title }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <p class="text-muted">No available rooms for this category
                                            <a href="{{ route('usr.room.create-room') }}">Add New Room</a>
                                        </p>

                                    @endif
                                    @error('room')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">{{__('Mode')}}</label>

                            <select wire:model.defer="mode" class="form-select" id="choices-publish-status-input" name="available">
                                <option disabled>{{__('Please select')}}</option>
                                <option value="offline" selected="">Offline</option>
                                <option value="online">Online</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">{{__('How many nights?')}}</label>
                            <input type="text" class="form-control @error('nights') is-invalid @enderror"
                                   placeholder="nights" wire:model.defer="nights">
                            @error('nights')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">{{__('Arrival')}}</label>
                            <input type="date" class="form-control @error('arrival') is-invalid @enderror"
                                   wire:model.defer="arrival">
                            @error('arrival')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">{{__('Gender')}}</label>

                            <select wire:model.defer="gender" class="form-select" id="choices-publish-status-input" name="gender">
                                <option disabled>{{__('Please select')}}</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">{{__('Title')}}</label>

                            <select wire:model.defer="guestTitle" class="form-select" id="choices-publish-status-input" name="title">
                                <option disabled>{{__('Please select')}}</option>
                                <option value="Mr">Mr.</option>
                                <option value="Mrs">Mrs.</option>
                                <option value="Doc">Doc.</option>
                                <option value="Engr">Engr.</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
        <div class="mb-3">
            <button type="submit" class="btn btn-primary w-sm">Next</button>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        window.addEventListener('livewire:load', function () {
            @this.on('cannot-proceed', () => {
                Swal.fire({
                    icon: 'error',
                    title: 'Cannot Proceed',
                    text: 'Seems room information is not set'
                })
            })
        })
    </script>
@endpush
