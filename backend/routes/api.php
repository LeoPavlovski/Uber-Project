<?php

use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\TripController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function(){
   //User
    Route::get('/getUsers', [UserController::class, 'index']);
    Route::get('/getUser/{user}',[UserController::class , 'show']);
    Route::post('/createUser',[UserController::class, 'store']);
    Route::put('/updateUser/{user}',[UserController::class, 'update']);
    Route::delete('/deleteUser/{user}',[UserController::class, 'destroy']);
    //Drivers
    Route::get('/getDrivers', [DriverController::class, 'index']);
    Route::get('/getDriver/{driver}',[DriverController::class , 'show']);
    Route::post('/createDriver',[DriverController::class, 'store']);
    Route::put('/updateDriver/{driver}',[DriverController::class, 'update']);
    Route::delete('/deleteDriver/{driver}',[DriverController::class, 'destroy']);
    //Trips
    Route::get('/getTrips', [TripController::class, 'index']);
    Route::get('/getTrip/{trip}',[TripController::class , 'show']);
    Route::post('/createTrip',[TripController::class, 'store']);
    Route::put('/updateTrip/{trip}',[TripController::class, 'update']);
    Route::delete('/deleteTrip/{trip}',[TripController::class, 'destroy']);

    Route::post('/trip/{trip}/accept', [TripController::class, 'accept']);
    Route::post('/trip/{trip}/start', [TripController::class, 'start']);
    Route::post('/trip/{trip}/end', [TripController::class, 'end']);
    Route::post('/trip/{trip}/location', [TripController::class, 'location']);


});


Route::post('/login',[LoginController::class , 'submit']);
Route::post('/login/verify',[LoginController::class, 'verify']);
