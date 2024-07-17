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
                
                <div x-data="{ isOpen: false }" class="tables mt-3">
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
                                        <div class="font-medium text-blue-600 hover:underline hover:cursor-pointer flex gap-3">
                                            <a href="{{ route('admin.categories.show', $category->id) }}" class="text-indigo-500 hover:text-indigo-700 hover:scale-105 transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-details" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6f32be" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M13 5h8" />
                                                    <path d="M13 9h5" />
                                                    <path d="M13 15h8" />
                                                    <path d="M13 19h5" />
                                                    <path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                                    <path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                                  </svg>
                                            </a>
                                            <a href="{{ route('admin.categories.destroy', $category->id) }}" onclick="return confirm('are you sure want to delete?')" class="text-red-500 hover:text-red-700 hover:scale-105 transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x-filled" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6f32be" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16zm-9.489 5.14a1 1 0 0 0 -1.218 1.567l1.292 1.293l-1.292 1.293l-.083 .094a1 1 0 0 0 1.497 1.32l1.293 -1.292l1.293 1.292l.094 .083a1 1 0 0 0 1.32 -1.497l-1.292 -1.293l1.292 -1.293l.083 -.094a1 1 0 0 0 -1.497 -1.32l-1.293 1.292l-1.293 -1.292l-.094 -.083z" stroke-width="0" fill="currentColor" />
                                                    <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" stroke-width="0" fill="currentColor" />
                                                  </svg>
                                            </a>
                                        </div>
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
