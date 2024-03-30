<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RigsterController;
use App\Http\Controllers\ProfileController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

            /*---------RIGISTER -------*/
Route::post('/register',[RigsterController::class,'rigister']);
Route::post('/login',[RigsterController::class,'login']);
Route::middleware(['auth:api'])->group(function()
{
Route::post('/logout',[RigsterController::class,'logOut']);

             /*-----------PROFILE----------*/
Route::get('/profile',[ProfileController::class,'index']);
Route::post('/profile/store',[ProfileController::class,'store']);
Route::put('/profile/update',[ProfileController::class,'update']);
Route::delete('/profile/del',[ProfileController::class,'destroy']);
});


