<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Hotel;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

use Validator;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $country=Country::latest()->with('city')->paginate(20);
        if(count($country)==0)
        {
            return response()->json(['message'=>'sorry...please create country'],404);
        }
        return response()->json(['access'=>true,'all country'=>$country],200);

    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
       'country_name'=>'required',
       'info'=>'required',
       'photo'=>'required|image'
    ]);
        if($validator->fails())
        {
            return response()->json(['access'=>false,$validator->errors()],404);
        }

        $input=$request->all();
        $photo=$request->photo;
        $newPhoto=time().$photo->getClientOriginalName();
        $photo->move('counteyy',$newPhoto);
        $input['photo']=('counteyy'.$newPhoto);
        $country=Country::create($input);
        return response()->json(['access'=>true,'message'=>'create country done'],200);
    }
    public function show($id)
    {
        $country=Country::findorfail($id);
        return response()->json(['access'=>true,'country is'=>$country],200);
    }
    public function update(Request $request, Country $country)
    {
        $validator=Validator::make($request->all(),[
            'country_name'=>'required',
            'info'=>'required',
            'photo'=>'required|image'
        ]);
        if($validator->fails())
        {
            return response()->json(['access'=>false,$validator->errors()],404);
        }

        $input=$request->all();
        if($request->has('photo'))
        {
        $photo=$request->photo;
        $newPhoto=time().$photo->getClientOriginalName();
        $photo->move('counteyy',$newPhoto);
        }
        $input['photo']=('counteyy'.$newPhoto);
        $country=Country::update($input);
        return response()->json(['access'=>true,'message'=>'update country done'],200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $country=Country::findorfail($id)->delete();
        return response()->json(['access'=>true,'message'=>'delete country done'],200);
    }
public function search($searchh)
{
    $country=Country::all();
    $place=Place::where('name_place','LIKE','%'.$searchh.'%')->with('country','city')->get();
    $hotel=Hotel::where('hotel_name','LIKE','%'.$searchh.'%')->with('country','city')->get();
    return response()->json(['success'=>true,'the search is:'=>$place,$hotel],200);
}
}
