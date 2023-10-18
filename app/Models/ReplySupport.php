<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReplySupport extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'replies_support';

    protected $fillable = [
        'content',
        'support_id',
    ];

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($createdAt) => Carbon::make($createdAt)->format('d/m/Y H:i:s')
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function support(): BelongsTo
    {
        return $this->belongsTo(Support::class);
    }
}
