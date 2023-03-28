<!-- Container -->
<div class="max-w-screen-lg mx-auto px-4">
    <!-- Grid wrapper -->
    <form action="{{ route('listings.manage') }}">
        @csrf
        <div class="-mx-4 flex flex-wrap bg-white">
            <!-- Grid column -->
            <div class="w-full flex flex-col p-2 sm:w-1/2 lg:w-1/3">
                <!-- Column contents -->
                <div class="flex-1 px-2 py-2 bg-white rounded-lg shadow-lg">
                    <!-- Card contents -->
                    <input value="{{ request('search') }}" type="text" name="search"
                        class="h-10 w-full border-2 rounded-lg z-0 focus:shadow focus:ring-blue-500 focus:border-blue-500 "
                        placeholder="Search Laravel Gigs..." />
                </div>
            </div>
            <!-- Grid column -->
            <div class="w-full flex flex-col p-2 sm:w-1/2 lg:w-1/3  content-center">
                <!-- Column contents -->
                <div class="flex-1 px-2 py-2 bg-white rounded-lg shadow-lg">
                    <!-- Card contents -->
                    <select name="show"
                        class="bg-white border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="1" @selected(request()->get('show') == '1')>Published</option>
                        <option value="2" @selected(request()->get('show') == '2')>Unpublished</option>
                        <option value="3" @selected(request()->get('show') == '3')>All</option>
                    </select>
                </div>
            </div>
            <!-- Grid column -->
            <div class="w-full flex flex-col p-2 sm:w-1/2 lg:w-1/3  items-center">
                <!-- Column contents -->
                <div class="flex-1 px-10 py-2 bg-white rounded-lg shadow-lg">
                    <button type="submit" class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600">
                        Search
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
