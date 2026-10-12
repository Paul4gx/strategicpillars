<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompleteRealtorOnboardingRequest;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OnboardingController extends Controller
{
    public function edit(): View
    {
        return view('realtor.onboarding');
    }

    public function update(CompleteRealtorOnboardingRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->name = $request->validated('name');
        $user->realty_display_name = $request->validated('realty_display_name');
        $user->phone = $request->validated('phone');
        $user->bio = $request->validated('bio');

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            if ($user->avatar_path) {
                Storage::disk('public')->delete('uploads/team/'.$user->avatar_path);
            }
            $path = $request->file('avatar')->store('uploads/team', 'public');
            $user->avatar_path = basename($path);
        }

        $user->onboarding_completed_at = now();
        $user->save();

        TeamMember::query()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $user->name,
                'role' => 'Realtor',
                'email' => $user->email,
                'phone' => $user->phone,
                'bio' => $user->bio,
                'photo' => $user->avatar_path,
                'sort_order' => (int) (TeamMember::query()->max('sort_order') ?? 0) + 1,
            ]
        );

        return redirect()->route('realtor.dashboard')->with('success', 'Your profile is ready. You can now manage listings.');
    }
}
