<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Forms\Models\AnswerTypes\VarcharAnswer;

class Answer extends Model
{

    public function saveAnswer(FormEntry $formEntry, Question $question, $answer)
    {
        $answerableId = $this->updateOrCreate([
            "form_entry_id" => $formEntry->id,
            "question_id" => $question->id
        ], ["answer" => $answer])->id;

        QuestionAnswer::create([
            'form_entry_id' => $formEntry->id,
            'question_id' => $question->id,
            'answerable_id' => $answerableId,
            'answerable_type' => get_class($this)
        ]);
    }

    public function questionAnswer()
    {
        return $this->morphOne(QuestionAnswer::class, 'answerable');
    }
}
