<div>
    <div class="mb-2">
        <h4 class="font-semibold text-gray-900">{{ $this->question->label }}</h4>
        <p class="text-sm">{!! $this->question->description !!}</p>
    </div>

    <div class="flex flex-row">
        <input
            wire:model.debounce.500ms="answer"
            type="date"
            name="question[{{ $this->question->id }}]"
            class="shadow appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror"
        />
    </div>

    @error('answer')
        <div class="text-red-800">{!! implode('', $errors->get('answer')) !!}</div>
    @enderror

</div>
