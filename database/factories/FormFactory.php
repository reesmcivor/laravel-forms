<?php

namespace ReesMcIvor\Forms\Database\Factories;

use YourVendorName\MyLaravelPackage\ExampleModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExampleModelFactory extends Factory
{
    protected $model = ExampleModel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            // Add more fields as needed
        ];
    }
}
