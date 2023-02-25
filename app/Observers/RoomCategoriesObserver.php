<?php

namespace App\Observers;

use App\Constants\CacheConstants;
use App\Models\RoomCategory;
use Illuminate\Support\Facades\Cache;

class RoomCategoriesObserver
{
    /**
     * Handle the RoomCategory "created" event.
     *
     * @param  \App\Models\RoomCategory  $roomCategory
     * @return void
     */
    public function created(RoomCategory $roomCategory)
    {
        if (Cache::has(CacheConstants::RoomCategoriesCache)){
            Cache::forget(CacheConstants::RoomCategoriesCache);
        }
    }

    /**
     * Handle the RoomCategory "updated" event.
     *
     * @param  \App\Models\RoomCategory  $roomCategory
     * @return void
     */
    public function updated(RoomCategory $roomCategory)
    {
        if (Cache::has(CacheConstants::RoomCategoriesCache)){
            Cache::forget(CacheConstants::RoomCategoriesCache);
        }
    }

    /**
     * Handle the RoomCategory "deleted" event.
     *
     * @param  \App\Models\RoomCategory  $roomCategory
     * @return void
     */
    public function deleted(RoomCategory $roomCategory)
    {
        if (Cache::has(CacheConstants::RoomCategoriesCache)){
            Cache::forget(CacheConstants::RoomCategoriesCache);
        }
    }

    /**
     * Handle the RoomCategory "restored" event.
     *
     * @param  \App\Models\RoomCategory  $roomCategory
     * @return void
     */
    public function restored(RoomCategory $roomCategory)
    {
        //
    }

    /**
     * Handle the RoomCategory "force deleted" event.
     *
     * @param  \App\Models\RoomCategory  $roomCategory
     * @return void
     */
    public function forceDeleted(RoomCategory $roomCategory)
    {
        //
    }
}
