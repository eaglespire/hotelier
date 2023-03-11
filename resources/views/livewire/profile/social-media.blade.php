<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center mb-4">
            <div class="flex-grow-1">
                <h5 class="card-title mb-0">{{__('Social Media Accounts')}}</h5>
            </div>
            <div class="flex-shrink-0">
                <a wire:click.prevent="SaveAccounts" href="javascript:void(0);" class="badge bg-light text-primary fs-12">
                    <i class="ri-add-fill align-bottom me-1"></i> Add
                </a>
            </div>
        </div>
        <div wire:loading.block class="p-2 text-primary ms-5">Processing...</div>
        <div class="mb-3 d-flex">
            <div class="avatar-xs d-block flex-shrink-0 me-3">
                <span class="avatar-title rounded-circle fs-16 bg-dark text-light">
                    <i class="ri-facebook-fill"></i>
                </span>
            </div>
            <input wire:model.defer="fb" type="text" class="form-control @error('fb') is-invalid @enderror" placeholder="facebook">
            @error('fb')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 d-flex">
            <div class="avatar-xs d-block flex-shrink-0 me-3">
                <span class="avatar-title rounded-circle fs-16 bg-primary">
                    <i class="ri-twitter-fill"></i>
                </span>
            </div>
            <input wire:model.defer="tw" type="text" class="form-control @error('tw') is-invalid @enderror" placeholder="e.g @example">
            @error('tw')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 d-flex">
            <div class="avatar-xs d-block flex-shrink-0 me-3">
                <span class="avatar-title rounded-circle fs-16 bg-success">
                    <i class="ri-instagram-fill"></i>
                </span>
            </div>
            <input wire:model.defer="in" type="text" class="form-control @error('in') is-invalid @enderror" placeholder="instagram">
            @error('in')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-flex mb-3">
            <div class="avatar-xs d-block flex-shrink-0 me-3">
                <span class="avatar-title rounded-circle fs-16 bg-danger">
                    <i class="ri-whatsapp-fill"></i>
                </span>
            </div>
            <input wire:model.defer="wh" type="text" class="form-control @error('wh') is-invalid @enderror" placeholder="e.g 123 456">
            @error('wh')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-flex">
            <div class="avatar-xs d-block flex-shrink-0 me-3">
                <span class="avatar-title rounded-circle fs-16 bg-danger">
                    <i class="ri-linkedin-fill"></i>
                </span>
            </div>
            <input wire:model.defer="lk" type="text" class="form-control @error('lk') is-invalid @enderror" placeholder="e.g linkedin.com/in/abc">
            @error('lk')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
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
                    text: message,
                    toast: true,
                    position:'top-right'
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
