<x-layout>

@include('partials/_hero')

@include('partials/_search')

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        @unless(count($listings) === 0)
            @foreach ($listings as $listing)
                <!-- Item  -->
                <x-listing-card :listing="$listing" />
            @endforeach
        @else
            <p class="text-lg text-center">No listing found</p>
        @endunless
    </div>
    <div class="mt-5 px-4 py-8 border-gray-300 text-sm items-center">
        {{ $listings->links() }}
    </div>
</x-layout>
