<?php

namespace ReesMcIvor\Forms\Database\Factories;

use ReesMcIvor\Forms\Models\Form;
use Illuminate\Database\Eloquent\Factories\Factory;
use ReesMcIvor\Forms\Models\Question;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        return [
            'question' => $this->faker->name,
            'answetable_type' => Question::TYPE_TEXT,
        ];
    }
}
