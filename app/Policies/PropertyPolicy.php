<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;

class PropertyPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isRealtor();
    }

    public function view(User $user, Property $property): bool
    {
        return $user->isAdmin() || ($user->isRealtor() && (int) $property->user_id === (int) $user->id);
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isRealtor();
    }

    public function update(User $user, Property $property): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->isRealtor()
            && $property->user_id !== null
            && (int) $property->user_id === (int) $user->id;
    }

    public function delete(User $user, Property $property): bool
    {
        return $this->update($user, $property);
    }

    public function deleteImage(User $user, Property $property): bool
    {
        return $this->update($user, $property);
    }
}
