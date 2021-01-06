<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\User;
use App\Notifications\ContactFormMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactForm extends Controller
{
    public function mailContactForm(ContactFormRequest $message)
    {
        Notification::route('mail', "podrska@m-store.ba")->notify( new ContactFormMessage($message));
        return redirect()->back()->with('message', 'Hvala što ste nam se obratili, uskoro ćemo vam se javiti!');
    }

}
