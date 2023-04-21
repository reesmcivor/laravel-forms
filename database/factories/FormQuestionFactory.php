<?php

namespace ReesMcIvor\Forms\Database\Factories;

use ReesMcIvor\Forms\Models\Form;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormQuestionFactory extends Factory
{
    protected $model = Form::class;

    public function definition()
    {
        return [
            'question' => $this->faker->name,
        ];
    }
}
