<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DriverResource;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
    $table->string('name');
    $table->year('year');
    $table->string('model');
    $table->string('license_plate');
    $table->string('color');
     */
    public function index()
    {
        $drivers = Driver::with('user')->get();
        return DriverResource::collection($drivers);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
           'name'=>'required|string',
            'year'=>'required|integer|between:2010,2023',
            'model'=>'required|string',
            'license_plate'=>'required',
            'color'=>'required|string',
            'city'=>'required|string'
        ]);
        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ]);
        }
        //the same logic is going to go here osn the creation
        $city = $request->city;
        if($city === 'Skopje'){
            $licensePlate = $request->license_plate;
            if(!preg_match('/^SK\d{3,4}[A-Z]{2}$/', $licensePlate)){
                return response()->json([
                    "message"=>'Incorrect License plate'
                ]);
            }
            return response()->json([
               'message'=>'Driver Created!'
            ]);
        }
        else{
            $driver = Driver::create([
                'name'=>$request->name,
                'year'=>$request->year,
                'model'=>$request->model,
                'license_plate'=>$request->license_plate,
                'color'=>$request->color,
                'city'=>$request->city,
            ]);
          return DriverResource::collection($driver);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show()
    {
       $driver = Driver::with('user')->first();
       return new DriverResource($driver);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $driverId)
    {
//       Some logic to validate the drivers license based on the state that they are driving in.
        $driver = Driver::find($driverId);
        $city = $driver->city;
        if($city === "Tetovo"){
            $licensePlate = $request->license_plate;
            //validate the license plate format
            if (!preg_match('/^TE\d{3,4}[A-Z]{2}$/', $licensePlate)) {
                return response()->json(['error' => 'Invalid license plate format for Tetovo'], 422);
            }
            $driver->license_plate = $licensePlate;
        }
        //implement the logic here to get the state regulation for the drivers license
        //for example if the state is New york, check if the driver's city is new york
        //And after that check the license if it matches the regulations for new york.
        $driver =Driver::find($driverId);

        $driver->update([
            'name'=>$request->name,
            'city'=>$request->city,
            'year'=>$request->year,
            'model'=>$request->model,
            'license_plate'=>$request->license_plate,
            'color'=>$request->color,

        ]);
        return DriverResource::collection($driver);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();
        return response()->json([
            'Message'=>"Driver has been deleted"
        ]);
    }
}
