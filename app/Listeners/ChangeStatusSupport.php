<?php

namespace App\Listeners;

use App\Enums\SupportStatusEnum;
use App\Events\SupportRepliedEvent;
use App\Services\SupportService;
use Illuminate\Support\Facades\Gate;

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
        if (Gate::allows('owner', $reply->support['user_id'])) {
            $status = SupportStatusEnum::A;
        } else {
            $status = SupportStatusEnum::P;
        }

        $this->supportService->updateStatus(
            $reply->support_id,
            $status
        );
    }
}
