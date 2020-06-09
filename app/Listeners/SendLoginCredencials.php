<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Events\UserWasCreated;
use App\Mail\LoginCredentials;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
class SendLoginCredencials
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
     * @param  UserWasCreated  $event
     * @return void
     */
    public function handle(UserWasCreated $event)
    {
        // dd($event->user->toArray(), $event->password);
        Mail::to($event->user)->queue(new LoginCredentials($event->user, $event->password) );
    }
}
