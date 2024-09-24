<?php

namespace App\Listeners;

use App\Events\VisitorsCounter;
use App\Models\SiteData;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Session\Store;

class UpdateVisitors
{
    private $session;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Store $session)
    {
        //
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  VisitorsCounter  $event
     * @return void
     */
    public function handle(VisitorsCounter $event)
    {
        //
        if(!$this->session->exists('visited')) {
            $site = SiteData::first();
            $site->increment('visitas');
            $site->visitas += 1;
        }
        $this->storeSession();
    }
    private function storeSession(){
        $this->session->put('visited', time());
    }
}
