<div x-data>
    <button {{ $attributes->wire('target') }} type="button" class="btn btn-primary">
        <i class="ri-equalizer-fill me-2 align-bottom"></i>
        <span {{ $attributes->wire('loading') }}>{{__('Export as CSV')}}</span>
        <span wire:loading.class.remove="d-none" class="d-none">{{__('Processing...')}}</span>
    </button>
</div>
