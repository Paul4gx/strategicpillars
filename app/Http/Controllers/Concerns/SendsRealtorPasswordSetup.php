<?php

namespace App\Http\Controllers\Concerns;

use App\Models\User;
use Illuminate\Support\Facades\Password;

trait SendsRealtorPasswordSetup
{
    protected function sendPasswordSetupLink(User $user): bool
    {
        return Password::sendResetLink(['email' => $user->email]) === Password::RESET_LINK_SENT;
    }
}
