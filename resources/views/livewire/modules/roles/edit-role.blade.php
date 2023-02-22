<div>
    <div class="card card-body">
        <form class="tablelist-form" autocomplete="off" wire:submit.prevent="UpdateRole">
            <div wire:loading.block  class="alert alert-primary p-2">{{__('Updating role...')}}</div>
            <div class="mb-3">
                <label for="customername-field" class="form-label">{{__('Name')}}</label>
                <input wire:model.defer="name" type="text" id="customername-field"
                       class="form-control @error('name') is-invalid @enderror"
                       placeholder="Enter name"
                       required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="customername-field" class="form-label">{{__('Title')}}</label>
                <input wire:model.defer="title" type="text" id="customername-field"
                       class="form-control @error('title') is-invalid @enderror"
                       placeholder="Enter title"
                       required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="hstack gap-2 justify-content-end">
                <button onclick="window.location.href='{{ url()->previous() }}'" type="button" class="btn btn-light">Close</button>
                <button type="submit" class="btn btn-success" id="add-btn">{{__('Update Role')}}</button>
            </div>
        </form>
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
