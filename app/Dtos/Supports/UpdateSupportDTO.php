<?php

namespace App\Dtos\Supports;

use App\Enums\SupportStatusEnum;
use App\Http\Requests\StoreUpdateSupportRequest;

class UpdateSupportDTO
{
    public function __construct(
        public string $id,
        public string $subject,
        public SupportStatusEnum $status,
        public string $body,
    ) {
    }

    public static function makeFromRequest(StoreUpdateSupportRequest $request)
    {
        return new self(
            $request->id ?? $request->support,
            $request->subject,
            SupportStatusEnum::A,
            $request->body,
        );
    }
}
