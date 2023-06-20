<x-account-layout>
    <div class="">
        <div class="max-w-7xl mx-auto py-10">


            <h1 class="text-2xl font-semibold text-gray-900">
                {{ $formEntry->form->name }}
            </h1>

            <div class="mt-3 text-base text-gray-500">
                {!! $formEntry->form->description !!}
            </div>

            @if($errors->any())
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            @endif

            <?php /*@livewire("forms.form", ['formEntry' => $formEntry])*/ ?>
            @livewire('forms.form', ['formEntry' => $formEntry])



            <form method="POST" action="{{ route('form-entry.submit', $formEntry->id) }}">

                <input type="hidden" name="form_entry_id" value="{{ $formEntry->id }}" />

                @csrf

            </form>

        </div>
    </div>
</x-account-layout>
