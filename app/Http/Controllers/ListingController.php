<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Http\Requests\ListingRequest;
use Illuminate\Support\Facades\Cache;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(request('tag'));
        return view(
            'listings.home',
            [
                'heading' => 'Latest Listings',
                'listings' => Cache::remember(
                    'listings',
                    now()->addDay(),
                    function () {
                        return Listing::latest()
                            ->published()
                            ->filter(request(['tag', 'search']))
                            ->paginate(50);
                    }
                )
            ]
        );
    }

    public function create()
    {
        return view('listings.create-listing');
    }

    public function store(ListingRequest $request)
    {
        $validatedFormData = $request->validated();

        if ($request->hasFile('logo')) {
            $validatedFormData['logo'] = $request->validated('logo')->Store('logos', 'public');
        }

        // Listing::create($validatedFormData);
        auth()->user()->listings()->create($validatedFormData);

        return redirect('/')->with('success', 'Listing is created successfully!');
    }


    public function show(Listing $listing)
    {
        return view('listings.show-listing', [
            'listing' => $listing,
        ]);
    }


    public function edit(listing $listing)
    {
        return view('listings.edit-listing', [
            'listing' => $listing,
        ]);
    }

    public function update(ListingRequest $request, Listing $listing)
    {
        if (auth()->id() != $listing->user->id) {
            return abort(403);
        }

        $validatedFormData = $request->validated();

        if ($request->hasFile('logo')) {
            if ($listing->logo) {
                unlink(Storage_path('app/public/' . $listing->logo));
            }
            $validatedFormData['logo'] = $request->validated('logo')->Store('logos', 'public');
        }

        $listing->update($validatedFormData);

        return redirect(route('listings.show', [$listing]))->with('success', 'Listing is updated successfully!');
    }

    public function destroy(Listing $listing)
    {
        if (auth()->id() != $listing->user->id) {
            return abort(403);
        }

        if ($listing->logo) {
            unlink(Storage_path('app/public/' . $listing->logo));
        }
        $listing->delete();
        return back()->with('success', 'The listing is deleted successfully!');
    }

    public function manage()
    {
        $listings = auth()->user()->listings()->filter(request(['tag', 'search', 'show']))->latest()->paginate(25);
        return view('listings.manage', compact(['listings']));
    }

    public function publish(Listing $listing)
    {
        if (auth()->id() != $listing->user->id) {
            return abort(403);
        }

        $listing->update(['is_published'=>!$listing->is_published]);

        $status = ($listing->is_published) ? 'published':'unpublished';
        return back()->with('success',  "The listing is {$status} successfully!");
    }
}