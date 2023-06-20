

<div class="">
    <div class="max-w-7xl mx-auto">

        <pre>
            <?php print_r($formEntry->toArray()); ?>
        </pre>

        <h1 class="text-2xl font-semibold text-gray-900">
            {{ $formEntry->form->name }}
        </h1>

        <div class="mt-3 text-base text-gray-500">
            {!! $formEntry->form->description !!}
        </div>

        @if($errors->any())
            {!! implode('', $errors->all('<div>:message</div>')) !!}
        @endif


        <form method="POST" action="{{ route('form-entry.submit', $formEntry->id) }}">

            <input type="hidden" name="form_entry_id" value="{{ $formEntry->id }}" />

            @csrf
            @foreach($formEntry->form->questions as $question)
                <div class="block mt-8 rounded-lg shadow overflow-hidden">
                    <div class="bg-white p-6">
                        <h3 class="text-xl font-semibold text-gray-900">
                            {{ $question->question }}
                        </h3>
                        <p class="mt-3 text-base text-gray-500">

                            @if($question->type == 'varchar')
                                <input name="question[{{ $question->id }}]" value="{{ old("question." . $question->id) ?? $question?->questionAnswers?->first()?->answerable?->answer }}" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-400 rounded-md shadow-sm mt-1 block w-full @error('question.' . $question->id) border-red-500 @enderror">
                            @endif

                            @if($question->type == 'text')
                                <textarea name="question[{{ $question->id }}]" value="{{ old("question." . $question->id) ?? $question?->questionAnswers?->first()?->answerable?->answer }}" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-400 rounded-md shadow-sm mt-1 block w-full @error('description') border-red-500 @enderror">{{ old("question." . $question->id) ?? $question?->questionAnswers?->first()?->answerable?->answer }}</textarea>
                            @endif

                            @if($question->type == 'date')
                                {{ $question?->questionAnswers?->first()?->answerable?->answer->format('d/m/Y') }}
                                <input type="date" name="question[{{ $question->id }}]" value="{{ old("question." . $question->id) ?? $question?->questionAnswers?->first()?->answerable?->answer->format('Y-m-d') }}" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-400 rounded-md shadow-sm mt-1 block w-full @error('description') border-red-500 @enderror">
                        @endif

                        @if($errors->has('question.' . $question->id))
                            <div class="text-red-800">{!! implode('', $errors->get('question.' . $question->id)) !!}</div>
                        @endif

                        @if($question->type == "select")

                                <?php

                                $answers = $question->questionAnswers->map(function($answer) {
                                    return $answer?->answerable?->choice?->choice;
                                })->toArray();

                                print_r($answers);
                                ?>

                            <select name="question[{{ $question->id }}]" id="" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-400 rounded-md shadow-sm mt-1 block w-full @error('description') border-red-500 @enderror">
                                <option value="">Please select option</option>
                                @foreach($question->choices as $option)
                                    <option value="{{ $option->id }}">{{ $option->choice }}</option>
                                @endforeach
                            </select>
                            @endif
                            </p>
                    </div>
                </div>
            @endforeach

            <div class="block mt-8 overflow-hidden">
                <div class="actions flex">
                    <div class="p-10">
                        <input type="submit" name="submit" value="Save" />
                    </div>
                </div>
            </div>

        </form>

    </div>
</div>
