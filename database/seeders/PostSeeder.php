<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()
        ->count(1)
        ->hasComments(2)
        ->create();

        Post::factory()
        ->count(1)
        ->hasComments(1)
        ->create();

        Post::factory()
        ->count(1)
        ->hasComments(3)
        ->create();
    }
}
