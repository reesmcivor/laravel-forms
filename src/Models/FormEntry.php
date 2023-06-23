<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Forms\Database\Factories\FormEntryFactory;

class FormEntry extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return FormEntryFactory::new();
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function scopeMine($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function questionAnswers()
    {
        return $this->hasMany(QuestionAnswer::class);
    }

    public function saveAnswers( FormEntry $formEntry, $questions = [])
    {


        foreach($questions as $questionId => $answer) {

            $question = Question::find($questionId);

            if (!is_array($answer)) {
                QuestionAnswer::where('form_entry_id', $formEntry->id)
                    ->where('question_id', $questionId)
                    ->delete();
            }

            if ($question->type == "varchar") {

                $answerableId = VarcharAnswer::updateOrCreate([
                    "form_entry_id" => $formEntry->id,
                    "question_id" => $questionId
                ], ["answer" => $answer])->id;

                QuestionAnswer::create([
                    'form_entry_id' => $formEntry->id,
                    'question_id' => $questionId,
                    'answerable_id' => $answerableId,
                    'answerable_type' => VarcharAnswer::class,
                ]);
            } elseif ($question->type == "date") {
                    $answerableId = VarcharAnswer::updateOrCreate([
                        "form_entry_id" => $formEntry->id,
                        "question_id" => $questionId
                    ], ["answer" => $answer])->id;

                    QuestionAnswer::create([
                        'form_entry_id' => $formEntry->id,
                        'question_id' => $questionId,
                        'answerable_id' => $answerableId,
                        'answerable_type' => VarcharAnswer::class,
                    ]);
            } elseif($question->type == "text") {
                $answerableId = TextAnswer::updateOrCreate([
                    "form_entry_id" => $formEntry->id,
                    "question_id" => $questionId
                ], ["answer" => $answer])->id;

                QuestionAnswer::create([
                    'form_entry_id' => $formEntry->id,
                    'question_id' => $questionId,
                    'answerable_id' => $answerableId,
                    'answerable_type' => TextAnswer::class,
                ]);
            } elseif($question->type == "select") {
                QuestionAnswer::where(['form_entry_id' => $formEntry->id, 'question_id' => $question->id ])->delete();
                QuestionAnswer::updateOrCreate([
                    'form_entry_id' => $formEntry->id,
                    'question_id' => $question->id
                ], [
                    'answerable_id' => ChoiceAnswer::create([ "question_id" => $question->id,  "choice_id" => $answer])->id,
                    'answerable_type' => ChoiceAnswer::class,
                ]);
            } elseif($question->type == "boolean") {
                $answerableId = BooleanAnswer::updateOrCreate([
                    "form_entry_id" => $formEntry->id,
                    "question_id" => $questionId
                ], ["answer" => $answer])->id;

                QuestionAnswer::updateOrCreate([
                    'form_entry_id' => $formEntry->id,
                    'question_id' => $question->id
                ], [
                    'answerable_id' => $answerableId,
                    'answerable_type' => BooleanAnswer::class,
                ]);
            }
        }


    }
}
