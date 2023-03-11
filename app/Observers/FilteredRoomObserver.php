<?php

namespace App\Observers;

use App\Constants\CacheConstants;
use App\Models\Room;
use Illuminate\Support\Facades\Cache;

class FilteredRoomObserver
{
    public function created(Room $room)
    {
        if (Cache::has(CacheConstants::FilteredRoomCache)){
            Cache::forget(CacheConstants::FilteredRoomCache);
        }
    }

    public function updated(Room $room)
    {
        if (Cache::has(CacheConstants::FilteredRoomCache)){
            Cache::forget(CacheConstants::FilteredRoomCache);
        }
    }

    public function deleted(Room $room)
    {
        if (Cache::has(CacheConstants::FilteredRoomCache)){
            Cache::forget(CacheConstants::FilteredRoomCache);
        }
    }

    public function restored(Room $room)
    {
    }

    public function forceDeleted(Room $room)
    {
    }
}
