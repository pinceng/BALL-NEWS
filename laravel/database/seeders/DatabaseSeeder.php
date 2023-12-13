<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Levels;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => "Tekno",
            'slug' => "tekno",
        ]);

        Category::create([
            'name' => "Health",
            'slug' => "health",
        ]);

        Category::create([
            'name' => "Otomotif",
            'slug' => "otomotif",
        ]);

        Category::create([
            'name' => "Bola",
            "slug" => "bola"
        ]);


        Levels::create([
            'name' => "Admin",
            "slug" => "Admin"
        ]);

        Levels::create([
            "name" => "Editor",
            "slug" => "Editor",
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'level' => 1,
            'password' => Hash::make("admin"),
        ]);

    }
}
