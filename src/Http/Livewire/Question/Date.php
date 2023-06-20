<?php

namespace ReesMcIvor\Forms\Http\Livewire\Question;

use ReesMcIvor\Forms\Http\Livewire\QuestionComponent;
use ReesMcIvor\Forms\Models\DateAnswer;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;
use ReesMcIvor\Forms\Models\QuestionAnswer;
use ReesMcIvor\Forms\Models\TextAnswer;
use ReesMcIvor\Forms\Models\VarcharAnswer;

class Date extends QuestionComponent
{

    protected $answerClass = DateAnswer::class;

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
