<?php

use App\Enums\SupportStatusEnum;

if (! function_exists('getStatusSupport')) {
    function getStatusSupport(string $status): string
    {
        return SupportStatusEnum::fromValue($status);
    }
}
