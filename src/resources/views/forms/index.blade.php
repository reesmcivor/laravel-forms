@extends('layouts.tenant', ['title' => 'Forms'])

@section('content')

    <div class="">
        <div class="max-w-7xl mx-auto">
            <x-button class="px-5" as="a" href="{{ route('tenant.posts.create') }}">New form</x-button>
            <div class="">
                @foreach($forms as $form)

                    {{ $form->name }}
                    <a href="{{ route('tenant.forms.edit', $form) }}">Edit</a>
                    <a href="{{ route('tenant.forms.destroy', $form) }}">Delete</a>
                @endforeach

                {{ $ }}
            </div>
        </div>
    </div>

@endsection
