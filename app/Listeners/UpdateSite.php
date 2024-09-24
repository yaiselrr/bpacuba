<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Schema;
use App\Events\UpdatedSite;
use App\Models\SiteData;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateSite
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UpdatedSite  $event
     * @return void
     */
    public function handle(UpdatedSite $event)
    {
        //
        if(Schema::hasTable('site_data')){
            $site=SiteData::first();
            $site->actualizacion = Carbon::now();
            $site->save();
        }

    }
}
