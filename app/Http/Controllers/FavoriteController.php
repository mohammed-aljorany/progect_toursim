<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id=auth::id();
        $favorite = Favorite::where('user_id',Auth::id())->get();
        $countFavorite=Favorite::count();
        return response()->json(['success'=>true,'All count favorite'=>$countFavorite,'all favorite'=>$favorite],200);
    }

    public function store(Request $request)
    {
        $user=Auth::user();
        $id=Auth::id();
        $item=Favorite::where([
            'user_id'=>$id,
            'place_id'=>$request->place_id
        ])->get();
        if(count($item)>0)
        {
            return response()->json(['success'=>false,'message'=>'sorry its alaready in favorite'],400);
        }
        else
        {
            $validator=Validator::make($request->all(),[
                'place_id'=>'required|exists:places,id']);
            if($validator->fails())
            {
                return response()->json(['success'=>false,$validator->errors()],200);
            }
            $input=$request->all();
            $input['user_id']=$id;
            $favorite = Favorite::create($input);
            return response()->json(['success' => true, 'favorite product' => $favorite], 200);

        }}

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $favorite=Favorite::where('id',$id)->where('user_id',Auth::id())->delete();
        return response()->json(['success' => true, 'message' =>'delete succssefly' ], 200);
    }
}
