<x-account-layout>

    <div class="">
        <div class="max-w-7xl mx-auto">


            @foreach($formEntries as $formEntry)
                @php $form = $formEntry->form; @endphp
                <div class="block mt-8 rounded-lg shadow overflow-hidden">
                    <div class="bg-white p-6">
                        <a href="{{ route('form-entry.show', $form->id) }}">
                            <h3 class="text-xl font-semibold text-gray-900">
                                {{ $form->name }}
                            </h3>
                            <p class="mt-3 text-base text-gray-500">
                                {!! $form->description !!}
                            </p>
                        </a>

                        <div class="actions flex space-x-2">
                            <div>
                                <a href="{{ route('form-entry.show', $formEntry->id) }}">
                                    <button type="submit">View</button>
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('form-entry.edit', $formEntry->id) }}">
                                    <button type="submit">Edit</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

                {{ $formEntries->links() }}
            </div>
        </div>
    </div>

</x-account-layout>
