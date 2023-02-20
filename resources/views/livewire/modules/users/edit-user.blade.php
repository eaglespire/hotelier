<div wire:key="{{ Str::random() }}">
    <div class="card card-body">
        <form class="tablelist-form" autocomplete="off" wire:submit.prevent="UpdateUser">
            <div wire:loading.block  class="alert alert-primary p-2">{{__('Updating user...')}}</div>
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
            <div class="hstack gap-2 justify-content-end">
                <button onclick="window.location.href='{{ url()->previous() }}'" type="button" class="btn btn-light">Close</button>
                <button type="submit" class="btn btn-success" id="add-btn">{{__('Update User')}}</button>
            </div>
        </form>
    </div>
</div>


@push('scripts')
    <script>
        window.addEventListener('livewire:load', function () {
            @this.on('error', message => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: message
                })
            })
            @this.on('success', message => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: message
                })
            })
            {{--var myModal = new bootstrap.Modal(document.getElementById('showEditModal_{{ $_id }}'))--}}
            {{--@this.on('open-modal', () => {--}}
            {{--    myModal.show()--}}
            {{--})--}}
            {{--@this.on('close-modal', () => {--}}
            {{--    myModal.hide()--}}
            {{--    Livewire.emitUp('refreshComponent')--}}
            {{--})--}}

        })
    </script>
@endpush
