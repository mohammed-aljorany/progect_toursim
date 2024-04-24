<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Validator;

class CityController extends Controller
{

    public function index()
    {
        $city=City::latest()->paginate(5);
        return response()->json(['access'=>true,'all city is'=>$city],200);
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            ['city_name'=>'required',
             'info'=>'required',
             'photo'=>'required|image',
             'country_id'=>'required|exists:countries,id'
            ]);
        if($validator->fails())
        {
            return response()->json(['access'=>false,$validator->errors()],404);
        }
        $input=$request->all();
        $photo=$request->photo;
        $newPhoto=time().$photo->getClientOriginalName();
        $photo->move('cityy',$newPhoto);
        $input['photo']=('cityy'.$newPhoto);
        $city=City::create($input);
        return response()->json(['access'=>true,'message'=>'create city done'],200);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $city=City::find($id);
        return response()->json(['access'=>true,'city is'=>$city],200);
    }

    public function update(Request $request, City $city)
    {
        $validator=Validator::make($request->all(),
            ['city_name'=>'required',
                'info'=>'required',
                'photo'=>'required|image',
                'country_id'=>'required|exists:countries,id'
            ]);
        if($validator->fails())
        {
            return response()->json(['access'=>false,$validator->errors()],404);
        }
        $input=$request->all();
        if($request->has('photo')) {
            $photo = $request->photo;
            $newPhoto = time() . $photo->getClientOriginalName();
            $photo->move('cityy', $newPhoto);
        }
        $input['photo']=('cityy'.$newPhoto);
        $city=City::update($input);
        return response()->json(['access'=>true,'message'=>'update city done'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $city=City::findorfail($id)->delete();
        return response()->json(['access'=>true,'message'=>'delete city done'],200);
    }
}
