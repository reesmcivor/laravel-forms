<?php

namespace ReesMcIvor\Forms\Database\Seeds;

use Illuminate\Database\Seeder;
use ReesMcIvor\Forms\Models\Form;

class FormSeeder extends Seeder
{
    public function run(): void
    {
        Form::factory()->create([
            'name' => 'Consultation Form'
        ]);
    }
}
