<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $place=Place::latest()->with('photo','city','country')->paginate(10);
        return response()->json(['access'=>true,'all places'=>$place],200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_place' => 'required',
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
        $photo->move('place', $newPhoto);

        $input['photo'] = ('place' . $newPhoto);

        $place = Place::create($input);
        $place->photo()->create(['photo' => $input['photo'], 'place_id']);
        return response()->json(['access' => true, 'message' => 'create place done'], 200);
    }

    public function show($id)
    {
        $place = Place::find($id);
        return response()->json(['access' => true, 'places' => $place], 200);
    }

    public function update(Request $request, Place $place)
    {
        $validator = Validator::make($request->all(), [
            'name_place' => 'required',
            'info' => 'required',
            'photo' => 'required|image',
            'country_id' => 'required',
            'city_id' => 'required'

        ]);
        if ($validator->fails()) {
            return response()->json(['access' => false, $validator->errors()], 404);
        }
        $input = $request->all();
        if($request->has('photo')) {
            $photo = $request->photo;
            $newPhoto = time() . $photo->getClientOriginalName();
            $photo->move('place', $newPhoto);
        }

        $input['photo'] = ('place' . $newPhoto);

        $place = Place::update($input);
        $place->photo()->create(['photo' => $input['photo'], 'place_id']);
        return response()->json(['access' => true, 'message' => 'update place done'], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $place = Place::find($id)->delete();
        return response()->json(['access' => true, 'places' => $place], 200);
    }
}
