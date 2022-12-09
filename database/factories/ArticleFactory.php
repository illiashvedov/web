<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        return [
            "text" => fake()-> text,
            "short_text" => fake()-> text,
            "author_name" => fake()-> name,
        ];
    }
}
