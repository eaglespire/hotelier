<?php

namespace App\Observers;

use App\Constants\CacheConstants;
use App\Models\Feature;
use Illuminate\Support\Facades\Cache;

class FeatureObserver
{
    /**
     * Handle the Feature "created" event.
     *
     * @param  \App\Models\Feature  $feature
     * @return void
     */
    public function created(Feature $feature)
    {
        if (Cache::has(CacheConstants::FeaturesCache)){
            Cache::forget(CacheConstants::FeaturesCache);
        }
    }

    /**
     * Handle the Feature "updated" event.
     *
     * @param  \App\Models\Feature  $feature
     * @return void
     */
    public function updated(Feature $feature)
    {
        if (Cache::has(CacheConstants::FeaturesCache)){
            Cache::forget(CacheConstants::FeaturesCache);
        }
    }

    /**
     * Handle the Feature "deleted" event.
     *
     * @param  \App\Models\Feature  $feature
     * @return void
     */
    public function deleted(Feature $feature)
    {
        if (Cache::has(CacheConstants::FeaturesCache)){
            Cache::forget(CacheConstants::FeaturesCache);
        }
    }

    /**
     * Handle the Feature "restored" event.
     *
     * @param  \App\Models\Feature  $feature
     * @return void
     */
    public function restored(Feature $feature)
    {
        //
    }

    /**
     * Handle the Feature "force deleted" event.
     *
     * @param  \App\Models\Feature  $feature
     * @return void
     */
    public function forceDeleted(Feature $feature)
    {
        //
    }
}
