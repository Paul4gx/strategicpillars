<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\InviteRealtorRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RealtorInviteController extends Controller
{
    public function create(): View
    {
        return view('admin.team.invite');
    }

    public function store(InviteRealtorRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'password' => Hash::make(Str::password(32)),
            'role' => UserRole::Realtor,
        ]);

        Password::sendResetLink(['email' => $user->email]);

        return redirect()
            ->route('admin.team.index')
            ->with('success', 'Realtor invited. They will receive an email to set their password.');
    }
}
