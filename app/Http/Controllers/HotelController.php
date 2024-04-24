<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
class HotelController extends Controller
{
    public function index()
    {
        $hotel=Hotel::latest()->with('city','country')->paginate(20);
        return response()->json(['access'=>true,'all hotel'=>$hotel],200);
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'hotel_name',
            'photo',
            'number_rate',
            'info',
            'number_room',
            'city_id',
            'country_id'
        ]);
        if ($validator->fails()) {
            return response()->json(['access' => false, $validator->errors()], 404);
        }
        $input = $request->all();
        $photo = $request->photo;
        $newPhoto = time() . $photo->getClientOriginalName();
        $photo->move('hotels', $newPhoto);
        $input['photo'] = ('hotels' . $newPhoto);
        $hotel=Hotel::create($input);
        return response()->json(['access' => true, 'message' => 'create hotels done'], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hotel=Hotel::find($id);
        return response()->json(['access'=>true,'hotel is'=>$hotel],200);
    }

    public function update(Request $request, Hotel $hotel)
    {
        $validator=Validator::make($request->all(),[
            'hotel_name',
            'photo',
            'number_rate',
            'info',
            'number_room',
            'city_id',
            'country_id'
        ]);
        if ($validator->fails()) {
            return response()->json(['access' => false, $validator->errors()], 404);
        }
        $input = $request->all();
        if($request->has('photo'))
        {
            $photo=$request->photo;
            $newPhoto = time() . $photo->getClientOriginalName();
            $photo->move('hotels', $newPhoto);
        }
        $input['photo'] = ('hotels' . $newPhoto);
        $hotel=Hotel::update($input);
        return response()->json(['access' => true, 'message' => 'update hotels done'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */

        public function destroy($id)
    {
        $hotel=Hotel::find($id)->delete();
        return response()->json(['access'=>true,'message'=>'delete hotel done '],200);
    }
}
