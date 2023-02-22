@if($file)
    <input type="file" id="selectedFile" style="display: none">
    <input type="button" value="{{ $title }}" class="btn {{ $color }}" onclick="document.getElementById('selectedFile').click()">
@else
    <button type="button" class="btn {{ $color }} w-100"
            data-bs-toggle="tooltip"
            data-bs-trigger="hover"
            data-bs-placement="top"
            aria-label="{{ $toolTip }}"
            data-bs-original-title="{{ $toolTip }}"
    >
        <i class="{{ $icon }} me-2 align-bottom"></i>
        <span wire:loading.class="d-none">{{ $title }}</span>
        <span wire:loading.class.remove="d-none" class="d-none">{{__('Processing...')}}</span>
    </button>
@endif



