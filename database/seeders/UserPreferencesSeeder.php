<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserPreference;
use App\Models\User;

class UserPreferencesSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            // updateOrCreate evita errores si ya existe el registro
            UserPreference::updateOrCreate(
                ['user_id' => $user->id], 
                [
                    'dark_mode' => rand(0, 1),
                    'notifications_enabled' => rand(0, 1),
                    'compact_view' => rand(0, 1),
                ]
            );
        }

        $this->command->info("Preferencias creadas para " . $users->count() . " usuarios.");
    }
}