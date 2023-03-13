<x-layout>
    @include('partials/_search')

    <div class="mx-4">
        <x-card class="p-10">
            <header>
                <h1 class="text-3xl text-center font-bold my-6 uppercase">
                    Manage Gigs
                </h1>
            </header>

            <table class="w-full table-auto table-striped rounded-sm">
                <tbody>
                    @unless($listings->isEmpty())
                        @foreach ($listings as $listing)
                            <tr class="border-gray-300">
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <a href="{{ url('/listings/' . $listing->id) }}">
                                        {{ $listing->title }}
                                    </a>
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <a href="{{ url('listings/' . $listing->id . '/edit') }}"
                                        class="text-blue-400 px-6 py-2 rounded-xl"><i class="fa-solid fa-pen-to-square"></i>
                                        Edit</a>
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <form action="{{ url('/listings/' . $listing->id) }}" method="post">
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
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                No listings found.
                            </td>
                        </tr>
                    @endunless
                </tbody>
                    <tfoot>
                        <tr class="border-gray-300 items-center">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-xs">
                                {{ $listings->links() }}
                            </td>
                        </tr>
                    </tfoot>
            </table>
        </x-card>
    </div>
</x-layout>
