<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Article, Tag};

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::factory()
            ->times(rand(500, 1000))
            ->create();


        $tags = Tag::all();

		Article::all()->each(function ($article) use ($tags) { 
		    $article->tags()->attach(
		        $tags->random(rand(1, 10))->pluck('id')->toArray()
		    ); 
		});
    }
}
