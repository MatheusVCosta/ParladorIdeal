<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::all();
        $users->each(function ($user) 
        {
            \App\Models\Post::factory(3)->create([
                'user_id' => $user->id,
                'created_at' => fake()->dateTime()->format('d-m-Y H:i:s'),
            ]);
            
        });
    }
}
