<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\LoginNeedsVerification;
use Illuminate\Http\Request;

class LoginController extends Controller
{
 public function submit(Request $request){

     $validateUser = Validator($request->all(),
      [
        'phone'=>'required|min:10|numeric'
     ]);
     if($validateUser->fails()){
         return response()->json([
            'errors' => $validateUser->errors()
         ]);
     }

     $user = User::create([
         'phone'=>$request->phone,
     ]);

     if(!$user){
         return response()->json([
            'message'=>'Could not process the user with that number!'
         ],401);
     }
      //instantiated object
     //This is the place where we are sending the notifications
     $user->notify(new LoginNeedsVerification());

     return response()->json([
         "Text Message Notification Sent!"
     ]);
 }
    public function verify(Request $request)
    {
        //Validate the request,
        $validateUser = Validator($request->all(),[
           'phone'=>'required|min:10|numeric',
           'login_code'=>'required'
        ]);
        if($validateUser->fails()){
            return response()->json([
                'errors'=>$validateUser->errors()
            ]);
        }
        //find the user,
        $user = User::where('phone',$request->phone)->where('login_code',$request->login_code)->first();
        //Is the code provided the same one saved?
        //if so, return back the auth token,
        if($user) {
            //get the login code, so it can't be used again
//            $user->update([
//                'login_code'=>null
//            ]);
            //Generate the token
            return $user->createToken($request->login_code)->plainTextToken;
        }
        //if not , return back a message
        return response()->json([
           'message'=>"Invalid Verification Code"
        ],401);
    }
}
