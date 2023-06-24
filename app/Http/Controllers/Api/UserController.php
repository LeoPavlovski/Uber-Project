<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     'name',
     'phone',
     'login_code',
     */
    public function index()
    {
        $trips = User::all();
        return UserResource::collection($trips);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $trips = User::create([
          'name'=>$request->name,
          'phone'=>$request->phone,
        ]);

        return new UserResource($trips);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update([
            'name'=>$request->name,
            'phone'=>$request->phone,
        ]);
        return new UserResource($user);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'Message'=>"User has been deleted"
        ]);
    }
}
