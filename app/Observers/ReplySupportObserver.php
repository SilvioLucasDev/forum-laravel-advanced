<?php

namespace App\Observers;

use App\Models\ReplySupport;
use Illuminate\Support\Facades\Auth;

class ReplySupportObserver
{
    /**
     * Handle the ReplySupport "creating" event.
     */
    public function creating(ReplySupport $replySupport): void
    {
        $replySupport->user_id = Auth::user()->id;
    }
}
