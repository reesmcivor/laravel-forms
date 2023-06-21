<div>

    <div class="bg-white p-6">
        <div class="text-xl font-semibold text-gray-900">
            {{ $this->group?->name }}
        </div>
        <p class="mt-3 text-base text-gray-500">
            {{ $this?->group?->description }}
        </p>

        @foreach($this->group->questions as $question)

            @if($question->type == 'varchar')
                @livewire('forms.question.varchar', ['question' => $question, 'formEntry' => $formEntry])
            @elseif($question->type == 'text')
                @livewire('forms.question.text', ['question' => $question, 'formEntry' => $formEntry])
            @elseif($question->type == "date")
                @livewire('forms.question.date', ['question' => $question, 'formEntry' => $formEntry])
            @elseif($question->type == "select")
                @livewire('forms.question.select', ['question' => $question, 'formEntry' => $formEntry])
            @endif

        @endforeach

    </div>
</div>
