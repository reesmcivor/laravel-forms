<?php

namespace ReesMcIvor\Forms\Database\Factories;

use ReesMcIvor\Forms\Models\Form;
use Illuminate\Database\Eloquent\Factories\Factory;
use ReesMcIvor\Forms\Models\Question;

class TextAnswerFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        return [
            'answer' => Question::TYPE_TEXT,
        ];
    }
}
