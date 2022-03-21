<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'title' => Str::random(11),
        ]);

        DB::table('posts')->insert([
            'title' => Str::random(25),
        ]);

        Post::create([
            'title' => Str::random(11),
        ]);

        DB::table('posts')->insert([
            'title' => Str::random(25),
        ]);

        Post::create([
            'title' => Str::random(11),
        ]);

        DB::table('posts')->insert([
            'title' => Str::random(25),
        ]);

    }
}
