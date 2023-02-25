<div class="folder-card" style="cursor: pointer;" onclick="window.location.href='{{ route('usr.file-manager', $folder) }}'">
    <div class="card bg-light shadow-none" id="folder-1">
        <div class="card-body">
            <div class="text-center">
                <div class="mb-2">
                    <i class="ri-folder-2-fill align-bottom text-warning display-5"></i>
                </div>
                <h6 class="fs-15 folder-name">{{ $name }}</h6>
            </div>
            <div class="hstack mt-4 text-muted">
                <span class="me-auto"><b>349</b> Files</span>
            </div>
        </div>
    </div>
</div>
