<?php

namespace App\Observers;

use App\Constants\CacheConstants;
use App\Models\Employee;
use Illuminate\Support\Facades\Cache;

class StaffObserver
{
    /**
     * Handle the Employee "created" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function created(Employee $employee)
    {
        if (Cache::has(CacheConstants::StaffCache)){
            Cache::forget(CacheConstants::StaffCache);
        }
    }

    /**
     * Handle the Employee "updated" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function updated(Employee $employee)
    {
        if (Cache::has(CacheConstants::StaffCache)){
            Cache::forget(CacheConstants::StaffCache);
        }
    }

    /**
     * Handle the Employee "deleted" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function deleted(Employee $employee)
    {
        if (Cache::has(CacheConstants::StaffCache)){
            Cache::forget(CacheConstants::StaffCache);
        }
    }

    /**
     * Handle the Employee "restored" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function restored(Employee $employee)
    {
        //
    }

    /**
     * Handle the Employee "force deleted" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function forceDeleted(Employee $employee)
    {
        //
    }
}
