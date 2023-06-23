<x-account-layout>
    <div class="">
        <div class="max-w-7xl mx-auto py-10">

            <h1 class="text-2xl font-semibold text-gray-900">
                {{ $formEntry->form->name }}
            </h1>


            <div class="mt-3 text-base text-gray-500">
                Thank you for your submission.
            </div>

            {{ $formEntry }}


        </div>
    </div>
</x-account-layout>
