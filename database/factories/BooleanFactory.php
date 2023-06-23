<?php

namespace ReesMcIvor\Forms\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use ReesMcIvor\Forms\Models\BooleanAnswer;

class BooleanFactory extends Factory
{
    protected $model = BooleanAnswer::class;

    public function definition()
    {
        return [
            'answer' => $this->faker->boolean(),
        ];
    }
}
