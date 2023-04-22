<?php

namespace ReesMcIvor\Forms\Database\Factories;

use ReesMcIvor\Forms\Models\Form;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormEntryFactory extends Factory
{
    protected $model = Form::class;

    public function definition()
    {
        return [
            'user_id' => 1
        ];
    }
}
