<?php

namespace App\Observers;

use App\Constants\CacheConstants;
use App\Models\FileManager;
use Illuminate\Support\Facades\Cache;

class FileManagerObserver
{
    /**
     * Handle the FileManager "created" event.
     *
     * @param  \App\Models\FileManager  $fileManager
     * @return void
     */
    public function created(FileManager $fileManager)
    {
        if (Cache::has(CacheConstants::FileManagerCache)){
            Cache::forget(CacheConstants::FileManagerCache);
        }
    }

    /**
     * Handle the FileManager "updated" event.
     *
     * @param  \App\Models\FileManager  $fileManager
     * @return void
     */
    public function updated(FileManager $fileManager)
    {
        if (Cache::has(CacheConstants::FileManagerCache)){
            Cache::forget(CacheConstants::FileManagerCache);
        }
    }

    /**
     * Handle the FileManager "deleted" event.
     *
     * @param  \App\Models\FileManager  $fileManager
     * @return void
     */
    public function deleted(FileManager $fileManager)
    {
        if (Cache::has(CacheConstants::FileManagerCache)){
            Cache::forget(CacheConstants::FileManagerCache);
        }
    }

    /**
     * Handle the FileManager "restored" event.
     *
     * @param  \App\Models\FileManager  $fileManager
     * @return void
     */
    public function restored(FileManager $fileManager)
    {
        //
    }

    /**
     * Handle the FileManager "force deleted" event.
     *
     * @param  \App\Models\FileManager  $fileManager
     * @return void
     */
    public function forceDeleted(FileManager $fileManager)
    {
        //
    }
}
