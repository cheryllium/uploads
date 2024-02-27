<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About Big Gay Uploads') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                
                <h2 class="text-lg font-medium text-gray-900">About</h2>

                <p class="mt-3">The purpose of this application is to provide Big Gay Rochester members a way to share images within the server without having to upload images to Discord or a public-facing image host. Only members of the server can upload or view uploaded images on this site. Members must log in with Discord to prove server membership.</p>
                
                <h2 class="text-lg font-medium text-gray-900 mt-3">Privacy</h2>
                
                <p class="mt-3">Images are only viewable by logged-in members of the server, and cannot be accessed by image URL or scraped by bots. Although this application provides some privacy guarantees, images should be treated as semi-public since the file encryption is server-side, and the server is notified of every upload.</p>

                <h2 class="text-lg font-medium text-gray-900 mt-3">Infrastructure</h2>

                <p class="mt-3">This is a Laravel application hosted on DigitalOcean with Laravel Forge. You can contact Cheshire if you have any questions or comments.</p>

            </div>
        </div>
    </div>
</x-app-layout>
