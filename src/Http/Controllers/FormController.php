<?php

namespace ReesMcIvor\Forms\Http\Controllers;

use Faker\Provider\Text;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use ReesMcIvor\Forms\Models\Choice;
use ReesMcIvor\Forms\Models\ChoiceAnswer;
use ReesMcIvor\Forms\Models\Form;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;
use ReesMcIvor\Forms\Models\QuestionAnswer;
use ReesMcIvor\Forms\Models\TextAnswer;

class FormController extends Controller
{
    public function index()
    {
        //FormEntry::all()->each(fn($item) => $item->delete());
        //FormEntry::create(['form_id' => 1, 'user_id' => 1]);
        $formEntries = FormEntry::mine()->with('form')->has('form')->paginate(10);
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

    public function submit(FormEntry $formEntry, Request $request)
    {
        foreach($request->get('question') as $questionId => $questionAnswerId)
        {
            $question = Question::find($questionId);

            if($question->type == "text") {

                TextAnswer::where('form_entry_id', $formEntry->id)->where('question_id', $questionId)->delete();

                QuestionAnswer
                    ::where('form_entry_id', $formEntry->id)
                    ->where('question_id', $questionId)
                    ->delete();

                QuestionAnswer::create([
                    'form_entry_id' => $formEntry->id,
                    'question_id' => $question->id,
                    'answerable_id' => TextAnswer::create([
                        "form_entry_id" => $formEntry->id,
                        "question_id" => $question->id,
                        "answer" => $questionAnswerId
                    ])->id,
                    'answerable_type' => TextAnswer::class,
                ]);
            }

            if($question->type == "select" && $questionAnswerId) {

                QuestionAnswer
                    ::where('form_entry_id', $formEntry->id)
                    ->where('question_id', $questionId)
                    ->delete();

                QuestionAnswer::create([
                    'form_entry_id' => $formEntry->id,
                    'question_id' => $question->id,
                    'answerable_id' => ChoiceAnswer::create([ "question_id" => $question->id,  "choice_id" => $questionAnswerId])->id,
                    'answerable_type' => ChoiceAnswer::class,
                ]);
            }
        }
        return redirect()->back();
    }
}
