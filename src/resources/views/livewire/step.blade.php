<div>

    <div class="bg-white p-6">

        <div class="text-xl font-semibold text-gray-900">
            {{ $this->group?->name }}
        </div>
        <p class="mt-3 text-base text-gray-500">
            {{ $this?->group?->description }}
        </p>

        <x-form wire:submit.prevent="submit">
            @wire

                @include('forms::livewire.fields')

                @foreach($this->group?->children as $childGroup)
                    <div class="m-5 border bg-gray-200 p-4">

                        {{ $childGroup->name }}
                        @include('forms::livewire.fields', ['group' => $childGroup])
                    </div>
                @endforeach

            @endwire

            <div class="flex justify-center py-10">
                @if($this?->previousGroup ?? false)
                    <div class="flex">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-auto"
                            wire:click="navigateToGroup({{ $this->currentGroupIndex - 1 }})"
                        >
                            Go To {{ $this->previousGroup->name }}
                        </button>
                    </div>
                @endif


                @if($this?->nextGroup ?? false)
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-auto"
                        wire:click="navigateToGroup({{ $this->currentGroupIndex + 1 }})"
                    >
                        Go To Next Step
                    </button>
                @else
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-auto"
                        wire:click="submit(true)"
                    >
                        Submit
                    </button>
                @endif
            </div>

        </x-form>

    </div>
</div>
