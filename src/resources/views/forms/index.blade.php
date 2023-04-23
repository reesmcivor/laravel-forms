@extends('layouts.tenant', ['title' => 'Forms'])

@section('content')

    <div class="">
        <div class="max-w-7xl mx-auto">
            <x-button class="px-5" as="a" href="{{ route('tenant.forms.create') }}">New form</x-button>
            <div class="bg-white my-10">
                @foreach($forms as $form)
                    {{ $form->name }}
                    <a href="{{ route('tenant.forms.edit', $form) }}">Edit</a>
                @endforeach

                {{ $forms->links() }}
            </div>
        </div>
    </div>

@endsection
