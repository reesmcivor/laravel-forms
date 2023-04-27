<?php

namespace ReesMcIvor\Forms\Http\Controllers;

use Faker\Provider\Text;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravel\Nova\Fields\Date;
use ReesMcIvor\Forms\Models\Choice;
use ReesMcIvor\Forms\Models\ChoiceAnswer;
use ReesMcIvor\Forms\Models\DateAnswer;
use ReesMcIvor\Forms\Models\Form;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;
use ReesMcIvor\Forms\Models\QuestionAnswer;
use ReesMcIvor\Forms\Models\TextAnswer;
use ReesMcIvor\Forms\Models\VarcharAnswer;
use ReesMcIvor\Forms\Http\Requests\FormEntryRequest;

class FormEntryController extends Controller
{

    public function index()
    {
        //FormEntry::all()->each(fn($item) => $item->delete());
        //FormEntry::create(['form_id' => 1, 'user_id' => 1]);
        $formEntries = FormEntry::mine()->with('form')->has('form')->paginate(10);
        return view('forms::form-entry.index', [
            'formEntries' => $formEntries,
        ]);
    }

    public function create()
    {
        return view('forms::form-entry.create');
    }

    public function store(Request $request)
    {
        $form = Form::create($request->all());
        return redirect()->route('tenant.form-entry.index');
    }

    public function show(FormEntry $formEntry)
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


        return view('forms::form-entry.show', [
            'formEntry' => $formEntry,
        ]);
    }

    public function edit(Form $form)
    {
        return view('forms::form-entry.edit', [
            'form' => $form,
        ]);
    }

    public function update(Request $request, FormEntry $formEntry)
    {
        $formEntry->update($request->all());
        return redirect()->route('tenant.form-entry.index');
    }

    public function destroy(FormEntry $formEntry)
    {
        $formEntry->delete();
        return redirect()->route('tenant.form-entry.index');
    }

    public function submit(FormEntryRequest $request, FormEntry $formEntry)
    {

        foreach($request->get('question') as $questionId => $questionAnswerId)
        {
            $question = Question::find($questionId);
            QuestionAnswer::where('form_entry_id', $formEntry->id)->where('question_id', $questionId)->delete();

            if($question->type == "text") {
                TextAnswer::where('form_entry_id', $formEntry->id)->where('question_id', $questionId)->delete();
                $answerableId = TextAnswer::create(["form_entry_id" => $formEntry->id, "question_id" => $question->id, "answer" => $questionAnswerId])->id;
                QuestionAnswer::create([
                    'form_entry_id' => $formEntry->id,
                    'question_id' => $question->id,
                    'answerable_id' => $answerableId,
                    'answerable_type' => TextAnswer::class,
                ]);
            }

            if($question->type == "varchar") {
                VarcharAnswer::where('form_entry_id', $formEntry->id)->where('question_id', $questionId)->delete();
                $answerableId = VarcharAnswer::create(["form_entry_id" => $formEntry->id, "question_id" => $question->id, "answer" => $questionAnswerId])->id;
                QuestionAnswer::create([
                    'form_entry_id' => $formEntry->id,
                    'question_id' => $question->id,
                    'answerable_id' => $answerableId,
                    'answerable_type' => VarcharAnswer::class,
                ]);
            }

            if($question->type == "date") {
                DateAnswer::where('form_entry_id', $formEntry->id)->where('question_id', $questionId)->delete();
                QuestionAnswer::create([
                    'form_entry_id' => $formEntry->id,
                    'question_id' => $question->id,
                    'answerable_id' => DateAnswer::create([
                        "form_entry_id" => $formEntry->id,
                        "question_id" => $question->id,
                        "answer" => $questionAnswerId
                    ])->id,
                    'answerable_type' => DateAnswer::class,
                ]);
            }

            if($question->type == "select" && $questionAnswerId) {
                QuestionAnswer::create([
                    'form_entry_id' => $formEntry->id,
                    'question_id' => $question->id,
                    'answerable_id' => ChoiceAnswer::create([ "question_id" => $question->id,  "choice_id" => $questionAnswerId])->id,
                    'answerable_type' => ChoiceAnswer::class,
                ]);
            }
        }
        return redirect()->back()->with('success', sprintf('Your "%s" has been saved.', $formEntry->form->name));
    }
}
