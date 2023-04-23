<?php

namespace ReesMcIvor\Forms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use ReesMcIvor\Forms\Models\Choice;
use ReesMcIvor\Forms\Models\ChoiceAnswer;
use ReesMcIvor\Forms\Models\Form;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;
use ReesMcIvor\Forms\Models\QuestionAnswer;

class FormController extends Controller
{
    public function index()
    {
        //FormEntry::create(['form_id' => 1, 'user_id' => 1]);
        $formEntries = FormEntry::with('form')->paginate(10);
        return view('forms::forms.index', [
            'formEntries' => $formEntries,
        ]);
    }

    public function create()
    {
        return view('forms::forms.create');
    }

    public function store(Request $request)
    {
        $form = Form::create($request->all());
        return redirect()->route('tenant.forms.index');
    }

    public function show(Form $form)
    {

        /*
        Question::all()->each(fn($question) => $question->delete());

        $form->questions()->attach(
            Question::create([
                'type' => 'text',
                'question' => 'What is your name?',
                'required' => true,
            ])
        );

        $question = Question::create([
            'type' => 'select',
            'question' => 'What is your favourite colour?',
            'required' => true,
        ]);

        Choice::create([
            'question_id' => $question->id,
            'choice' => 'Blue',
        ]);
        Choice::create([
            'question_id' => $question->id,
            'choice' => 'Red',
        ]);


        $form->questions()->attach($question);
        */


        return view('forms::forms.show', [
            'form' => $form,
        ]);
    }

    public function edit(Form $form)
    {
        return view('forms::forms.edit', [
            'form' => $form,
        ]);
    }

    public function update(Request $request, Form $form)
    {
        $form->update($request->all());
        return redirect()->route('tenant.forms.index');
    }

    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('tenant.forms.index');
    }

    public function submit(Form $form, Request $request)
    {
        $formEntry = FormEntry::firstOrCreate([
            'user_id' => auth()->user()->id,
            'form_id' => $form->id,
        ]);

        foreach($request->get('question') as $questionId => $questionAnswerId)
        {
            $question = Question::find($questionId);
            if($question->type == "select") {
                QuestionAnswer::create([
                    'form_entry_id' => $formEntry->id,
                    'question_id' => $question->id,
                    'answerable_id' => ChoiceAnswer::create([ "question_id" => $question->id,  "choice_id" => $questionAnswerId])->id,
                    'answerable_type' => ChoiceAnswer::class,
                ]);
            }
        }
    }
}
