<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Relasi user dengan daftar tugas
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    // Relasi user dengan daftar event
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    // Relasi user dengan daftar checkpoint
    public function checkpoints(): HasMany
    {
        return $this->hasMany(Checkpoint::class);
    }

    // Relasi user dengan daftar catatan
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
