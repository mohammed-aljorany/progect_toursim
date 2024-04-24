<?php

namespace App\Http\Controllers;

use App\Models\FamousPlace;
use App\Http\Controllers\Controller;
use App\Models\Photof;
use Illuminate\Http\Request;
use Validator;
class FamousPlaceController extends Controller
{
    public function index()
    {
        $famous=FamousPlace::latest()->with('photo','city','country')->paginate(10);
        return response()->json(['access'=>true,'all famous places'=>$famous],200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'info' => 'required',
            'photo' => 'required|image',
            'country_id' => 'required',
            'city_id' => 'required'

        ]);
        if ($validator->fails()) {
            return response()->json(['access' => false, $validator->errors()], 404);
        }
        $input = $request->all();


        $photo = $request->photo;
        $newPhoto = time() . $photo->getClientOriginalName();
        $photo->move('famouss', $newPhoto);

        $input['photo'] = ('famouss' . $newPhoto);

        $famous = FamousPlace::create($input);
        $famous->photo()->create(['photo' => $input['photo'], 'famous_place_id']);
        return response()->json(['access' => true, 'message' => 'create famous_place done'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $famous=FamousPlace::find($id);
        return response()->json(['access'=>true,'famous places'=>$famous],200);
    }


    public function update(Request $request, FamousPlace $famousPlace)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'info'=>'required',
            'photo'=>'required|image',
            'country_id'=>'required',
            'city_id'=>'required'

        ]);
        if($validator->fails())
        {
            return response()->json(['access'=>false,$validator->errors()],404);
        }
        $input=$request->all();
        if($request->has('photo'))
        {
        $photo=$request->photo;
        $newPhoto = time() . $photo->getClientOriginalName();
        $photo->move('famouss', $newPhoto);
        }
        $input['photo'] = ('famouss' . $newPhoto);

        $famous=FamousPlace::create($input);
        $famous->photo()->create(['photo'=> $input['photo'],'famous_place_id']);
        return response()->json(['access'=>true,'message'=>'create famous_place done'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $famous=FamousPlace::find($id)->delete();
        return response()->json(['access'=>true,'message'=>'delete FamousPlace done '],200);
    }
}
