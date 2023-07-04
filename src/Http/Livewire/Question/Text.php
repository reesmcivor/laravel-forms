<?php

namespace ReesMcIvor\Forms\Http\Livewire\Question;

use ReesMcIvor\Forms\Http\Livewire\QuestionComponent;
use ReesMcIvor\Forms\Models\AnswerTypes\TextAnswer;

class Text extends QuestionComponent
{
    public string $answerableClass = TextAnswer::class;

    public function updatedAnswer()
    {
        $this->getRulesAndValidate();
        $this->saveAnswer();
        $this->emitUp('valueUpdated', $this->question->id, $this->answer);
    }

    public function render()
    {
        return view('forms::livewire.question.text');
    }
}
