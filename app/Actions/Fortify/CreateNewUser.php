<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:korisnici'],
            'address' => ['required', 'string', 'max:255'],
            'front_ID' => ['required', 'image'],
            'back_ID' => ['required', 'image'],
            'phone' => ['required', 'numeric', 'min:9', 'min:10', 'unique:korisnici'],
            'password' => $this->passwordRules(),
        ])->validate();

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

        $user->roles()->attach(1);
        return $user;
    }
}
