<?php

namespace App\Listeners;

use App\Events\SupportRepliedEvent;
use App\Mail\SupportRepliedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendMailWhenSupportReplied implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SupportRepliedEvent $event): void
    {
        $support = $event->support();
        Mail::to($support->user['email'])->send(
            new SupportRepliedMail()
        );
    }
}
