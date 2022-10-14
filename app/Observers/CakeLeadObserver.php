<?php

namespace App\Observers;

use App\Jobs\CakeAvailableJob;
use App\Models\CakeLead;

class CakeLeadObserver
{
    /**
     * Handle the CakeLead "created" event.
     *
     * @param  \App\Models\CakeLead  $cakeLead
     * @return void
     */
    public function created(CakeLead $cakeLead)
    {
        $cake = $cakeLead->cake;
        if(!is_null($cake) && $cake->isAvailable()) {
            CakeAvailableJob::dispatch($cakeLead);
        }
    }

    /**
     * Handle the CakeLead "updated" event.
     *
     * @param  \App\Models\CakeLead  $cakeLead
     * @return void
     */
    public function updated(CakeLead $cakeLead)
    {
        //
    }

    /**
     * Handle the CakeLead "deleted" event.
     *
     * @param  \App\Models\CakeLead  $cakeLead
     * @return void
     */
    public function deleted(CakeLead $cakeLead)
    {
        //
    }

    /**
     * Handle the CakeLead "restored" event.
     *
     * @param  \App\Models\CakeLead  $cakeLead
     * @return void
     */
    public function restored(CakeLead $cakeLead)
    {
        //
    }

    /**
     * Handle the CakeLead "force deleted" event.
     *
     * @param  \App\Models\CakeLead  $cakeLead
     * @return void
     */
    public function forceDeleted(CakeLead $cakeLead)
    {
        //
    }
}
