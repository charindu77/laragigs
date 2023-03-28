<x-layout>
    <div class="mx-4">
        <x-card class="p-10">
            <header>
                <h1 class="text-xl text-center font-bold my-3 uppercase">
                    Manage Gigs
                </h1>
            </header>

            @include('partials/user/_manage-search')


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-white">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Delete</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @unless($listings->isEmpty())
                            @foreach ($listings as $listing)
                                <tr class="bg-white border-b hover:bg-gray-100">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <a href="{{ route('listings.show', ['listing' => $listing->id]) }}">
                                            {{ $listing->title }}
                                        </a>
                                    </th>
                                    <td class="px-6 py-4">
                                        #{{ $listing->id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('listings.publish', ['listing' => $listing->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('put')
                                            @if ($listing->is_published)
                                                <button
                                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                    Published
                                                </button>
                                            @else
                                                <button
                                                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                                    Unpublished
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('listings.edit', ['listing' => $listing->id]) }}"
                                            class="font-medium text-blue-600 hover:underline"><i
                                                class="fa-solid fa-pen-to-square"></i>
                                            Edit</a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('listings.destroy', ['listing' => $listing->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600">
                                                <i class="fa-solid fa-trash-can"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="bg-white border-b hover:bg-gray-100">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    No Listing found.
                                </th>
                            </tr>
                        @endunless
                    </tbody>
                </table>
                <div class="flex justify-center font-semibold text-gray-900">
                    <div scope="row" class="px-6 py-3 text-base w-1/2"> {{ $listings->links() }}</div>
                </div>
            </div>

        </x-card>
    </div>
</x-layout>
