<?php

namespace ReesMcIvor\Forms\Http\Livewire\Question;

use ReesMcIvor\Forms\Http\Livewire\QuestionComponent;
use ReesMcIvor\Forms\Models\ChoiceAnswer;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;
use ReesMcIvor\Forms\Models\QuestionAnswer;

class Select extends QuestionComponent
{

    protected $answerClass = ChoiceAnswer::class;

    public function mount(Question $question, FormEntry $formEntry = null)
    {
        parent::mount($question, $formEntry);
        $this->answer = $question?->questionAnswers?->first()?->answerable?->choice?->id;
    }

    public function updatedAnswer()
    {
        $this->getRulesAndValidate();
        QuestionAnswer::where(['form_entry_id' => $this->formEntry->id, 'question_id' => $this->question->id ])->delete();
        QuestionAnswer::updateOrCreate([
            'form_entry_id' => $this->formEntry->id,
            'question_id' => $this->question->id
        ], [
            'answerable_id' => ChoiceAnswer::create([ "question_id" => $this->question->id,  "choice_id" => $this->answer])->id,
            'answerable_type' => ChoiceAnswer::class,
        ]);
        $this->emitUp('valueUpdated', $this->question->id, $this->answer);
    }

    public function render()
    {
        return view('forms::livewire.question.select');
    }
}
