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
                $teamMember = $team;
        return view('admin.team.show', compact('teamMember'));
    }

    public function edit(TeamMember $team)
    {
        $teamMember = $team;
        return view('admin.team.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'role'         => 'required|string|max:255',
            'bio'          => 'nullable|string',
            'photo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'sort_order'   => 'nullable|integer',
            'social_links' => 'nullable|array',
            'social_links.*.platform' => 'nullable|string|max:50',
            'social_links.*.username' => 'nullable|string|max:255',
        ]);

        $teamMember->fill($validated);
        $teamMember->social_links = $request->input('social_links', []);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads/team', 'public');
            $teamMember->photo = basename($photoPath);
        }

        $teamMember->save();

        return redirect()
            ->route('admin.team.edit', $teamMember)
            ->with('success', 'Team member updated successfully!');
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member deleted successfully!');
    }
}
