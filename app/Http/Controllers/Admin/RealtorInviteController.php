<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Concerns\SendsRealtorPasswordSetup;
use App\Http\Controllers\Controller;
use App\Http\Requests\InviteRealtorRequest;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RealtorInviteController extends Controller
{
    use SendsRealtorPasswordSetup;

    public function create(): View
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        abort_unless($user?->canManageTeam(), 403, 'Only the main admin can invite realtors.');

        return view('admin.team.invite');
    }

    public function store(InviteRealtorRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make(Str::password(32)),
            'role' => UserRole::Realtor,
        ]);

        TeamMember::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'role' => 'Realtor',
            'email' => $user->email,
            'sort_order' => (int) (TeamMember::query()->max('sort_order') ?? 0) + 1,
            'is_visible' => false,
        ]);

        $emailSent = $this->sendPasswordSetupLink($user);

        if (! $emailSent) {
            return redirect()
                ->route('admin.team.index')
                ->with('error', 'Realtor added to the team list, but the password-setup email could not be sent. Use "Resend invite" after checking your mail settings.');
        }

        return redirect()
            ->route('admin.team.index')
            ->with('success', 'Realtor invited and added to the team list. A password-setup email was sent to '.$user->email.'.');
    }
}
