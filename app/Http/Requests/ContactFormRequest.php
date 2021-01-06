<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ime' => 'required|max:30',
            'prezime' => 'required|max:30',
            'telefon' => 'required|max:20',
            'poruka' => 'required',
        ];
    }

    public function messages(){
        return [
            'ime' => 'Polje :attribute je obavezno.',
            'prezime' => 'Polje :attribute je obavezno',
            'telefon' => 'Polje :attribute je obavezno',
            'poruka' => 'Polje :attribute je obavezno',
        ];
    }
}
