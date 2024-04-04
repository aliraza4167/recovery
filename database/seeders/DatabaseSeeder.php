<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Profile::factory(10)->create();
        \App\Models\Post::factory(10)->create();
        \App\Models\Ache::factory(10)->create();
        // \App\Models\Conversation::factory()->has(User::factory()->count(2))->create();
        \App\Models\Message::factory(10)->create();
        // \App\Models\ConversationUser::factory(10)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
