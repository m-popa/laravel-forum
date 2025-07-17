<?php

namespace Database\Seeders;

use App\Models\Thread;
use App\Models\Comment;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);

        Thread::factory(10)
              ->create()
              ->each(function (Thread $thread) {
                  Comment::factory(3)
                         ->create([
                             'thread_id' => $thread->id,
                         ])
                         ->each(function (Comment $reply) use ($thread) {
                             Comment::factory(2)->create([
                                 'thread_id' => $thread->id,
                                 'parent_id' => $reply->id,
                             ]);
                         });
              });
    }
}
