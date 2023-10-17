<?php

namespace App\Models;

use App\Enums\SupportStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'body',
        'status',
    ];

    // protected $casts = [
    //     'status' => SupportStatusEnum::class,
    // ];

    public function status(): Attribute
    {
        return Attribute::make(
            set: fn (SupportStatusEnum $status) => $status->name
        );
    }
}
