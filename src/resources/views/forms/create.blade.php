@extends('layouts.tenant', ['title' => __('New form')])

@section('content')

    <form method="POST" action="{{ route('tenant.forms.store') }}">
        @csrf
        <div>
            <div>
                <div class="grid grid-cols-1 sm:grid-cols-6 gap-6">
                    <div class="sm:col-span-3">
                        <x-form.label for="name" value="Name"/>

                        <div class="mt-1 flex rounded-md shadow-sm">
                            <x-form.input id="name" name="name" type="text" value="{{ old('name') }}" />
                        </div>

                        <x-form.input-error for="name" />
                    </div>

                    <div class="sm:col-span-6">
                        <x-form.label for="description" value="Description"/>
                        <div class="mt-1 rounded-md shadow-sm">
                            <textarea id="description" name="description" rows="5" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-400 rounded-md shadow-sm mt-1 block w-full @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        </div>
                        <x-form.input-error for="description" />
                    </div>

                </div>
            </div>

        </div>
        <div class="mt-8 border-t border-gray-200 pt-5">
            <div class="flex justify-end">
            <span class="inline-flex rounded-md shadow-sm">
                <x-button variant="secondary" as="a" href="{{ route('tenant.posts.index') }}">Cancel</x-button>
            </span>
                <span class="ml-3 inline-flex rounded-md shadow-sm">
                <x-button type="submit">Save</x-button>
            </span>
            </div>
        </div>
    </form>

@endsection

