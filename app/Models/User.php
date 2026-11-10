<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username', 'name', 'last_name', 'email', 'address', 'password', 'storage_limit',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'storage_limit' => 'integer',
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(UserFile::class);
    }

    public function hasRole(string ...$roles): bool
    {
        return $this->roles->pluck('name')->intersect($roles)->isNotEmpty();
    }

    public function canViewAllFiles(): bool
    {
        return $this->hasRole('super_admin', 'admin');
    }

    public function canDownloadFile(UserFile $file): bool
    {
        return $this->canViewAllFiles() || $file->user_id === $this->id;
    }

    public function canDeleteFile(UserFile $file): bool
    {
        return $this->hasRole('super_admin') || $file->user_id === $this->id;
    }

    public function usedSpace(): int
    {
        return (int) $this->files()->sum('size');
    }

    public function freeSpace(): int
    {
        return max(0, $this->storage_limit - $this->usedSpace());
    }
}
