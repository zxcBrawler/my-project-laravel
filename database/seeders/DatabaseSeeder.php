<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RoleSeeder::class);
        $this->call(ModeratorSeeder::class);

        User::factory(10)->create([
            'role_id' => 2
        ]);

        Article::factory()
            ->count(50)
            ->create();

        Article::factory()
            ->unpublished()
            ->count(5)
            ->create();
            
        Article::factory()
            ->popular()
            ->count(10)
            ->create();
    }
}
