<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        ])->validate();

        Image::make($input['front_ID'])->resize(800, 600)->save('users/cards/front_ID.jpg');
        Image::make($input['back_ID'])->resize(800, 600)->save('users/cards/back_ID.jpg');

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'idFront' => '/users/cards/front_ID.jpg',
            'idBack' => '/users/cards/back_ID.jpg',
            'password' => Hash::make($input['password']),
        ]);
    }
}
