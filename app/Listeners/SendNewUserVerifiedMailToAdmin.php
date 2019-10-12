<?php

namespace App\Listeners;

use App\Mail\NewUserVerification;
use App\Notifications\NewUserVerified;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewUserVerifiedMailToAdmin
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $superadmin = User::superadministrators()->first();
        if ($superadmin) {
            Mail::to($superadmin)->send(new NewUserVerification($event->user));
        }
    }
}
