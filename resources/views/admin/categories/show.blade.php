<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <button type="button" onclick="window.history.back()" class="px-3 py-1 rounded text-neutral-700 hover:bg-white mb-3">&laquo; back</button>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-3 py-5">
                <div class="flex justify-between items-center">
                    <h3 class="italic font-semibold text-xl">#{{ $category->id }}</h3>
                    <a href="{{ route('admin.categories.destroy', $category->id) }}" onclick="return confirm('are you sure want to delete?')" class="px-5 py-2 hover:bg-neutral-100 hover:scale-105 transition-all rounded active:ring-4 active:ring-slate-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="30" height="30" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 7h16" />
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                            <path d="M10 12l4 4m0 -4l-4 4" />
                          </svg>
                    </a>
                </div>
            
                <div class=" mt-3">
                    <form action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label for="name" class="block">Category Name</label>
                            <input type="text" value="{{ $category->name }}" name="name" class="w-[400px] rounded border border-gray-300 hover:scale-105 transition-all @error('name') border border-red-500 @enderror">
                            @error('name')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror()
                        </div>
                        <div class="mb-2 mt-3">

                            @if ($category->icon)
                            <div class="mt-3">
                                <img id="old-image" src={{ asset('storage/' . $category->icon) }} width="150" class="w-40 object-cover rounded drop-shadow-lg">
                            </div>   
                            @endif
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
                        <div class="mb-2 mt-4">
                            <x-primary-button>Update</x-primary-button>
                        </div>
                    </form>
                </div>
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
