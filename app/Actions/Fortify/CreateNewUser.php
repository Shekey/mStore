<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Notifications\NewUserRegistered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'front_ID' => ['required', 'image'],
            'back_ID' => ['required', 'image'],
            'phone' => ['required', 'numeric', 'min:9', 'min:10', 'unique:users'],
            'password' => $this->passwordRules(),
        ], $this->messages())->validate();

        $mime= $input['front_ID']->getClientOriginalExtension();
        $imageName = time().".".$mime;
        $image = Image::make($input['front_ID'])->fit(800);
        Storage::disk('public')->put("images/".$imageName, (string) $image->encode());

        $mime= $input['back_ID']->getClientOriginalExtension();
        $imageNameBack = time().".".$mime;
        $imageBack = Image::make($input['back_ID'])->fit(800);
        Storage::disk('public')->put("images/".$imageNameBack, (string) $imageBack->encode());


        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'idFront' => '/images/'.$imageName,
            'idBack' => '/images/'. $imageNameBack,
            'password' => Hash::make($input['password']),
        ]);

        $user->roles()->attach(2);

        $admins = User::whereHas('roles', function ($query) {
            $query->where('id', 1);
        })->get();

        Notification::send($admins, new NewUserRegistered());
        return $user;
    }

    public function messages() {
        return [
            'name.required' => 'Ime i prezime su obavezni.',
            'email.required' => 'Email je obavezan.',
            'email.unique' => 'Ovaj email već neko koristi.',
            'address.required' => 'Adresa je obavezan.',
            'front_ID.required' => 'Slika licne karte(prednja) je obavezna.',
            'back_ID.required' => 'Slika licne karte(zadnja) je obavezna.',
            'front_ID.image' => 'Slika licne karte(prednja) mora biti .jpg ili .png formata.',
            'back_ID.image' => 'Slika licne karte(zadnja) mora biti .jpg ili .png formata.',
            'phone.required' => 'Telefonski broj je obavezan',
            'phone.numeric' => 'Telefonski broj mogu biti samo brojevi',
            'phone.unique' => 'Ovaj telefonski broj već neko koristi.',
        ];
    }
}
