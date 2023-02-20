<div>
    <button class="btn btn-soft-danger" id="remove-actions" onclick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line
    align-bottom me-1"></i> {{__('Add User')}}</button>
    <input type="file" wire:model="selectedFile" id="selectedFile" style="display: none">
    <input type="button" value="Import CSV" class="btn btn-primary" onclick="document.getElementById('selectedFile').click()">
    <div wire:loading.block class="alert alert-primary">processing...</div>

    @error('selectedFile')
        <p>Selected file must be an image</p>
    @enderror

    <div wire:ignore.self class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
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
            </div>
        </div>
    </div>
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
