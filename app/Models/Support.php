<?php

namespace App\Models;

use App\Enums\SupportStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Support extends Model
{
    use HasFactory, HasUuids;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(ReplySupport::class);
    }
}
