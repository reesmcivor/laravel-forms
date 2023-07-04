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

    public function isComplete()
    {
        return $this->completed_at != null;
    }

    public function complete()
    {
        $this->setAttribute('completed_at', now())->save();
    }

    public function saveAnswers( FormEntry $formEntry, $questions = [])
    {

        $fieldTypes = config('forms.field.types');
        foreach($questions as $questionId => $answer) {

            $question = Question::find($questionId);
            $fieldType = $fieldTypes[$question->type] ?? null;

            if (!is_array($answer)) {
                QuestionAnswer::where('form_entry_id', $formEntry->id)->where('question_id', $questionId)->delete();
            }

            app($fieldType)->saveAnswer($formEntry, $question, $answer);

        }
    }

    public function populate( $values )
    {
        $fieldTypes = config('forms.field.types');
        $groupsByForm = $this->form->groups->pluck('id', 'id')->toArray();
        $questions = QuestionGroup::where('group_id', $groupsByForm)->get()->pluck('question_id', 'question_id')->toArray();
        Question::whereIn('id', $questions)->get()->each(function($question) use ($values, $fieldTypes) {
            if(isset($values[$question->slug])) {
                $fieldType = $fieldTypes[$question->type] ?? null;
                if($question->slug == "trading_address") {
                    //dd()
                    //dd($fieldType);
                    //dd($values[$question->slug]);
                } else {
                    app($fieldType)->saveAnswer($this, $question, $values[$question->slug]);
                }
            }
        });
    }
}

