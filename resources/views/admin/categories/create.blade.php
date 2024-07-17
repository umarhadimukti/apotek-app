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

                    <div class="mb-2 mt-3">
                        <div>
                            <img id="image-preview" width="150" class="w-40 object-cover rounded drop-shadow-lg my-2">
                        </div>
                        <label for="icon" class="flex gap-1 px-3 py-1 border active:ring-4 active:ring-neutral-200 max-w-max rounded cursor-pointer">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload" width="23" height="23" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                    <path d="M7 9l5 -5l5 5" />
                                    <path d="M12 4l0 12" />
                                  </svg>
                            </span>
                            Upload Icon
                        </label>
                        <input type="file" id="icon" name="icon" class="w-[400px] rounded border border-gray-300 hover:scale-125 hidden transition-all hover:cursor-pointer p-2 @error('icon') border border-red-500 @enderror" onchange="previewImage(event)">
                        
                        @error('icon')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror()
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

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('image-preview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);

            document.querySelector('#old-image').classList.add('hidden');
        }
    </script>
</x-app-layout>
