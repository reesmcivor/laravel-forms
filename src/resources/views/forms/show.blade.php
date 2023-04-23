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


            @foreach($form->questions as $question)
                <div class="block mt-8 rounded-lg shadow overflow-hidden">
                    <div class="bg-white p-6">
                        <h3 class="text-xl font-semibold text-gray-900">
                            {{ $question->question }}
                        </h3>
                        <p class="mt-3 text-base text-gray-500">


                            @if($question->type == 'text')
                                <input type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-400 rounded-md shadow-sm mt-1 block w-full @error('description') border-red-500 @enderror">
                            @endif

                            @if($question->type == "select")
                                <select name="" id="" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-400 rounded-md shadow-sm mt-1 block w-full @error('description') border-red-500 @enderror">
                                    @foreach($question->choices as $option)
                                        <option value="{{ $option->id }}">{{ $option->choice }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    </div>

@endsection
