<?php

namespace ReesMcIvor\Forms\Console\Commands;

use Illuminate\Console\Command;
use ReesMcIvor\Forms\Models\Choice;
use ReesMcIvor\Forms\Models\Form;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Group;
use ReesMcIvor\Forms\Models\Question;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SeedForms extends Command {

    protected $name = 'forms:seed';
    protected $description = 'Seed the forms package';

    public function run(InputInterface $input, OutputInterface $output): int
    {

        if(!Form::where('name', 'New Account Form')->exists()) {
            Form::create(['name' => 'New Account Form', 'description' => 'Setup an account with us']);
        }

        $form = Form::where('name', 'New Account Form')->first();
        if(!$form->groups->count()) {
            $form->groups()->create([
                'name' => 'Step 1',
                'description' => 'Personal Information',
                'group_id' => 0,
                'sort_order' => 1
            ]);
            $form->groups()->create([
                'name' => 'Step 2',
                'description' => 'Address Information',
                'group_id' => 0,
                'sort_order' => 2
            ]);
        }

        if(!Question::where('question', 'Name')->exists()) {
            Question::create([ 'type' => 'varchar',  'question' => 'Name',  'required' => true ]);
            Group::where('name', 'Step 1')->first()->questions()->attach(Question::where('question', 'Name')->first());
        }

        if(!Question::where('question', 'Address Line 1')->exists()) {
            Question::create([ 'type' => 'varchar',  'question' => 'Address Line 1',  'required' => true ]);
            Group::where('name', 'Step 2')->first()->questions()->attach(Question::where('question', 'Address Line 1')->first());
        }


        return Command::SUCCESS;

    }

}
