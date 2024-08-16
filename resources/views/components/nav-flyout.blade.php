@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'inline-flex items-center px-10 py-1 border-4 border-yellow-300 bg-indigo-600 rounded-full text-sm font-medium text-white transition duration-150 ease-in-out'
        : 'inline-flex items-center px-10 py-1 text-sm font-medium text-gray-500 hover:text-gray-700 focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out hover:bg-neutral-100 rounded-full';
@endphp

<div x-data="{ open: false }" class="relative flex items-center justify-center">
    <!-- Button to trigger flyout -->
    <button {{ $attributes->merge(['class' => $classes]) }} @mouseover="open = true" @mouseleave="open = false" x-cloak>
        <div class="flex gap-2 items-center">
            {{ $slot }}
            <div class="font-bold flex items-center justify-center relative">
                <template x-if="open" x-transition>
                    <div class="flex items-center absolute top-[-6px] right-[-9px]">
                        <svg viewBox="0 0 24 24" fill="none" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18.2929 15.2893C18.6834 14.8988 18.6834 14.2656 18.2929 13.8751L13.4007 8.98766C12.6195 8.20726 11.3537 8.20757 10.5729 8.98835L5.68257 13.8787C5.29205 14.2692 5.29205 14.9024 5.68257 15.2929C6.0731 15.6835 6.70626 15.6835 7.09679 15.2929L11.2824 11.1073C11.673 10.7168 12.3061 10.7168 12.6966 11.1073L16.8787 15.2893C17.2692 15.6798 17.9024 15.6798 18.2929 15.2893Z" fill="#f5f5f5"></path> </g></svg>
                    </div>
                </template>
                <template x-if="!open" x-transition>
                    <div class="flex items-center absolute top-[-7px] right-[-9px]">
                        <svg viewBox="0 0 24 24" fill="none" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5.70711 9.71069C5.31658 10.1012 5.31658 10.7344 5.70711 11.1249L10.5993 16.0123C11.3805 16.7927 12.6463 16.7924 13.4271 16.0117L18.3174 11.1213C18.708 10.7308 18.708 10.0976 18.3174 9.70708C17.9269 9.31655 17.2937 9.31655 16.9032 9.70708L12.7176 13.8927C12.3271 14.2833 11.6939 14.2832 11.3034 13.8927L7.12132 9.71069C6.7308 9.32016 6.09763 9.32016 5.70711 9.71069Z" fill="#f5f5f5"></path> </g></svg>
                    </div>

                </template>
            </div>
        </div>
    </button>

    <div @mouseover="open = true" @mouseleave="open = false" x-show="open" x-cloak x-transition class="absolute top-[49px] w-64 bg-white z-50 shadow rounded-lg transition-all ease-in-out">
        <div class="p-4">
            <ul>
                <li><a href="{{ route('admin.products.index') }}" class="block py-2 px-4 hover:bg-gray-50 rounded-xl text-center text-gray-500 hover:text-gray-700">Products</a></li>
                <li><a href="{{ route('admin.categories.index') }}" class="block py-2 px-4 hover:bg-gray-50 rounded-xl text-center text-gray-500 hover:text-gray-700">Categories</a></li>
                <li><a href="#" class="block py-2 px-4 hover:bg-gray-50 rounded-xl text-center text-gray-500 hover:text-gray-700">Users</a></li>
            </ul>
        </div>
    </div>
</div>