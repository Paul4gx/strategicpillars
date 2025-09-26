<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::orderBy('sort_order')->get();
        \Log::info('Team members loaded:', $teamMembers->pluck('id', 'name')->toArray());
        return view('admin.team.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'role'         => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:team_members,email',
            'phone'        => 'required|string|max:20',
            'bio'          => 'nullable|string',
            'photo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'sort_order'   => 'nullable|integer',
            'social_links' => 'nullable|array',
            'social_links.*.platform' => 'nullable|string|max:50',
            'social_links.*.username' => 'nullable|string|max:255',
        ]);

        $teamMember = new TeamMember($validated);

        // Save socials as array (JSON in DB if casted)
        $teamMember->social_links = $request->input('social_links', []);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads/team', 'public');
            $teamMember->photo = basename($photoPath);
        }

        $teamMember->save();

        return redirect()->route('admin.team.index')->with('success', 'Team member created successfully!');
    }

    public function show(TeamMember $team)
    {
        return view('admin.team.show', compact('team'));
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'role'         => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:team_members,email,' . $team->id,
            'phone'        => 'required|string|max:20',
            'bio'          => 'nullable|string',
            'photo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'sort_order'   => 'nullable|integer',
            'social_links' => 'nullable|array',
            'social_links.*.platform' => 'nullable|string|max:50',
            'social_links.*.username' => 'nullable|string|max:255',
        ]);

        $team->fill($validated);
        $team->social_links = $request->input('social_links', []);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads/team', 'public');
            $team->photo = basename($photoPath);
        }

        $team->save();

        return redirect()
            ->route('admin.team.index')
            ->with('success', 'Team member updated successfully!');
    }

    public function destroy(TeamMember $team)
    {
        try {
            // Debug: Log the team member details
            \Log::info('Delete request received:', [
                'team_id' => $team->id,
                'team_name' => $team->name,
                'team_email' => $team->email
            ]);
            
            // Use the team member directly
            $teamMember = $team;
            
            // Debug: Log the team member details
            \Log::info('Team member found:', [
                'id' => $teamMember->id,
                'name' => $teamMember->name,
                'email' => $teamMember->email
            ]);
            
            // Get the team member name before deletion for the success message
            $teamMemberName = $teamMember->name;
            
            // Delete the photo file if it exists
            if ($teamMember->photo) {
                $photoPath = storage_path('app/public/uploads/team/' . $teamMember->photo);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                    \Log::info('Photo file deleted: ' . $photoPath);
                }
            }
            
            // Permanently delete the team member from database
            $deleted = $teamMember->delete();
            
            \Log::info('Delete result:', ['deleted' => $deleted, 'team_member_id' => $teamMember->id]);
            
            return redirect()->route('admin.team.index')
                ->with('success', "Team member '{$teamMemberName}' has been permanently deleted!");
                
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error deleting team member: ' . $e->getMessage(), [
                'team_member_id' => $teamMember->id ?? 'unknown',
                'exception' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('admin.team.index')
                ->with('error', 'Failed to delete team member. Please try again.');
        }
    }
}
