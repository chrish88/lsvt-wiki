<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Str;
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

        $title = $this->faker->sentence();
        return [
            'user_id'       => User::factory()->create(),
            'title'         => $title,
            'description'   => $this->faker->paragraph(2),
            'body'          => $this->faker->paragraphs(4,true),
            'slug'          => Str::slug($title)

        ];
    }
}
