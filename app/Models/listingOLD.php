<?php 

namespace App\Models;

class Listing {
    public static function all() {
        return [
            [
                'id' => 1,
                'title' => 'Listing One',
                'description' => 'This is the description rom the Trap'
            ],
            [
                'id' => 2,
                'title' => 'Listing two',
                'description' => 'This is the description rom the Trap'
            ]
            ];
    }


    public static function find($id) {
        $listings = self::all();

        foreach($listings as $listing) {
            if($listing['id'] == $id) {
                return $listing;
            }
        }
    }
}