<div class="grid grid-cols-2">


    @foreach($group->questions as $question)
        <div class="{{ $question->type == "text" ? "col-span-2" : "" }} px-5 py-2">

            @if($question->description)
                <p class="text-sm text-gray-500">{!! $question->description !!}</p>
            @endif

            @if($question->type == 'varchar')

                <x-form-input
                    name="question.{{ $question->id }}"
                    label="{!! $question->show_label ? $question->label : '' !!}"
                    class="{{ config('form-components.components.form-input.classNames') }}"
                />

            @elseif($question->type == "text")

                <x-form-textarea
                    name="question.{{ $question->id }}" label="{{ $question->show_label ? $question->label : '' }}"
                    class="{{ config('form-components.components.form-textarea.classNames') }}"
                />
            @elseif($question->type == "date")

                <x-form-input type="date" name="question.{{ $question->id }}" label="{{ $question->show_label ? $question->label : '' }}" class="{{ config('form-components.components.form-input.classNames') }}" />

            @elseif($question->type == "select")

                <x-form-select
                    name="question.{{ $question->id }}"
                    label="{{ $question->label }}"
                    :options="$question->choices->mapWithKeys(fn($choice) => [$choice->id => $choice->choice])->toArray()"
                    class="{{ config('form-components.components.form-input.classNames') }}"
                />

            @elseif($question->type == "boolean")

                <x-form-checkbox
                    name="question.{{ $question->id }}"
                    label="{{ $question->label }}"
                    class="{{ config('form-components.components.form-checkbox.classNames') }}"
                />

            @endif
        </div>
    @endforeach
</div>
