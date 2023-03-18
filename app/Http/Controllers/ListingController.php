<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use PhpParser\Node\Scalar\DNumber;
use App\Http\Requests\ListingRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatelistingRequest;

class ListingController extends Controller
{
    public function index()
    {
        return view(
            'listings.home',
            [
                'heading' => 'Latest Listings',
                'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('listings.create-listing');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ListingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListingRequest $request)
    {
        $validatedFormData = $request->validated();

        if ($request->hasFile('logo')) {
            $validatedFormData['logo'] = $request->validated('logo')->Store('logos', 'public');
        }

        Listing::create($validatedFormData);

        return redirect('/')->with('success', 'Listing is created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        return view('listings.show-listing', [
            'listing' => $listing,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(listing $listing)
    {
        return view('listings.edit-listing', [
            'listing' => $listing,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatelistingRequest  $request
     * @param  \App\Models\listing  $listing
     * @return \Illuminate\Http\Response
     */
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

        return back()->with('success', 'Listing is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\listing  $listing
     * @return \Illuminate\Http\Response
     */
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
        return view('listings.manage', [
            'listings' => auth()->user()->listings()->latest()->simplePaginate(6),
        ]);
    }
}