<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(5);

        return [
            'category_id'   => rand(1, 10),
            'author_id'     => rand(1, 1000),
            'title'         => $title,
            'description'   => $this->faker->text(50),
            'content'       => $this->faker->text(200),
            'image'         => $this->faker->imageUrl(750, 300, 'nature'),
            'slug'          => \Str::slug($title),
            'featured'      => $this->faker->boolean,
            'date'          => date('Y-m-d')
        ];
    }
}
