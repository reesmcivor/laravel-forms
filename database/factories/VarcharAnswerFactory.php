<?php

namespace ReesMcIvor\Forms\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use ReesMcIvor\Forms\Models\TextAnswer;
use ReesMcIvor\Forms\Models\VarcharAnswer;

class VarcharAnswerFactory extends Factory
{
    protected $model = VarcharAnswer::class;

    public function definition()
    {
        return [
            'answer' => $this->faker->text(30),
        ];
    }
}
