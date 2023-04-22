<?php

namespace ReesMcIvor\Forms\Database\Factories;

use ReesMcIvor\Forms\Models\Form;
use Illuminate\Database\Eloquent\Factories\Factory;
use ReesMcIvor\Forms\Models\Question;
use Tests\Forms\Unit\Tenant\AnswerTest;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        return [
            'question' => $this->faker->name,
            'answerable_type' => AnswerText::class,
        ];
    }
}
