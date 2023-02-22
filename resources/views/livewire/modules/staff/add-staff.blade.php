<div>
    <x-user-actions button-text="Add Staff" wire:model="selectedFile">
        <form class="tablelist-form" autocomplete="off" wire:submit.prevent="CreateStaff">
            <div class="modal-body">
                <div wire:loading.block  class="alert alert-primary p-2">{{__('Adding staff...')}}</div>
                <div class="mb-3">
                    <label for="customername-field" class="form-label">{{__('Select a user to add')}}</label>
                    @if(sizeof($users) !== 0)
                        <select wire:model.defer="user_id" class="form-select mb-3 @error('user_id') is-invalid @enderror" aria-label="select user">
                            <option disabled>{{__('Please choose')}}</option>
                            @foreach($users as $user)
                                @php
                                    $usr = json_decode(json_encode($user),true);
                                @endphp
                                <option value="{{ $usr['id'] }}">{{ $usr['firstname'] }} {{ $usr['lastname'] }}</option>
                            @endforeach
                        </select>
                    @endif

                    @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customername-field" class="form-label">{{__('Choose gender')}}</label>
                    <select class="form-select mb-3 @error('gender') is-invalid @enderror" aria-label="select gender">
                        <option disabled>{{__('Please choose')}}</option>
                        <option value="male">{{__('Male')}}</option>
                        <option value="female">{{__('Female')}}</option>
                        <option value="others">{{__('Others')}}</option>
                    </select>
                    @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customername-field" class="form-label">{{__('Age')}}</label>
                    <input wire:model.defer="age" type="text" id="customername-field"
                           class="form-control @error('age') is-invalid @enderror"
                           placeholder="Enter age"
                           required>
                    @error('age')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputdate" class="form-label">{{__('Employment Date')}}</label>
                    <input wire:model.defer="doe" type="date" class="form-control" id="exampleInputdate">
                </div>
                <div class="mb-3">
                    <label for="customername-field" class="form-label">{{__('Assign Role')}}</label>
                    @if(sizeof($roles) !== 0)
                        <select wire:model.defer="role" class="form-select mb-3 @error('role') is-invalid @enderror" aria-label="select age">
                            <option disabled>{{__('Please choose')}}</option>
                            @foreach($roles as $role)
                                @php
                                    $rol = json_decode(json_encode($role),true);
                                @endphp
                                <option value="{{ $rol['name'] }}">{{ $rol['title'] }}</option>
                            @endforeach
                        </select>
                    @endif
                    @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <div class="hstack gap-2 justify-content-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="add-btn">{{__('Add Staff')}}</button>
                </div>
            </div>
        </form>
    </x-user-actions>
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
        })
    </script>
@endpush
