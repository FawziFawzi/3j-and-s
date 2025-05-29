<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\InvitationCode;
use App\Models\Project;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'User',
             'email' => 'user@email.com',
         ]);
         User::factory(3)->create();
         Project::factory(2)->create([
             'status' => 'active'
         ]);
        Project::factory(2)->create([
            'status' => 'finished'
        ]);
         Stock::factory(3)->create();

    }
}
