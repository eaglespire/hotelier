<div>
    <x-user-actions button-text="Add Feature" :display-export="$export" :display-import="$import" modal-size="modal-xl">
        <form class="tablelist-form" autocomplete="off" wire:submit.prevent="store">
            <div class="modal-body">
                <div wire:loading.block wire:target="store"  class="alert alert-primary p-2">{{__('Adding tag...')}}</div>
                Selected Icon: {{ var_export($icon) }}
                <div class="mb-3">
                    <label for="customername-field" class="form-label">{{__('Name')}}</label>
                    <input wire:model.defer="title" type="text" id="customername-field"
                           class="form-control @error('title') is-invalid @enderror"
                           placeholder="Enter name"
                           required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @include('partials._icons')
            </div>
            <div class="modal-footer">
                <div class="hstack gap-2 justify-content-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="add-btn">{{__('Add Tag')}}</button>
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



