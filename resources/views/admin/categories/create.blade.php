<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <button type="button" onclick="window.history.back()" class="px-3 py-1 rounded text-neutral-700 hover:bg-white mb-3">&laquo; back</button>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-3 py-4 w-full sm:w-[500px]">
                <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                    @csrf
            
                    <!-- Name -->
                    <div class="mb-3">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Type category name.." />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="icon" :value="__('Icon')" />
                        <x-text-input id="icon" class="block hover:cursor-pointer mt-1 w-full py-2 border px-2 focus:border-indigo-500 active:border-indigo-400" type="file" name="icon" :value="old('icon')" />
                        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                    </div>
            
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Add') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
