<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VotingSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default admin user
        User::updateOrCreate(
            ['email' => 'admin@votingec.com'],
            [
                'name' => 'Admin Voting EC',
                'password' => Hash::make('password'),
            ]
        );

        // Default voting status
        VotingSetting::updateOrCreate(
            ['key' => 'voting_status'],
            ['value' => 'not_started']
        );
    }
}
