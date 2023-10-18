<?php

namespace App\Dtos\Replies;

use App\Http\Requests\StoreUpdateSupportRequest;

class CreateReplyDTO
{
    public function __construct(
        public string $supportId,
        public string $subject,
    ) {
    }

    // public static function makeFromRequest(StoreUpdateSupportRequest $request)
    // {
    //     return new self(
    //         $request->subject,
    //         $request->body,
    //     );
    // }
}
