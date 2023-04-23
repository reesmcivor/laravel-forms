@extends('layouts.tenant', ['title' => 'Forms'])

@section('content')

    <div class="">
        <div class="max-w-7xl mx-auto">
            <x-button class="px-5" as="a" href="{{ route('tenant.forms.create') }}">New form</x-button>


        </div>
    </div>
    </div>

@endsection
