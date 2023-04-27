<?php

namespace ReesMcIvor\Forms\Database\Factories;

use ReesMcIvor\Forms\Models\Form;
use Illuminate\Database\Eloquent\Factories\Factory;
use ReesMcIvor\Forms\Models\Question;
use ReesMcIvor\Forms\Models\VarcharAnswer;
use Tests\Forms\Unit\Tenant\AnswerTest;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        return [
            'question' => $this->faker->name,
            'type' => $this->faker->randomElement(['text', 'textarea', 'select', 'radio', 'checkbox']),
        ];
    }
}
