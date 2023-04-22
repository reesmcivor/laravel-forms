@extends('layouts.tenant', ['title' => 'Forms'])

@section('content')

    <div class="">
        <div class="max-w-7xl mx-auto">
            <x-button class="px-5" as="a" href="{{ route('tenant.posts.create') }}">New post</x-button>
            <div class="">

            </div>
        </div>
    </div>

@endsection
