<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(),[
            'origin'=>'required',
            'destination_name'=>'required',
            'destination'=>'required'
        ]);
        if($validator->fails()){
            return response()->json([
               'errors'=>$validator->errors()
            ]);
        }
        $origin = [
            'latitude'=>$request->input('origin.latitude'),
            'longitude'=>$request->input('origin.longitude'),
            'address'=>$request->input('origin.address'),

        ];
        //json
//        $destination = [
//            ""
//        ];
        //As a passenger
        if($validator->passes()){

            $trips = Trip::create([
                'user_id' => $request->user_id,
                'driver_id' => $request->driver_id,
                'origin'=>$origin,
                'destination_name' => $request->destination_name,
//                'destination'=>$destination,
            ]);
           return response()->json([
              'Trip Created',
               'data'=>new TripResource($trips)
           ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request , Trip $trip)
    {
        if($trip->user->id === $request->user()->id){
            return new TripResource($trip);
        }
        if($trip->driver && $request->user()->driver){
            if($trip->driver->id=== $request->user()->driver->id){
                return new TripResource($trip);
            }
        }
        return response()->json([
           'message'=>'Cannot find this trip'
        ],404);
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
    public function accept(Trip $trip , Request $request)
    {
        //driver has accepted the trip
        //what could be the logic here?
       $validator = Validator::make($request->all(),[
          'driver_location'=>'required'
       ]);
       $trip->update([
          'driver_id'=>$request->user()->id,
          'driver_location'=>$request->driver_location,
       ]);
       $trip->load('driver.user');

       return $trip;
    }
    public function end( Trip $trip , Request $request)
    {
        //driver has ended the trip
    }
    public function location(Trip $trip , Request $request)
    {
        //update the drivers locations
        //we have to get the json here. (origin)
    }
    public function start(Trip $trip , Request $request)
    {
        $validate = Validator::make($request->all(),[
            'is_started'=>'required',
        ]);
        //driver has started driving the passenger to the destination
        //Destination -> json
        //destiantion name
        $trip->update([
           //Do we need here the userId ? or just location ( destinations)
            'is_started'=>true,
        ]);
        $trip->load('driver.user');
        return new TripResource($trip);
    }
}
