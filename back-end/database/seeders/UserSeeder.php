<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::all();
        if (empty($user)) {
            $user->factory(5)->create();
        
            $user->factory()->create([
                'name' => 'UserTeste',
                'email' => 'test@example.com',
                'password' => Hash::make('123')
            ]);    
        }
        
    }
}
