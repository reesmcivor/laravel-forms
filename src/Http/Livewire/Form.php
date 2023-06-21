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

    public function mount(FormEntry $formEntry = null)
    {
        $this->formEntry = $formEntry;
        $this->groups = $this->formEntry->form->groups;
        $this->navigateToGroup($this->currentGroupIndex);
    }

    public function navigateToGroup( $index = 0)
    {
        $this->submit();
        $this->previousGroup = $this->groups->get($index - 1);
        $this->currentGroup = $this->groups->get($index);
        $this->nextGroup = $this->groups->get($index + 1);
        $this->currentGroupIndex = $index;
        // Refresh component with children
        $this->emit('$refresh');
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
