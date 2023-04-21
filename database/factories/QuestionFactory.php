<?php

namespace ReesMcIvor\Forms\Database\Factories;

use ReesMcIvor\Forms\Models\Form;
use Illuminate\Database\Eloquent\Factories\Factory;
use ReesMcIvor\Forms\Models\FormQuestion;

class FormQuestionFactory extends Factory
{
    protected $model = FormQuestion::class;

    public function definition()
    {
        return [
            'question' => $this->faker->name,
        ];
    }
}
