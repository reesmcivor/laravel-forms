<?php

namespace ReesMcIvor\Forms\Console\Commands;

use Illuminate\Console\Command;
use ReesMcIvor\Forms\Models\Form;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SeedForms extends Command {

    protected $name = 'forms:seed';
    protected $description = 'Seed the forms package';

    public function run(InputInterface $input, OutputInterface $output): int
    {

        Form::all()->each(fn($item) => $item->delete());

        $form = Form::create([
            'name' => 'Consultation Form',
            'user_id' => 1,
            'description' => 'This is a test form'
        ]);

        FormEntry::create([
            'form_id' => $form->id,
            'user_id' => 1
        ]);

        $questions = [];
        $questions[] = Question::create([ 'type' => 'varchar',  'question' => 'What is your name?',  'required' => true ]);
        $questions[] = Question::create([ 'type' => 'varchar', 'question' => 'What is your email?', 'required' => true, 'validation' => 'email' ]);
        $questions[] = Question::create([ 'type' => 'date', 'question' => 'DOB?', 'required' => true, 'validation' => 'date' ]);
        $questions[] = Question::create([ 'type' => 'text', 'question' => 'Describe yourself?', 'required' => true, 'validation' => 'min:10' ]);

        collect($questions)->each(fn($question) => $form->questions()->attach($question));

        return Command::SUCCESS;

    }

}
