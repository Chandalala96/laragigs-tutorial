<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//ALL LISTINGS
// Route::get('/', function () { 
//     // return view('listings', [
//     //     'listings' => Listing::all()
//     // ]);

// });


// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing 

Route::get('/', [ListingController::class, 'index']);

//SHOW CREATE FORM
Route::get('/listings/create', [ListingController::class, 'create' ])->middleware('auth');
// //SHOW CREATE FORM
// Route::get('/listings/create', [ListingController::class, 'create' ]);

//STORE LISTING DATA
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');


//SHOW EDIT FORM
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

//UPDATE LISTING
// Route::put('/listings/{listing}', [ListingController::class, 'update']);

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//DELETE LISTING
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');
//SINGLE LISTINGS
// Route::get('/listings/{id}', function($id) {
//     $listing = Listing::find($id);
//     if($listing) {
//         return view('listing', [
//             'listing' => $listing
//            ]);
//     } else {
//         abort('404');
//     }
 
// }); 

// Route::get('/listings/{listing}', function(Listing$listing) {
    
//         // return view('listing', [
//         //     'listing' => $listing
//         //    ]);
  
 
// });

Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Route::get('/', function () { 
//     return view('listings', [
//         'heading' => 'Latest listings',
//         'listings' => [
//             [
//                 'id' => 1,
//                 'title' => 'Listing One',
//                 'description' => 'This is the description rom the Trap'
//             ],
//             [
//                 'id' => 2,
//                 'title' => 'Listing two',
//                 'description' => 'This is the description rom the Trap'
//             ]
//         ]
//     ]);
// });

// Route::get('/hello', function () {
//     return response('<h1>Hello World</h1>');
// });

// Route::get('/posts/{id}', function($id){
//     return response('Post ' . $id);
// })->where('id', '[0-9]+');

// Route::get('/search', function(Request $request ) {
//    return $request->name . ' ' . $request->city;
// });

//SHOW REGISTER?CREATE FORM
Route::get('/register', [UserController::class, 'create'])->middleware('guest');
 
//CREATE NEW USER
Route::post('/users',[UserController::class, 'store']);

//LOG USER OUT
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth'); 

//SHOW LOGIN FORM
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//LOGIN USER
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

