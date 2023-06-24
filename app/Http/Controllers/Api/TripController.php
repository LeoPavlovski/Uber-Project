<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::all();
        return TripResource::collection($trips);
    }

    /**
     * Store a newly created resource in storage.
     *   'user_id'=>1,
    'driver_id'=>1,
    'origin'=>json_encode([
    'latitude'=>123.456,
    'longitude'=>78.901,
    'address'=>'Ilindenska,City'
    ]),
    'destination_name'=>"Tetovo-Skopje"
     */
    public function store(Request $request)
    {
        //if i want to get the response correctly,
        // then i don't need the json_encode or decode, just i need to access the values in the json object.

        $origin = [
            'latitude'=>$request->input('origin.latitude'),
            'longitude'=>$request->input('origin.longitude'),
            'address'=>$request->input('origin.address'),

        ];
        $trips = Trip::create([
            'user_id' => $request->user_id,
            'driver_id' => $request->driver_id,
            'origin'=>$origin,
            'destination_name' => $request->destination_name
        ]);
        return new TripResource($trips);
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        return new TripResource($trip);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        $trip->update([
            'user_id'=>$request->user_id,
            'driver_id'=>$request->driver_id,
            'origin'=>json_encode([
                'latitude'=>$request->latitude,
                'longitude'=>$request->longitude,
                'address'=>$request->address,
            ]),
            'destination_name'=>$request->destination_name
        ]);
        return new TripResource($trip);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();
        return response()->json([
            'Message'=>"Trip has been deleted"
        ]);
    }
}
