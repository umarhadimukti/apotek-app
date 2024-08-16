<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-3 py-5">
                <div class="flex justify-between items-center">
                    <div class="flex flex-col">
                        <h3 class="font-semibold">List of Products</h3>
                        <p class="text-gray-500 italic">for manage available products</p>
                    </div>
                    <a href="{{ route('admin.products.create') }}" class="px-5 py-1 border hover:bg-neutral-50 hover:text-neutral-600 rounded-full active:ring-4 active:ring-slate-100">Create New</a>
                </div>

                @if (session()->has('message'))
                    <div class="my-2 ring-4 ring-green-100 animate-pulse rounded-full py-1 px-3 max-w-max bg-green-400 text-neutral-50">
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
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        About
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Details
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr class="bg-white hover:bg-gray-50">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ @$product->id }}
                                    </th>
                                    <td class="px-6 py-4 flex items-center gap-2">
                                        @if (@$product->photo)
                                        <div class="rounded-full w-10 h-10 overflow-hidden">
                                            <img src={{ asset('storage/' . @$product->photo) }} alt="">
                                        </div>
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
                                        <div class="flex flex-col w-full">
                                            <div class="font-bold text-black">
                                                {{ $product->name }}
                                            </div>
                                            {{ $product->slug ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="px-3 w-[100px] py-4">
                                        <p class="text-xs text-gray-400">@currencyIdr(@$product->price)</p>
                                    </td>
                                    <td class="px-5 py-4">
                                        <p class="text-sm text-gray-400">{{ @$product->about ?? '-' }}</p>
                                    </td>
                                    <td class="px-5 py-4">
                                        <p class="text-sm text-gray-400">{{ @$product?->category_name ?? '-' }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-blue-600 hover:underline hover:cursor-pointer flex gap-3">
                                            <a href="{{ route('admin.products.show', $product->id) }}" text-indigo-500 hover:text-indigo-700 hover:scale-105 transition-all">
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
                                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('are you sure want to delete?')" class="text-red-500 hover:text-red-700 hover:scale-105 transition-all">
                                                    <svg width="25" height="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 6L6.80086 18.0129C6.871 19.065 6.90607 19.5911 7.13332 19.99C7.33339 20.3412 7.63517 20.6235 7.99889 20.7998C8.41202 21 8.94135 21 10 21M18 6L17.8 9M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M17 15.5V17H18.5M21 17C21 19.2091 19.2091 21 17 21C14.7909 21 13 19.2091 13 17C13 14.7909 14.7909 13 17 13C19.2091 13 21 14.7909 21 17Z" stroke="#f04800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="bg-red-400 font-semibold text-white text-center py-3">empty.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
