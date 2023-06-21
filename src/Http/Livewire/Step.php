<?php

namespace ReesMcIvor\Forms\Http\Livewire;

use Livewire\Component;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Group;

class Step extends Component
{
    public FormEntry $formEntry;

    public Group $group;

    public function mount(FormEntry $formEntry, Group $group)
    {
        $this->formEntry = $formEntry;
        $this->group = $group;
    }

    public function render()
    {
        return view('forms::livewire.step', [
            'group' => $this->group
        ]);
    }
}
