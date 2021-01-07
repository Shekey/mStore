<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'     => [
                'string',
                'required',
            ],
            'isOwner'     => ['sometimes', 'nullable', 'numeric'],
            'email'    => [
                'required',
                'unique:users',
            ],
            'password' => [
                'required',
            ],
            'phone' => ['required', 'numeric', 'min:9', 'min:10', 'unique:users'],
            'address' => [
                'required',
            ],
            'idFront' => ['required'],
            'idBack' => ['required'],
            'roles.*'  => [
                'integer',
            ],
            'roles'    => [
                'required',
                'array',
            ],
        ];
    }

    public function authorize()
    {
        return Gate::allows('tasks_access');
    }
}
