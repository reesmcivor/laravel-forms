<?php

namespace ReesMcIvor\Forms\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use ReesMcIvor\Forms\Http\LiveWire\Question\Text;
use ReesMcIvor\Forms\Models\TextAnswer;
use ReesMcIvor\Forms\Models\VarcharAnswer;

class TextAnswerFactory extends Factory
{
    protected $model = TextAnswer::class;

    public function definition()
    {
        return [
            'answer' => $this->faker->text(100),
        ];
    }
}
