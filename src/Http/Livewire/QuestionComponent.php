<?php

namespace ReesMcIvor\Forms\Http\Livewire;

use Livewire\Component;
use ReesMcIvor\Forms\Models\DateAnswer;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;
use ReesMcIvor\Forms\Models\QuestionAnswer;

class QuestionComponent extends Component
{
    public $question;
    public $formEntry;
    public $answer = '';

    protected $listeners = ['validate' => 'getRulesAndValidate'];

    public function mount(Question $question, FormEntry $formEntry = null)
    {
        $this->question = $question;
        $this->formEntry = $formEntry;
        $this->answer = $this->question?->questionAnswers?->first()?->answerable?->answer;
    }

    public function getRules()
    {
        return [
            'answer' => array_values($this->question->getValidationRules())[0]
        ];
    }

    protected function validationAttributes()
    {
        return [
            'answer' => $this->question->label
        ];
    }

    public function getRulesAndValidate()
    {
        $this->validateOnly('answer', ['answer' => implode('|', $this->getRules())]);
    }

    protected function saveAnswer()
    {
        $answerableId = $this->answerClass::updateOrCreate([
            "form_entry_id" => $this->formEntry->id,
            "question_id" => $this->question->id,
        ], [ "answer" => $this->answer ])->id;

        QuestionAnswer::create([
            'form_entry_id' => $this->formEntry->id,
            'question_id' => $this->question->id,
            'answerable_id' => $answerableId,
            'answerable_type' => $this->answerClass,
        ]);
    }

}
