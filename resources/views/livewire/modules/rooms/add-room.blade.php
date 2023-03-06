<div>
    <x-user-actions button-text="Add Room" wire:model="selectedFile">
        <form class="tablelist-form" autocomplete="off" wire:submit.prevent="store">
            <div class="modal-body">
                <div wire:loading.block  class="alert alert-primary p-2">{{__('Adding room...')}}</div>
                <div class="mb-3">
                    <label for="customername-field" class="form-label">{{__('Title')}}</label>
                    <input wire:model.defer="name" type="text" id="customername-field"
                           class="form-control @error('title') is-invalid @enderror"
                           placeholder="Enter title"
                           required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="customername-field" class="form-label">{{__('Description')}}</label>
                    <textarea  wire:model.defer="description"
                               cols="30" rows="5" class="form-control @error('description') is-invalid @enderror"></textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customername-field" class="form-label">{{__('Description')}}</label>
                    <textarea  wire:model.defer="description"
                               cols="30" rows="5" class="form-control @error('description') is-invalid @enderror"></textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <div class="hstack gap-2 justify-content-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="add-btn">{{__('Add Category')}}</button>
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


