<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }} | <span class="text-sm">uploaded by {{ $username }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <img src="data:image/png;base64, {{$encoded}}" class="mx-auto" />
                </div>
            </div>

            @if ($show_delete)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                    <div class="p-6 text-gray-900">
                        <form method="post" action="{{ route('image.delete', ['uuid' => $id]) }}">
                            <x-danger-button>Delete</x-danger-button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
