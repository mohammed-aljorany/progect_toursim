<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FamousPlaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RigsterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\FavoriteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

            /*---------RIGISTER -------*/
Route::post('/register',[RigsterController::class,'rigister']);
Route::post('/login',[RigsterController::class,'login']);

/*---------middleware -------*/
Route::middleware(['auth:api'])->group(function()
{
    /*-----------LOGOUT----------*/
Route::post('/logout',[RigsterController::class,'logOut']);
             /*-----------PROFILE----------*/
Route::get('/profile',[ProfileController::class,'index']);
Route::post('/profile/store',[ProfileController::class,'store']);
Route::put('/profile/update',[ProfileController::class,'update']);
Route::delete('/profile/del',[ProfileController::class,'destroy']);
    /*-----------COUNTRY----------*/
    Route::get('/country',[CountryController::class,'index']);
    Route::get('/country/show/{id}',[CountryController::class,'index']);
    Route::post('/country/store',[CountryController::class,'store']);
    Route::put('/country/update',[CountryController::class,'update']);
    Route::delete('/country/del/{id}',[CountryController::class,'destroy']);
    /*-----------city----------*/
    Route::get('/city',[CityController::class,'index']);
    Route::get('/city/show/{id}',[CityController::class,'index']);
    Route::post('/city/store',[CityController::class,'store']);
    Route::put('/city/update',[CityController::class,'update']);
    Route::delete('/city/del/{id}',[CityController::class,'destroy']);
    /*-----------FAMOUS place----------*/
    Route::get('/famous',[FamousPlaceController::class,'index']);
    Route::get('/famous/show/{id}',[FamousPlaceController::class,'show']);
    Route::post('/famous/store',[FamousPlaceController::class,'store']);
    Route::put('/famous/update',[FamousPlaceController::class,'update']);
    Route::delete('/famous/del/{id}',[FamousPlaceController::class,'destroy']);
    /*-----------HOTEL----------*/
    Route::get('/hotel',[HotelController::class,'index']);
    Route::get('/hotel/show/{id}',[HotelController::class,'show']);
    Route::post('/hotel/store',[HotelController::class,'store']);
    Route::put('/hotel/update',[HotelController::class,'update']);
    Route::delete('/hotel/del/{id}',[HotelController::class,'destroy']);
    /*-----------place----------*/
    Route::get('/place',[PlaceController::class,'index']);
    Route::get('/place/show/{id}',[PlaceController::class,'show']);
    Route::post('/place/store',[PlaceController::class,'store']);
    Route::put('/place/update',[PlaceController::class,'update']);
    Route::delete('/place/del/{id}',[PlaceController::class,'destroy']);
    /*-------------favorite-----------*/
    Route::get('/favorite',[FavoriteController::class,'index']);
    Route::post('/place/favorite',[FavoriteController::class,'store']);
    Route::delete('/place/favorite/{id}',[FavoriteController::class,'destroy']);





});


