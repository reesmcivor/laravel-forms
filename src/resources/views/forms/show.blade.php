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
                            {{ $question->name }}
                        </h3>
                        <p class="mt-3 text-base text-gray-500">
                            {!! $question->description !!}
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    </div>

@endsection
