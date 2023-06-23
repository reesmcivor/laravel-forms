<div class="block mt-8 mb-20 rounded-lg shadow overflow-hidden bg-white">
    @livewire('forms.step', [
        'groups' => $groups,
        'currentGroupIndex' => $currentGroupIndex,
        'formEntry' => $formEntry,
    ], key($currentGroup->id)
    )
</div>
