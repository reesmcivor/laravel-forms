<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use ReesMcIvor\Forms\Database\Factories\FormEntryFactory;
use function Aws\map;

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

        $fieldTypes = config('forms.field.types');
        foreach($questions as $questionId => $answer) {

            $question = Question::find($questionId);


            $fieldType = $fieldTypes[$question->type] ?? null;


            if (!is_array($answer)) {
                QuestionAnswer::where('form_entry_id', $formEntry->id)
                    ->where('question_id', $questionId)
                    ->delete();
            }

            if ($question->type == "varchar") {
                app($fieldType)->saveAnswer($formEntry, $question, $answer);
            } elseif($question->type == "select") {
                QuestionAnswer::where(['form_entry_id' => $formEntry->id, 'question_id' => $question->id ])->delete();
                QuestionAnswer::updateOrCreate([
                    'form_entry_id' => $formEntry->id,
                    'question_id' => $question->id
                ], [
                    'answerable_id' => ChoiceAnswer::create([ "question_id" => $question->id,  "choice_id" => $answer])->id,
                    'answerable_type' => ChoiceAnswer::class,
                ]);
            }

        }


    }
}
