<?php

namespace ReesMcIvor\Forms\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use ReesMcIvor\Forms\Models\TextAnswer;

class ChoiceAnswerFactory extends Factory
{
    protected $model = TextAnswer::class;

    public function definition()
    {
        return [
            'choice_id' => Choice::factory()->create(),
        ];
    }
}
