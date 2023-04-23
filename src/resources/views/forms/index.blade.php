@extends('layouts.tenant', ['title' => 'Forms'])

@section('content')

    <div class="">
        <div class="max-w-7xl mx-auto">
            <x-button class="px-5" as="a" href="{{ route('tenant.forms.create') }}">New form</x-button>

                @foreach($forms as $form)
                <div class="block mt-8 rounded-lg shadow overflow-hidden">
                        <a href="{{ route('tenant.forms.show', $form->id) }}">
                        </a>
                    <div class="bg-white p-6"><a href="https://test.tenancy.ddev.site/posts/1">
                            <h3 class="text-xl font-semibold text-gray-900">
                                {{ $form->name }}
                            </h3>
                            <p class="mt-3 text-base text-gray-500">
                                {!! $form->description !!}
                            </p>
                        </a>
                        <div class="mt-6 flex items-center"><a href="https://test.tenancy.ddev.site/posts/1">
                            </a><div class=""><a href="https://test.tenancy.ddev.site/posts/1">
                                </a><a href="#">
                                    <img class="h-10 w-10 rounded-full" src="https://www.gravatar.com/avatar/8b81580c7c43a7cf38f11f2659690e7c" alt="Test">
                                </a>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    <a href="#" class="">
                                        Test
                                    </a>
                                </p>
                                <div class="flex text-sm text-gray-500">
                                    <time datetime="2023-04-22">
                                        Apr 22, 2023
                                    </time>
                                    <span class="mx-1">
                    ·
                  </span>
                                    <span>
                    22 words
                  </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

                {{ $forms->links() }}
            </div>
        </div>
    </div>

@endsection
