@extends('layouts.tenant', ['title' => $form->name])

@section('content')

    <div class="">
        <div class="max-w-7xl mx-auto">

            <h1 class="text-2xl font-semibold text-gray-900">
                {{ $form->name }}
            </h1>

            <div class="mt-3 text-base text-gray-500">
                {!! $form->description !!}
            </div>


            <form method="POST" action="{{ route('tenant.forms.submit', $form->id) }}">
                @csrf
                @foreach($form->questions as $question)
                    <div class="block mt-8 rounded-lg shadow overflow-hidden">
                        <div class="bg-white p-6">
                            <h3 class="text-xl font-semibold text-gray-900">
                                {{ $question->question }}
                            </h3>
                            <p class="mt-3 text-base text-gray-500">

                                @livewire('reesmcivor-forms::question.text');

                                @if($question->type == 'text')
                                    @foreach($question?->questionAnswers as $questionAnswer)
                                        <input name="question[{{ $question->id }}]" value="{{ $questionAnswer?->answerable?->answer }}" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-400 rounded-md shadow-sm mt-1 block w-full @error('description') border-red-500 @enderror">
                                    @endforeach
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

                <div class="actions flex space-x-2">
                    <div class="p-10">
                        <x-button type="submit">Submit</x-button>
                    </div>
                </div>

            </form>

        </div>
    </div>
    </div>

@endsection
