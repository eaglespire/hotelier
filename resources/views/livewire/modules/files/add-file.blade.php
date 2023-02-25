<div>
    <x-user-actions button-text="Upload Image" :display-export="$export" :display-import="$import">
        <form class="tablelist-form" autocomplete="off" wire:submit.prevent="SaveFile">
            <div class="modal-body">
                <div wire:loading.block wire:target="SaveFile"  class="alert alert-primary p-2">{{__('Adding file(s)...')}}</div>
                <div class="mb-3">
                    <label for="customername-field" class="form-label">{{__('Select image/images')}}</label>
                    <input wire:model.defer="files" type="file" id="{{ $increments }}"  class="form-control" multiple>
                    @error('files')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customername-field" class="form-label">{{__('Title')}}</label>
                    <input wire:model.defer="title" type="text" id="customername-field"
                           class="form-control @error('title') is-invalid @enderror"
                           placeholder="Enter title"
                           required>
                    <small class="text-muted">{{__('Separate each title with a comma')}}</small>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customername-field" class="form-label">{{__('Choose Folder')}}</label>
                    <select wire:model.defer="folder" class="form-select mb-3 @error('folder') is-invalid @enderror" aria-label="select folder">
                        <option disabled>{{__('Please choose')}}</option>
                        <option value="rooms">{{__('Rooms')}}</option>
                        <option value="posts">{{__('Posts')}}</option>
                        <option value="gallery">{{__('Gallery')}}</option>
                        <option value="others">{{__('Others')}}</option>
                    </select>
                    @error('folder')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customername-field" class="form-label">{{__('Image Width')}}</label>
                    <input wire:model.defer="width" type="text" id="customername-field"
                           class="form-control @error('width') is-invalid @enderror"
                           placeholder="Enter width">
                    <small class="text-muted">{{__('Leave it as blank if you intend to maintain the width of the original image')}}</small>
                    @error('width')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customername-field" class="form-label">{{__('Image Height')}}</label>
                    <input wire:model.defer="width" type="text" id="customername-field"
                           class="form-control @error('height') is-invalid @enderror"
                           placeholder="Enter height">
                    <small class="text-muted">{{__('Leave it as blank if you intend to maintain the height of the original image')}}</small>
                    @error('height')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customername-field" class="form-label">{{__('Select Image Mode')}}</label>
                    <select wire:model.defer="mode" class="form-select mb-3 @error('mode') is-invalid @enderror" aria-label="select folder">
                        <option disabled>{{__('Please choose')}}</option>
                        <option value="fit">{{__('Fit')}}</option>
                        <option value="fill">{{__('Fill')}}</option>
                    </select>
                    @error('folder')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <div class="hstack gap-2 justify-content-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="add-btn">{{__('Submit')}}</button>
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
