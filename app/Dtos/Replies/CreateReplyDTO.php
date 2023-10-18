<?php

namespace App\Dtos\Replies;

class CreateReplyDTO
{
    public function __construct(
        public string $support_id,
        public string $content,
    ) {
    }

    public static function makeFromRequest(object $request): self
    {
        return new self(
            $request->route('id'),
            $request->content,
        );
    }
}
