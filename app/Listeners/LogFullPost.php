<?php

namespace App\Listeners;

use App\Events\FullPostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogFullPost
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
     * @param  FullPostCreated  $event
     * @return void
     */
    public function handle(FullPostCreated $event)
    {
        Log::info('Logging full post', ['post' => $event->post]);
    }
}
