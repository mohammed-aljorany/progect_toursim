<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe;
class  StripePaymentController extends Controller
{
    public function stripe (request $request)
    {
        try
        {
            $stripe=new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );
            $res=$stripe->tokens->create([
                'card'=>[
                    'card_name'=>$request->card_name,
                    'card_number'=>$request->card_number,
                    'cvc'=>$request->cvc,
                    'ex_month'=>$request->ex_month,
                    'ex_year'=>$request->ex_year],
            ]);
            Stripe\Stripe::setApiKey('STRIPE_SECRET');
            Charge::create([
                'amount'=>$request->amount,
                'source'=>$res->id,
                'currency'=>'usd'
            ]);
            return response()->json(['succes'=>true,'message'=>'payment succssesfly'],200);

        }
        catch (Exception $ex)
        {
            return response()->json(['message'=>'error'],404);
        }




    }
}
