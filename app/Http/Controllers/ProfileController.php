<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id=Auth::id();
        $user=Auth::user();
        $profile=Profile::where('id',Auth::id())->get();
        if($user->profile==null)
        {
            return response()->json(['message'=>'you dont have profile..please create'],401);
        }
        return response()->json(['my profile is'=>$profile],200);
    }

    public function store(Request $request, Profile $profile)
    {
        $profile=Profile::all();
        $id=Auth::id();
        $user=Auth::user();
        $validator = Validator::make($request->all(), [
            'last_name' => 'required',
            'photo' => 'required|image',
            'gender' => 'required',
            'country' => 'required',
            'hoppies' => 'required',
            'number_phone' => 'required',
            'birthday' => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->json(['message'=>'error',$validator->errors()],401);
        }
        if (!empty($user->profile))
        {
            return response()->json(['success'=>false,'message'=>'you have already profile','profile is'=>$profile],200);
        }
        $input=$request->all();
        $photo=$request->photo;
        $newPhoto=time().$photo->getClientOriginalName();
        $photo->move('/profile',$newPhoto);
       $input['photo']=('/profile'.$newPhoto);
       $input['first_name']=$user->name;
        $input['user_id']=$id;
        $profile=Profile::create($input);
        return response()->json(['access'=>true,'message'=>'create profile succssesly'],200);

    }

    public function update(Request $request ,Profile $profile)
    {
        $user=Auth::user();
        $validator = Validator::make($request->all(), [
            'last_name' => 'required',
            'photo' => 'required|image',
            'gender' => 'required',
            'country' => 'required',
            'hoppies' => 'required',
            'number_phone' => 'required',
            'birthday' => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->json(['message'=>'error',$validator->errors()],401);
        }
        $input=$request->all();
        if($request->has('photo'))
        {
            $photo=$request->photo;
            $newPhoto=time().$photo->getClientOriginalName();
            $photo->move('/profile'.$newPhoto);
        }
        if($user->profile==null)
        {
            return response()->json(['message'=>'you dont have profile..please create before update'],401);
        }

        $profile->update($input);
        return response()->json(['access'=>true,'message'=>'update profile succssesly'],200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $id=Auth::id();
        $user=Auth::user();
        $profile=Profile::where('user_id',auth::id())->delete();
        return response()->json(['access'=>true,'message'=>'delete profile succssesly'],200);
    }
}
