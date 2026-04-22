<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamMemberRequest;
use App\Http\Requests\UpdateTeamMemberRequest;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::with('user')->orderBy('sort_order')->get();

        return view('admin.team.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(StoreTeamMemberRequest $request)
    {
        $validated = $request->validated();
        $createAccount = $request->boolean('create_property_account');
        unset($validated['create_property_account']);

        $teamMember = new TeamMember($validated);
        $teamMember->social_links = $request->input('social_links', []);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads/team', 'public');
            $teamMember->photo = basename($photoPath);
        }

        $teamMember->save();

        $accountCreated = false;
        if ($createAccount) {
            $accountCreated = $this->provisionRealtorLinkedUser($teamMember);
        }

        $message = 'Team member created successfully.';
        if ($accountCreated) {
            $message .= ' A realtor login was created and a password-setup email was sent to '.$teamMember->email.'.';
        }

        return redirect()->route('admin.team.index')->with('success', $message);
    }

    public function show(TeamMember $team)
    {
        $team->load('user');

        return view('admin.team.show', compact('team'));
    }

    public function edit(TeamMember $team)
    {
        $team->load('user');

        return view('admin.team.edit', compact('team'));
    }

    public function update(UpdateTeamMemberRequest $request, TeamMember $team)
    {
        $validated = $request->validated();
        $createAccount = $request->boolean('create_property_account');
        unset($validated['create_property_account']);

        $team->fill($validated);
        $team->social_links = $request->input('social_links', []);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads/team', 'public');
            $team->photo = basename($photoPath);
        }

        $team->save();

        if ($team->user_id) {
            $team->load('user');
            $team->user->forceFill([
                'name' => $team->name,
                'email' => $team->email,
                'phone' => $team->phone,
                'bio' => $team->bio,
                'avatar_path' => $team->photo,
            ])->save();
        }

        $accountCreated = false;
        if ($createAccount) {
            $team->refresh();
            $accountCreated = $this->provisionRealtorLinkedUser($team);
        }

        $message = 'Team member updated successfully.';
        if ($accountCreated) {
            $message .= ' A realtor login was created and a password-setup email was sent to '.$team->email.'.';
        }

        return redirect()
            ->route('admin.team.index')
            ->with('success', $message);
    }

    public function destroy(TeamMember $team)
    {
        try {
            $teamMemberName = $team->name;
            $hadUser = (bool) $team->user_id;

            if ($team->photo) {
                $photoPath = storage_path('app/public/uploads/team/'.$team->photo);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }

            $team->delete();

            $message = "Team member '{$teamMemberName}' has been permanently deleted.";
            if ($hadUser) {
                $message .= ' Their realtor login (user account) was not removed—manage users separately if needed.';
            }

            return redirect()->route('admin.team.index')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Error deleting team member: '.$e->getMessage(), [
                'team_member_id' => $team->id ?? 'unknown',
                'exception' => $e->getTraceAsString(),
            ]);

            return redirect()->route('admin.team.index')
                ->with('error', 'Failed to delete team member. Please try again.');
        }
    }

    /**
     * Create a realtor User, link to this team member, and email a password reset link.
     */
    protected function provisionRealtorLinkedUser(TeamMember $teamMember): bool
    {
        if ($teamMember->user_id) {
            return false;
        }

        $user = User::create([
            'name' => $teamMember->name,
            'email' => $teamMember->email,
            'password' => Hash::make(Str::password(32)),
            'role' => UserRole::Realtor,
            'phone' => $teamMember->phone,
            'bio' => $teamMember->bio,
            'avatar_path' => $teamMember->photo,
        ]);

        $teamMember->user_id = $user->id;
        $teamMember->save();

        Password::sendResetLink(['email' => $user->email]);

        return true;
    }
}
