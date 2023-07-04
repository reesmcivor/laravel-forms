<?php

namespace ReesMcIvor\Forms\Http\LiveWire\Question;

use ReesMcIvor\Forms\Http\Livewire\QuestionComponent;
use ReesMcIvor\Forms\Models\AnswerTypes\VarcharAnswer;

class VarChar extends QuestionComponent
{
    public string $answerableClass = VarcharAnswer::class;

    public function updatedAnswer()
    {
        $this->getRulesAndValidate();
        $this->saveAnswer();
        $this->emitUp('valueUpdated', $this->question->id, $this->answer);
    }

    public function render()
    {
        return view('forms::livewire.question.varchar');
    }
}
