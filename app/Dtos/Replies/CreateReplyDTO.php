<?php

namespace App\Dtos\Replies;

use App\Http\Requests\StoreReplySupportRequest;

class CreateReplyDTO
{
    public function __construct(
        public string $support_id,
        public string $content,
    ) {
    }

    public static function makeFromRequest(StoreReplySupportRequest $request): self
    {
        return new self(
            $request->route('id'),
            $request->content,
        );
    }
}
