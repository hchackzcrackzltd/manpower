<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class resignupdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'lfw'=>'required|date|date_format:Y-m-d',
          'eft'=>'required|date|date_format:Y-m-d|after:lfw',
          'rsn'=>'nullable|string',
          'rk'=>'nullable|string'
        ];
    }
}
