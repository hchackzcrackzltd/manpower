<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class cannidate extends FormRequest
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
            'name_th'=>'required|string',
            'name_en'=>'required|string',
            'position.*'=>'required|exists:positions,id',
            'fileat'=>'required|array'
        ];
    }
}
