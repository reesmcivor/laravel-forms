<?php

namespace ReesMcIvor\Forms\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use ReesMcIvor\Forms\Events\FormEntryComplete;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Group;
use ReesMcIvor\Forms\Models\Question;
use ReesMcIvor\Forms\Models\QuestionAnswer;
use ReesMcIvor\Forms\Service\FormService;

class Step extends Component
{
    public array $question = [];

    public Collection $groups;

    public FormEntry $formEntry;
    public Group $group;
    public Group|null $previousGroup;
    public Group|null $nextGroup;
    public int $currentGroupIndex = 0;

    protected FormService $formService;

    public array $rules = ['question.*' => 'sometimes'];

    public function __construct($id = null)
    {
        $this->formService = (new FormService);
        parent::__construct($id);
    }

    public function mount(FormEntry $formEntry, Collection $groups)
    {
        $this->formEntry = $formEntry;
        $this->groups = $groups;
        $this->group = $groups->get($this->currentGroupIndex);
        $this->previousGroup = $groups->get($this->currentGroupIndex - 1);
        $this->nextGroup = $groups->get($this->currentGroupIndex + 1);
        $this->question = $this->formService->getRecursiveQuestionAnswers($formEntry, $this->group );
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
            $this->formEntry->complete();
            event(new FormEntryComplete($this->formEntry));
            response()->redirectTo(route('form-entry.thank-you', $this->formEntry->id));
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
        $this->formService->getRecursiveQuestionAnswers($this->formEntry, $this->group );

    }
}
