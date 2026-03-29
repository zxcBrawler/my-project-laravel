<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Модератор',
            'slug' => 'moderator',
            'description' => 'Полный доступ к управлению контентом',
        ]);

        Role::create([
            'name' => 'Читатель',
            'slug' => 'reader',
            'description' => 'Только просмотр и комментарии',
        ]);
    }
}
