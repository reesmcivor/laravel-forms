<div class="block mt-8 mb-20 rounded-lg shadow overflow-hidden bg-white">

    @livewire('forms.step', ['group' => $currentGroup, 'formEntry' => $formEntry], key($currentGroup->id))

    <div class="grid grid-flow-row-dense grid-cols-2">
        @foreach($this->currentGroup->questions as $question)
            <div class="col {{ $question->type == "text" ? "col-span-2 h-96" : "" }}">
                <div class="">
                    <div class="bg-white p-6">




                        <?php
                        /*
                        @if($question->type == 'varchar')
                            @livewire('forms.question.varchar', ['question' => $question, 'formEntry' => $formEntry])
                        @elseif($question->type == 'text')
                            @livewire('forms.question.text', ['question' => $question, 'formEntry' => $formEntry])
                        @elseif($question->type == "date")
                            @livewire('forms.question.date', ['question' => $question, 'formEntry' => $formEntry])
                        @elseif($question->type == "select")
                            @livewire('forms.question.select', ['question' => $question, 'formEntry' => $formEntry])
                        @endif
                        */
                        ?>

                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <div class="flex justify-center py-10">
    @if($this->previousGroup)
        <div class="flex">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-auto"
                wire:click="navigateToGroup({{ $this->currentGroupIndex - 1 }})"
            >
                Go To {{ $this->previousGroup->name }}
            </button>
        </div>
    @endif


    @if($this->nextGroup)
        <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-auto"
            wire:click="navigateToGroup({{ $this->currentGroupIndex + 1 }})"
        >
            Go To {{ $this->nextGroup->name }}
        </button>
    @endif
    </div>
</div>
