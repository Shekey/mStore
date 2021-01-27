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
            'email' => ['sometimes', 'nullable', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'min:9', 'min:13', 'unique:users'],
            'password' => $this->passwordRules(),
        ], $this->messages())->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'address' => $input['address'],
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
            'phone.required' => 'Telefonski broj je obavezan',
            'phone.numeric' => 'Telefonski broj mogu biti samo brojevi',
            'phone.min' => 'Telefonski broj mora imati najmanje 9 brojeva',
            'phone.max' => 'Telefonski broj ne smije imati vise od 13 brojeva',
            'phone.unique' => 'Ovaj telefonski broj već neko koristi.',
            'password.min' => 'Password mora imati najmanje 8 karaktera.',
            'password_confirmation.same' => 'Passwordi se moraju podudarati. Unesite ponovno.'
        ];
    }
}
