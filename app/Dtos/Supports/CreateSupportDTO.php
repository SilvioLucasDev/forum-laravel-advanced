<?php

namespace App\Dtos\Supports;

use App\Enums\SupportStatusEnum;
use App\Http\Requests\StoreUpdateSupportRequest;

class CreateSupportDTO
{
    public function __construct(
        public string $subject,
        public SupportStatusEnum $status,
        public string $body,
    ) {
    }

    public static function makeFromRequest(StoreUpdateSupportRequest $request)
    {
        return new self(
            $request->subject,
            SupportStatusEnum::A,
            $request->body,
        );
    }
}
