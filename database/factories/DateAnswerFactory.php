<?php

namespace ReesMcIvor\Forms\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use ReesMcIvor\Forms\Models\DateAnswer;

class DateAnswerFactory extends Factory
{
    protected $model = DateAnswer::class;

    public function definition()
    {
        return [
            'answer' => $this->faker->dateTimeWithTimezone,
        ];
    }
}
