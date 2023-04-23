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


        </div>
    </div>
    </div>

@endsection
