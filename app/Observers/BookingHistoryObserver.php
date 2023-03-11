<?php

namespace App\Observers;

use App\Constants\CacheConstants;
use App\Models\BookingHistory;
use Illuminate\Support\Facades\Cache;

class BookingHistoryObserver
{
    public function created(BookingHistory $bookingHistory)
    {
        if (Cache::has(CacheConstants::BookingHistoryCache)){
            Cache::forget(CacheConstants::BookingHistoryCache);
        }
    }

    public function updated(BookingHistory $bookingHistory)
    {
        if (Cache::has(CacheConstants::BookingHistoryCache)){
            Cache::forget(CacheConstants::BookingHistoryCache);
        }
    }

    public function deleted(BookingHistory $bookingHistory)
    {
        if (Cache::has(CacheConstants::BookingHistoryCache)){
            Cache::forget(CacheConstants::BookingHistoryCache);
        }
    }

    public function restored(BookingHistory $bookingHistory)
    {
    }

    public function forceDeleted(BookingHistory $bookingHistory)
    {
    }
}
