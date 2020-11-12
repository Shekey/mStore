<?php

namespace App\Http\Controllers;

use App\Notifications\SendSMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ArticlesController extends Controller
{
    public function handle(Request $request)
    {

        Notification::route('nexmo', '38762636904')
            ->notify(new SendSMS());

        return response('Webhook received');
    }
}
