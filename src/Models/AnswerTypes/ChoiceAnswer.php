<?php

namespace ReesMcIvor\Forms\Models\AnswerTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use ReesMcIvor\Forms\Database\Factories\ChoiceAnswerFactory;
use ReesMcIvor\Forms\Models\Answer;
use ReesMcIvor\Forms\Models\Choice;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;
use ReesMcIvor\Forms\Models\QuestionAnswer;

class ChoiceAnswer extends Answer
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return ChoiceAnswerFactory::new();
    }

    public function choice()
    {
        return $this->hasOne(Choice::class, 'id', 'choice_id');
    }

    public function saveAnswer(FormEntry $formEntry, Question $question, $answer)
    {
        QuestionAnswer::where([
            'form_entry_id' => $formEntry->id,
            'question_id' => $question->id
        ])->delete();

        QuestionAnswer::updateOrCreate([
            'form_entry_id' => $formEntry->id,
            'question_id' => $question->id
        ], [
            'answerable_id' => ChoiceAnswer::create([ "question_id" => $question->id,  "choice_id" => $answer])->id,
            'answerable_type' => ChoiceAnswer::class,
        ]);

    }

}
