<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checkpoint extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'target_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'target_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
