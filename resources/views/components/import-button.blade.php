<div x-data>
    <input type="file" {{ $attributes->wire('model') }} id="selectedFile" style="display: none">
    <button class="btn btn-primary" onclick="document.getElementById('selectedFile').click()">
        <i class="ri-equalizer-fill me-2 align-bottom"></i>
        <span wire:loading.class="d-none">{{__('Import CSV')}}</span>
        <span wire:loading.class.remove="d-none" class="d-none">{{__('Processing...')}}</span>
    </button>
</div>
