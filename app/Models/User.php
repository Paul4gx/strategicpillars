<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'realty_display_name',
        'phone',
        'bio',
        'avatar_path',
        'onboarding_completed_at',
        'deactivated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            'onboarding_completed_at' => 'datetime',
            'deactivated_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (User $user) {
            $user->is_admin = in_array($user->role, [UserRole::MainAdmin, UserRole::Admin], true);
        });
    }

    public function isMainAdmin(): bool
    {
        return $this->role === UserRole::MainAdmin;
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, [UserRole::MainAdmin, UserRole::Admin], true);
    }

    public function canManageTeam(): bool
    {
        return $this->isMainAdmin();
    }

    public function isActive(): bool
    {
        return $this->deactivated_at === null;
    }

    public function isRealtor(): bool
    {
        return $this->role === UserRole::Realtor;
    }

    public function isClient(): bool
    {
        return $this->role === UserRole::Client;
    }

    public function publicBrandName(): string
    {
        return $this->realty_display_name ?: $this->name;
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    public function teamMemberProfile(): HasOne
    {
        return $this->hasOne(TeamMember::class);
    }

    public function avatarUrl(): ?string
    {
        if (! $this->avatar_path) {
            return null;
        }

        return asset('storage/uploads/team/'.$this->avatar_path);
    }

    public function intendedDashboardUrl(): string
    {
        if ($this->isAdmin()) {
            return route('admin.dashboard');
        }

        if ($this->isRealtor()) {
            if (! $this->onboarding_completed_at) {
                return route('realtor.onboarding.edit');
            }

            return route('realtor.dashboard');
        }

        return route('dashboard');
    }
}
