<div x-data>
    <div class="d-flex">
        @if($displayExport)
            <button x-on:click="$wire.export()" type="button" class="btn btn-primary me-1">
                <i class="ri-equalizer-fill me-2 align-bottom"></i>
                <span wire:loading.class="d-none">{{__('Export as CSV')}}</span>
                <span wire:target="export" wire:loading.class.remove="d-none" class="d-none">{{__('Processing...')}}</span>
            </button>
        @endif
        @if($displayImport)
            <input type="file" {{ $attributes->wire('model') }} id="selectedFile" style="display: none">
            <button class="btn btn-primary" onclick="document.getElementById('selectedFile').click()">
                <i class="ri-equalizer-fill me-2 align-bottom"></i>
                <span wire:loading.class="d-none">{{__('Import CSV')}}</span>
                <span wire:loading.class.remove="d-none" class="d-none">{{__('Processing...')}}</span>
            </button>
            @error('selectedFile')
            <p>{{__('Selected file must be an xlsx format')}}</p>
            @enderror
        @endif

        <button type="button" class="btn btn-success add-btn me-1" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal">
            <i class="ri-add-line align-bottom me-1"></i>
            {{ $buttonText }}
        </button>

    </div>


    <div wire:ignore.self class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered {{ $modalSize }}">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
               {{ $slot }}
            </div>
        </div>
    </div>
</div>

