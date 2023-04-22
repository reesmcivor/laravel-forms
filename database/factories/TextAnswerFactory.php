<?php

namespace ReesMcIvor\Forms\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use ReesMcIvor\Forms\Models\TextAnswer;

class TextAnswerFactory extends Factory
{
    protected $model = TextAnswer::class;

    public function definition()
    {
        return [
            'answer' => $this->faker->name,
        ];
    }
}
