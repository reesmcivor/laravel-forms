<?php

namespace ReesMcIvor\Forms\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Group;

class Form extends Component
{
    public FormEntry $formEntry;

    public Collection $groups;


    public Group $currentGroup;
    public Group|null $previousGroup;
    public Group|null $nextGroup;
    public int $currentGroupIndex = 0;

    protected $listeners = [
        'navigateToGroup' => 'navigateToGroup',
    ];

    public function mount(FormEntry $formEntry = null)
    {
        $this->formEntry = $formEntry;
        $this->groups = $this->formEntry->form->steps;
        $this->navigateToGroup($this->currentGroupIndex);
    }

    public function navigateToGroup( $index = 0)
    {
        $this->submit();
        $this->previousGroup = $this->groups->get($index - 1);
        $this->currentGroup = Group::find($this->groups->get($index)->id)->with('children')->get()->first();
        $this->nextGroup = $this->groups->get($index + 1);
        $this->currentGroupIndex = $index;
    }

    public function submit()
    {
        $this->emit('validate');
    }

    public function render()
    {
        return view('forms::livewire.form');
    }
}
