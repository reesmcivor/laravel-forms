@extends('layouts.tenant', ['title' => 'Forms'])

@section('content')

    <div class="">
        <div class="max-w-7xl mx-auto">
            <x-button class="px-5" as="a" href="{{ route('tenant.forms.create') }}">New form</x-button>

                @foreach($forms as $form)
                    <div class="block mt-8 rounded-lg shadow overflow-hidden">
                        <div class="bg-white">
                            {{ $form->name }}
                            <a href="{{ route('tenant.forms.edit', $form) }}">Edit</a>
                        </div>
                    <div>
                @endforeach

                {{ $forms->links() }}
            </div>
        </div>
    </div>

@endsection
