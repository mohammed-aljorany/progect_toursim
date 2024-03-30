<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;

class RigsterController extends Controller
{
    public function rigister(request $request)
{
 $validator=Validator::make($request->all(),[
     'name'=>'required',
     'email'=>'required|email',
     'password'=>'required|min:8',
     'c_password'=>'required|same:password'
 ]);
 if($validator->fails())
 {
     return response()->json(['accesss'=>false,$validator->errors()],401);
 }
 $input=$request->all();
 $input['password']=Hash::make($input['password']);
 $user=User::create($input);
 $token=$user->createToken('mohammed')->accessToken;
 return response()->json(['access'=>true,'message'=>'rigester succssesfly','token is'=>$token],200);
}
public function login(request $request)
{
    $date=['email'=>$request->email,'password'=>$request->password];
    if(auth()->attempt($date))
    {
        $token=auth()->user()->createToken('mohammed')->accessToken;
        return response()->json(['access'=>true,'message'=>'login successflt','token is'=>$token],200);
    }
    else
    {
        return response()->json(['message'=>'sorry,, try agin'],401);
    }
}
public function logOut(request $request)
{
    $token=$request->user()->token();
    $token->delete();
    return response()->json(['access'=>true,'message'=>'log out succssesfly',],200);
}

}
