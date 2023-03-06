<div>
    <div class="row gallery-wrapper" style="position: relative; height: 1015.47px;">
        @if(sizeof($files) !== 0)
            @foreach($files as $file)
                <x-gallery-card :src="$file->src" :title="$file->title" wire:click.prevent="$emit('delete', {{ $file->id }})" />
            @endforeach
        @else
            <div class="card card-body">
                <p class="card-text">{{ __('Folder is empty')  }}</p>
            </div>
        @endif
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-12 w-100">
            {{ $files->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('livewire:load', function () {
            @this.on('delete', id => {
                Swal.fire({
                    icon: 'question',
                    title: 'Delete Image ?',
                    text: 'This action is irreversible',
                    showCancelButton: true
                })
                    .then(response => {
                        if(response.isConfirmed){
                            @this.call('delete',id)
                        }
                    })
            })
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
