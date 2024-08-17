<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <button type="button" onclick="window.history.back()" class="px-3 py-1 rounded text-neutral-700 hover:bg-white mb-3">&laquo; back</button>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-5 py-5 w-full sm:w-[500px]">
                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                    @csrf
            
                    <!-- Name -->
                    <div class="mb-3">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Type product name.." />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-3 mt-3">
                        <div class="">Product Photo</div>
                        <div class="mb-2">
                            <img id="image-preview" width="150" class="w-40 object-cover rounded drop-shadow-lg">
                        </div>
                        <label for="photo" class="flex gap-1 px-3 py-1 border hover:bg-gray-100 text-gray-600 active:ring-4 active:ring-neutral-50 max-w-max rounded cursor-pointer">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload" width="23" height="23" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                    <path d="M7 9l5 -5l5 5" />
                                    <path d="M12 4l0 12" />
                                  </svg>
                            </span>
                            Upload
                        </label>
                        <input type="file" id="photo" name="photo" class="w-[400px] rounded border border-gray-300 hover:scale-125 hidden transition-all hover:cursor-pointer p-2 @error('photo') border border-red-500 @enderror" onchange="previewImage(event)">
                        
                        @error('photo')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror()
                    </div>

                    <div class="mb-3">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required autofocus autocomplete="name" placeholder="Rp. 0" min="0" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <x-input-label for="about" :value="__('Description')" />
                        <textarea name="about" id="about" placeholder="product description.." class="w-full mt-1 rounded border border-gray-300"></textarea>
                    </div>

                    <div class="mb-3">
                        <x-input-label for="category" :value="__('Category')" />
                        <select name="category_id" id="category_id" class="rounded mt-1 w-full border border-gray-300 text-gray-600 hover:cursor-pointer">
                            <option selected hidden>Choose product category</option>
                            @foreach ($categories as $key => $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
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
