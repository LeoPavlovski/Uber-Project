<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DriverResource;
use App\Models\Driver;
use Illuminate\Http\Request;

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
        $drivers = Driver::all();
        return DriverResource::collection($drivers);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $driver = Driver::create([
           'name'=>$request->name,
            'year'=>$request->year,
            'model'=>$request->model,
            'license_plate'=>$request->license_plate,
            'color'=>$request->color
        ]);
        return new DriverResource($driver);
    }
    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        return new DriverResource($driver);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        $driver->update([
            'name'=>$request->name,
            'year'=>$request->year,
            'model'=>$request->model,
            'license_plate'=>$request->license_plate,
            'color'=>$request->color
        ]);
        return new DriverResource($driver);
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
