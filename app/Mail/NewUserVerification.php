<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserVerification extends Mailable
{
    use Queueable, SerializesModels;

    private $new_user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $new_user)
    {
        $this->new_user = $new_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Ein neuer Nutzer wartet auf Freigabe')
            ->markdown('emails.admin.userverification', ['user' => $this->new_user]);
    }
}
