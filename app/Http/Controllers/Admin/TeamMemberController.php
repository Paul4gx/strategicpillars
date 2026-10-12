<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Concerns\SendsRealtorPasswordSetup;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamMemberRequest;
use App\Http\Requests\UpdateTeamMemberRequest;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TeamMemberController extends Controller
{
    use SendsRealtorPasswordSetup;
    protected function ensureCanManageTeam(): void
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        abort_unless($user?->canManageTeam(), 403, 'Only the main admin can manage team profiles.');
    }

    public function index()
    {
        $teamMembers = TeamMember::with('user')->orderBy('sort_order')->get();

        return view('admin.team.index', compact('teamMembers'));
    }

    public function create()
    {
        $this->ensureCanManageTeam();

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

        if ($createAccount) {
            $provisioned = $this->provisionRealtorLinkedUser($teamMember);

            if ($provisioned['created'] && ! $provisioned['email_sent']) {
                return redirect()
                    ->route('admin.team.index')
                    ->with('error', 'Team member created and login added, but the password-setup email could not be sent. Use "Resend invite" after checking your mail settings.');
            }

            if ($provisioned['created']) {
                return redirect()
                    ->route('admin.team.index')
                    ->with('success', 'Team member created. A realtor login was added and a password-setup email was sent to '.$teamMember->email.'.');
            }
        }

        return redirect()->route('admin.team.index')->with('success', 'Team member created successfully.');
    }

    public function show(TeamMember $team)
    {
        $team->load('user');

        return view('admin.team.show', compact('team'));
    }

    public function edit(TeamMember $team)
    {
        $this->ensureCanManageTeam();

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

        if ($createAccount) {
            $team->refresh();
            $provisioned = $this->provisionRealtorLinkedUser($team);

            if ($provisioned['created'] && ! $provisioned['email_sent']) {
                return redirect()
                    ->route('admin.team.index')
                    ->with('error', 'Team member updated and login added, but the password-setup email could not be sent. Use "Resend invite" after checking your mail settings.');
            }

            if ($provisioned['created']) {
                return redirect()
                    ->route('admin.team.index')
                    ->with('success', 'Team member updated. A realtor login was added and a password-setup email was sent to '.$team->email.'.');
            }
        }

        return redirect()
            ->route('admin.team.index')
            ->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $team)
    {
        $this->ensureCanManageTeam();

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

    public function toggleListingAccount(TeamMember $team)
    {
        $this->ensureCanManageTeam();
        $team->load('user');

        if (! $team->user) {
            return redirect()
                ->route('admin.team.index')
                ->with('error', 'This team member does not have a linked listing account yet.');
        }

        $isCurrentlyActive = $team->user->isActive();
        $team->user->forceFill([
            'deactivated_at' => $isCurrentlyActive ? now() : null,
        ])->save();

        $message = $isCurrentlyActive
            ? "{$team->name}'s listing account has been deactivated."
            : "{$team->name}'s listing account has been reactivated.";

        return redirect()->route('admin.team.index')->with('success', $message);
    }

    public function toggleVisibility(TeamMember $team)
    {
        $this->ensureCanManageTeam();

        $team->forceFill([
            'is_visible' => ! $team->is_visible,
        ])->save();

        $message = $team->is_visible
            ? "{$team->name}'s profile is now visible on the website."
            : "{$team->name}'s profile is now hidden from the website.";

        return redirect()->route('admin.team.index')->with('success', $message);
    }

    public function resendInvite(TeamMember $team)
    {
        $this->ensureCanManageTeam();
        $team->load('user');

        if (! $team->user) {
            return redirect()
                ->route('admin.team.index')
                ->with('error', 'This team member does not have a linked login account yet.');
        }

        if (! $team->user->isActive()) {
            return redirect()
                ->route('admin.team.index')
                ->with('error', 'Reactivate this account before resending the invite email.');
        }

        if (! $this->sendPasswordSetupLink($team->user)) {
            return redirect()
                ->route('admin.team.index')
                ->with('error', 'Could not send the password-setup email. Check your mail configuration (MAIL_MAILER, SMTP settings, etc.).');
        }

        return redirect()
            ->route('admin.team.index')
            ->with('success', 'Password-setup email resent to '.$team->user->email.'.');
    }

    /**
     * @return array{created: bool, email_sent: bool}
     */
    protected function provisionRealtorLinkedUser(TeamMember $teamMember): array
    {
        if ($teamMember->user_id) {
            return ['created' => false, 'email_sent' => false];
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

        return [
            'created' => true,
            'email_sent' => $this->sendPasswordSetupLink($user),
        ];
    }
}
