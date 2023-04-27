<?php

namespace ReesMcIvor\Forms\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use ReesMcIvor\Forms\Models\Choice;
use ReesMcIvor\Forms\Models\VarcharAnswer;

class ChoiceFactory extends Factory
{
    protected $model = Choice::class;

    public function definition()
    {
        return [
            'choice' => $this->faker->name,
        ];
    }
}
