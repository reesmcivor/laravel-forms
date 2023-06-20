<?php

namespace ReesMcIvor\Forms\Http\LiveWire\Question;

use ReesMcIvor\Forms\Http\Livewire\QuestionComponent;
use ReesMcIvor\Forms\Models\VarcharAnswer;

class VarChar extends QuestionComponent
{
    protected $answerClass = VarcharAnswer::class;

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
