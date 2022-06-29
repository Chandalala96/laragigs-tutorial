<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
     //show all listings
    public function index() {
        // dd(request('tag'));
        return view('listings.index', [
            'listings' => Listing::Latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    } 
    

    //show single listings
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
           ]);
    }

    //show create form
    public function create() {
        return view('listings.create');
    }

    //store listing data
    public function store(Request $request) {
       $fromFields = $request->validate([
        'title' => 'required',
        'company' => ['required', Rule::unique('Listings', 'company')],
        'location' => 'required',
        'website' => 'required',
        'email' => ['required', 'email'],
        'tags' => 'required',
        'description' => 'required'
       ]);

       if($request->hasFile('logo')) {
        $fromFields['logo'] = $request->file('logo')->store('logos', 'public');
       }

       $fromFields['user_id'] = auth()->id();

     

       Listing::create($fromFields);

       return redirect('/')->with('message', 'Listing created successfully');
    }

    //Show Edit Form
    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    } 

    //Update Listing Data 
    public function update(Request $request, Listing $listing) {
          //make sure logged in user is owner
          if($listing->user_id != auth()->id()) {
             abort(403, 'Unauthorized Action'); 
          }

        $fromFields = $request->validate([
         'title' => 'required',
         'company' => 'required',
         'location' => 'required',
         'website' => 'required',
         'email' => ['required', 'email'],
         'tags' => 'required',
         'description' => 'required'
        ]);
 
        if($request->hasFile('logo')) {
         $fromFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
 
      
 
        $listing->update($fromFields);
 
        return back()->with('message', 'Listing updated successfully');
     }

     //Delete Listing
     public function destroy(Listing $listing) {
         //make sure logged in user is owner
         if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action'); 
         }
$listing->delete();
return redirect('/')->with('message', 'Listing deleted succesfully');

     }

     //Manage Listings
     public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
        
     }
}
