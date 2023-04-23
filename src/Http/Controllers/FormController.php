<?php

namespace ReesMcIvor\Forms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use ReesMcIvor\Forms\Models\Choice;
use ReesMcIvor\Forms\Models\Form;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::paginate(10);
        return view('forms::forms.index', [
            'forms' => $forms,
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

    public function submit(Form $form)
    {
        $formEntry = FormEntry::firstOrCreate([
            'user_id' => auth()->user()->id,
            'form_id' => $form->id,
        ]);



    }
}
