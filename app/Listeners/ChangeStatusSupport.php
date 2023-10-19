<?php

namespace App\Listeners;

use App\Enums\SupportStatusEnum;
use App\Events\SupportRepliedEvent;
use App\Services\SupportService;

class ChangeStatusSupport
{
    /**
     * Create the event listener.
     */
    public function __construct(protected SupportService $supportService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SupportRepliedEvent $event): void
    {
        $reply = $event->reply();

        $this->supportService->updateStatus(
            $reply->support_id,
            SupportStatusEnum::P
        );
    }
}
