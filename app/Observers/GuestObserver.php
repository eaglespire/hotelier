<?php

namespace App\Observers;

use App\Constants\CacheConstants;
use App\Models\Guest;
use Illuminate\Support\Facades\Cache;

class GuestObserver
{
    public function created(Guest $guest)
    {
        if (Cache::has(CacheConstants::GuestCache)){
            Cache::forget(CacheConstants::GuestCache);
        }
    }

    public function updated(Guest $guest)
    {
        if (Cache::has(CacheConstants::GuestCache)){
            Cache::forget(CacheConstants::GuestCache);
        }
    }

    public function deleted(Guest $guest)
    {
        if (Cache::has(CacheConstants::GuestCache)){
            Cache::forget(CacheConstants::GuestCache);
        }
    }

    public function restored(Guest $guest)
    {
    }

    public function forceDeleted(Guest $guest)
    {
    }
}
