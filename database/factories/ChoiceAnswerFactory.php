<?php

namespace ReesMcIvor\Forms\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use ReesMcIvor\Forms\Models\VarcharAnswer;

class ChoiceAnswerFactory extends Factory
{
    protected $model = VarcharAnswer::class;

    public function definition()
    {
        return [
            'choice_id' => Choice::factory()->create(),
        ];
    }
}
