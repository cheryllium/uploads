<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Image') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('image.upload.process') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div>
                            <x-input-label for="title" :value="__('Image Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Because images are encrypted on disk, it is not possible to display thumbnails in your dashboard. Please give your image a descriptive title so you will know what it is.") }}
                            </p>
                        </div>

                        <div class="mt-3">
                            <x-input-label for="image" :value="__('Upload File')" />
                            <input type="file" name="image" id="image" required />
                        </div>

                        <x-input-error class="mt-3" :messages="$errors->get('image')" />
                        
                        <x-primary-button type="submit" class="mt-3">Upload</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
