<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'event_date',
        'start_time',
        'end_time',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
        ];
    }

    // Relasi event dengan user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
