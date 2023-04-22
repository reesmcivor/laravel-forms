<?php

namespace ReesMcIvor\Forms\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use ReesMcIvor\Forms\Models\Question;

class TextAnswerFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        return [
            'answer' => $this->faker->name,
        ];
    }
}
