<div class="card mt-n5" wire:key="{{ Str::random() }}">
    <div class="card-body p-4">
        <div class="text-center">
            <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                <img src="{{ $src }}" class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                     alt="user-profile-image">
                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                    <input wire:model="image" id="profile-img-file-input" type="file" class="profile-img-file-input">
                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                        <span class="avatar-title rounded-circle bg-light text-body">
                            <i class="ri-camera-fill"></i>
                        </span>
                    </label>
                </div>
            </div>
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="text-dark" wire:loading.block>Uploading image...</div>
            <h5 class="fs-16 mb-1">{{ auth()->user()->fullname }}</h5>
            <p class="text-muted mb-0">{{ get_user_role(auth()->id()) }}</p>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('livewire:load', function (){
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
                    text: message,
                    toast: true
                })
            })
        })
    </script>
@endpush
