<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="font-semibold text-lg">Your Uploads</h1>

                    @if (!count($uploads))
                        <div>You have no uploads yet.</div>

                        <p class="mt-3">
                            <a href="{{ route('image.upload') }}">
                                <x-secondary-button>Upload an Image</x-secondary-button>
                            </a>
                        </p>
                    @else

                        <p>You are using <b>{{ number_format($totalSize, 2, '.', ',') }} MiB</b> out of <b>{{ $sizeLimit }} MiB</b> allowed.</p>

                        <p class="mt-3">
                            <a href="{{ route('image.upload') }}">
                                <x-secondary-button>Upload an Image</x-secondary-button>
                            </a>
                        </p>

                        <hr class="my-3" />

                        <div class="mt-3">
                        @foreach($uploads as $upload)
                            <div>
                                <a href="{{ route('image.view', ['uuid' => $upload->id ]) }}">{{ $upload->title }}</a>
                            </div>
                        @endforeach
                        </div>
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
