@extends('layouts.tenant', ['title' => 'Forms'])

@section('content')

    <div class="">
        <div class="max-w-7xl mx-auto">
            <x-button class="px-5" as="a" href="{{ route('tenant.forms.create') }}">New form</x-button>

                @foreach($forms as $form)
                <div class="block mt-8 rounded-lg shadow overflow-hidden">
                    <div class="bg-white p-6">
                        <a href="{{ route('tenant.forms.show', $form->id) }}">
                            <h3 class="text-xl font-semibold text-gray-900">
                                {{ $form->name }}
                            </h3>
                            <p class="mt-3 text-base text-gray-500">
                                {!! $form->description !!}
                            </p>
                        </a>
                        <form method="POST" action="{{ route('tenant.forms.destroy', $form->id) }}">
                            @csrf
                            @method('DELETE')
                            <x-button class="px-5" as="button" type="submit">{{ route('tenant.forms.create') }}">New form</x-button>
                        </form>
                    </div>
                </div>

                @endforeach

                {{ $forms->links() }}
            </div>
        </div>
    </div>

@endsection
