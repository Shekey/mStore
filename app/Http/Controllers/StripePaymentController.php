<?php

namespace App\Http\Controllers;

use Stripe;
use Illuminate\Http\Request;

class StripePaymentController extends Controller
{
    public function index()
    {
        return view('stripe');
    }

    public function process(Request $request)
    {
        $stripe = Stripe::charges()->create([
            'source' => $request->get('tokenId'),
            'currency' => 'USD',
            'amount' => $request->get('amount')
        ]);

        return $stripe;
    }
}
