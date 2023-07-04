<?php

namespace ReesMcIvor\Forms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use ReesMcIvor\Forms\Models\Form;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;
use ReesMcIvor\Forms\Models\QuestionAnswer;
use ReesMcIvor\Forms\Models\AnswerTypes\TextAnswer;
use ReesMcIvor\Forms\Models\AnswerTypes\VarcharAnswer;
use ReesMcIvor\Forms\Models\AnswerTypes\ChoiceAnswer;
use ReesMcIvor\Forms\Models\AnswerTypes\DateAnswer;

class FormEntryController extends Controller
{

    public function index()
    {
        //Artisan::call("accounts:create:form");
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

    public function show(Request $request, FormEntry $formEntry)
    {
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

    public function submit(Request $request, FormEntry $formEntry)
    {


        $formEntry = FormEntry::find($request->get('form_entry_id'));
        $validator = Validator::make( $request->all(), $formEntry->form->getValidationRules(), [], [
            'question.168' => 'SDFKHDSFJGSDF'
        ]);
        $errors = $validator->errors()->toArray();







        foreach($request->get('question') as $questionId => $questionAnswerId)
        {

            if(isset($errors['question.' . $questionId])) {
                continue;
            }

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

            if($question->type == "varchar" && $questionAnswerId) {
                try {
                    VarcharAnswer::where('form_entry_id', $formEntry->id)->where('question_id', $questionId)->delete();
                    $answerableId = VarcharAnswer::create(["form_entry_id" => $formEntry->id, "question_id" => $question->id, "answer" => $questionAnswerId])->id;
                    QuestionAnswer::create([
                        'form_entry_id' => $formEntry->id,
                        'question_id' => $question->id,
                        'answerable_id' => $answerableId,
                        'answerable_type' => VarcharAnswer::class,
                    ]);
                } catch (\Exception $e) {
                }
            }

            if($question->type == "date" && $questionAnswerId) {
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

        $request->validate($formEntry->form->getValidationRules());

        return redirect()->back()->withErrors($validator->errors())->withInput();
    }
}
