<?php

namespace App\Observers;

use App\Constants\CacheConstants;
use App\Models\Booking;
use Illuminate\Support\Facades\Cache;

class BookingObserver
{
    public function created(Booking $booking)
    {
        if (Cache::has(CacheConstants::BookingCache)){
            Cache::forget(CacheConstants::BookingCache);
        }
    }

    public function updated(Booking $booking)
    {
        if (Cache::has(CacheConstants::BookingCache)){
            Cache::forget(CacheConstants::BookingCache);
        }
    }

    public function deleted(Booking $booking)
    {
        if (Cache::has(CacheConstants::BookingCache)){
            Cache::forget(CacheConstants::BookingCache);
        }
    }

    public function restored(Booking $booking)
    {
    }

    public function forceDeleted(Booking $booking)
    {
    }
}
