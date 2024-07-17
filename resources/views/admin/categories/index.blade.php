<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-3 py-5">
                <div class="flex justify-between items-center">
                    <h3>List of Categories</h3>
                    <a href="{{ route('admin.categories.create') }}" class="px-5 py-2 border hover:bg-neutral-50 rounded active:ring-4 active:ring-slate-100">Create New</a>
                </div>

                @if (session()->has('message'))
                    <div class="my-2 border rounded p-3 max-w-max text-green-500">
                        {{ session('message') }}
                    </div>
                @endif
                
                <div class="tables mt-3">
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Slug
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Details
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                <tr class="bg-white hover:bg-gray-50">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $category->id }}
                                    </th>
                                    <td class="px-6 py-4 flex items-center gap-1">
                                        @if ($category->icon)
                                        <img src={{ asset('storage/' . $category->icon) }} width="30" alt="">
                                        @else
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-category-2" width="30" height="30" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M14 4h6v6h-6z" />
                                                <path d="M4 14h6v6h-6z" />
                                                <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                <path d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                            </svg>
                                        </div>
                                        @endif
                                        {{ $category->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $category->slug ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                                    </td>
                                </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
