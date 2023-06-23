<?php

namespace ReesMcIvor\Forms\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Group;
use ReesMcIvor\Forms\Models\Question;
use ReesMcIvor\Forms\Models\QuestionAnswer;

class Step extends Component
{
    public array $question = [];

    public Collection $groups;

    public FormEntry $formEntry;
    public Group $group;
    public Group|null $previousGroup;
    public Group|null $nextGroup;
    public int $currentGroupIndex = 0;

    public array $rules = ['question.*' => 'sometimes'];

    public function mount(FormEntry $formEntry, Collection $groups)
    {
        $this->formEntry = $formEntry;
        $this->groups = $groups;
        $this->group = $groups->get($this->currentGroupIndex);
        $this->previousGroup = $groups->get($this->currentGroupIndex - 1);
        $this->nextGroup = $groups->get($this->currentGroupIndex + 1);
        $this->question = $this->getRecursiveQuestionAnswers( $this->group );
        $this->rules = $this->getRulesFromQuestions( $this->group );
    }

    public function getRulesFromQuestions( Group $group, &$rules = [] )
    {
        foreach($group->questions as $question) {
            $rules += $question->getValidationRules();
        }
        if($group->children->count()) {
            foreach($group->children as $childGroup) {
                $rules += $this->getRulesFromQuestions($childGroup, $rules);
            }
        }
        return $rules;
    }

    public function getAttributeNameFromQuestions(Group $group, &$attributes = [])
    {
        foreach($group->questions as $question) {
            $attributes['question.' . $question->id] = $question->label;
        }
        if($group->children->count()) {
            foreach($group->children as $childGroup) {
                $childAttributes = $this->getAttributeNameFromQuestions($childGroup, $rules);
                if($childAttributes) {
                    $attributes += $childAttributes;
                }
            }
        }
        return $attributes;
    }

    public function getValidationAttributes()
    {
        return $this->getAttributeNameFromQuestions($this->group);
    }

    public function submit( $closeForm = false )
    {
        $this->formEntry->saveAnswers($this->formEntry, $this->question);
        if($this->rules) {
            $this->validate($this->rules ?? []);
        }
        if($closeForm) {
            response()->redirectTo(route('form-entry.thank-you', $this->formEntry->id))
                ->with('success', 'Form submitted successfully');
        }
    }


    public function updated($field, $value)
    {
        $fieldRules = [$field => $this->rules[$field] ?? ['sometimes']];
        $this->validateOnly($field, $fieldRules);

        $this->formEntry->saveAnswers($this->formEntry, $this->question);
    }

    public function render()
    {
        return view('forms::livewire.step', [
            'group' => $this->group
        ]);
    }

    public function navigateToGroup( $index = 0)
    {

        if ($index > $this->currentGroupIndex) {
            $this->submit();
        }

        $this->previousGroup = $this->groups->get($index - 1);
        $this->currentGroup = $this->groups->get($index);
        $this->nextGroup = $this->groups->get($index + 1);
        $this->currentGroupIndex = $index;
        $this->group = $this->groups->get($this->currentGroupIndex);
        $this->rules = $this->getRulesFromQuestions( $this->group );
        $this->question = $this->getRecursiveQuestionAnswers($this->group);

    }

    protected function getRecursiveQuestionAnswers( Group $group, &$answers = [] ) {

        $answers += $this->getQuestionAnswers($group->questions)->toArray();

        if($group->children->count()) {
            foreach($group->children as $childGroup) {
                $answers += $this->getRecursiveQuestionAnswers($childGroup, $answers);
            }
        }
        return $answers;
    }

    protected function getQuestionAnswers( Collection $questions ) : Collection
    {
        return $questions->mapWithKeys(function(Question $question) {
            switch($question->type) {
                case "select":
                    $answer = QuestionAnswer::where('form_entry_id', $this->formEntry->id)->where('question_id', $question->id)->first();
                    return [$question->id => $answer?->answerable?->choice?->id];
                default:
                    $answer = QuestionAnswer::where('form_entry_id', $this->formEntry->id)->where('question_id', $question->id)->first();
                    return [$question->id => $answer?->answerable?->answer];
            }
        })->reject(function($answer) {
            return $answer == null;
        });
    }
}
