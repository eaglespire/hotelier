<div>
    <x-user-actions button-text="Add User" wire:model="selectedFile">
        <form class="tablelist-form" autocomplete="off" wire:submit.prevent="store">
            <div class="modal-body">
                <div wire:loading.block  class="alert alert-primary p-2">{{__('Adding user...')}}</div>
                <div class="mb-3">
                    <label for="customername-field" class="form-label">{{__('FirstName')}}</label>
                    <input wire:model.defer="firstname" type="text" id="customername-field"
                           class="form-control @error('firstname') is-invalid @enderror"
                           placeholder="Enter name"
                           required>
                    @error('firstname')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="customername-field" class="form-label">{{__('LastName')}}</label>
                    <input wire:model.defer="lastname" type="text" id="customername-field"
                           class="form-control @error('lastname') is-invalid @enderror"
                           placeholder="Enter lastname"
                           required>
                    @error('lastname')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email-field" class="form-label">Email</label>
                    <input wire:model.defer="email" type="email" id="email-field" class="form-control @error('email') is-invalid @enderror"
                           placeholder="Enter email" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="modal-footer">
                <div class="hstack gap-2 justify-content-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="add-btn">{{__('Add User')}}</button>
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
