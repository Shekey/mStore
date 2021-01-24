<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'    => [
                'string',
                'required',
            ],
            'isOwner'     => ['sometimes', 'nullable', 'numeric'],
            'email'   => [
                'sometimes',
                'nullable',
                'unique:users,email,' . request()->route('korisnici'),
            ],
            'phone' => ['required', 'numeric', 'min:9', 'min:10', 'unique:users,phone,' . request()->route('korisnici')],
            'password'  => [
                'sometimes',
                'nullable',
                'min:6'
            ],
            'newAddress' => ['sometimes', 'nullable', 'string'],
            'roles.*' => [
                'integer',
            ],
            'roles'   => [
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
