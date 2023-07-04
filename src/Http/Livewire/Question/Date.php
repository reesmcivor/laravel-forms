<?php

namespace ReesMcIvor\Forms\Http\Livewire\Question;

use ReesMcIvor\Forms\Http\Livewire\QuestionComponent;
use ReesMcIvor\Forms\Models\AnswerTypes\DateAnswer;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;

class Date extends QuestionComponent
{
    public $answerClass = DateAnswer::class;

    public function mount(Question $question, FormEntry $formEntry = null)
    {
        parent::mount($question, $formEntry);
        $this->answer = $question?->questionAnswers?->first()?->answerable?->answer?->format('Y-m-d');
    }

    public function updatedAnswer()
    {
        $this->getRulesAndValidate();
        $this->saveAnswer();
        $this->emitUp('valueUpdated', $this->question->id, $this->answer);
    }

    public function render()
    {
        return view('forms::livewire.question.date');
    }
}
