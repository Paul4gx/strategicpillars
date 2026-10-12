<?php

namespace App\Console\Commands;

use App\Enums\UserRole;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Console\Command;

class BackfillOrphanRealtorTeamMembers extends Command
{
    protected $signature = 'team:backfill-orphan-realtors';

    protected $description = 'Create team profiles for realtor logins that were invited before team linking was added';

    public function handle(): int
    {
        $orphans = User::query()
            ->where('role', UserRole::Realtor)
            ->whereDoesntHave('teamMemberProfile')
            ->get();

        if ($orphans->isEmpty()) {
            $this->info('No orphan realtor accounts found.');

            return self::SUCCESS;
        }

        $nextSort = (int) (TeamMember::query()->max('sort_order') ?? 0);

        foreach ($orphans as $user) {
            $nextSort++;
            TeamMember::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'role' => 'Realtor',
                'email' => $user->email,
                'phone' => $user->phone,
                'bio' => $user->bio,
                'photo' => $user->avatar_path,
                'sort_order' => $nextSort,
                'is_visible' => false,
            ]);

            $this->line("Linked team profile for {$user->email}");
        }

        $this->info("Backfilled {$orphans->count()} realtor account(s).");

        return self::SUCCESS;
    }
}
