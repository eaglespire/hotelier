<?php

namespace App\Observers;

use App\Constants\CacheConstants;
use App\Models\Room;
use Illuminate\Support\Facades\Cache;

class RoomObserver
{
    public function created(Room $room)
    {
        if (Cache::has(CacheConstants::RoomCache)){
            Cache::forget(CacheConstants::RoomCache);
        }
    }

    public function updated(Room $room)
    {
        if (Cache::has(CacheConstants::RoomCache)){
            Cache::forget(CacheConstants::RoomCache);
        }
    }

    public function deleted(Room $room)
    {
        if (Cache::has(CacheConstants::RoomCache)){
            Cache::forget(CacheConstants::RoomCache);
        }
    }

    public function restored(Room $room)
    {
    }

    public function forceDeleted(Room $room)
    {
    }
}
