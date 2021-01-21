<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSearchTeamRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'leader' => ['required', 'string'],
            'medic' => ['required', 'string'],
            'responder_1' => ['string'],
            'responder_2' => ['string'],
            'responder_3' => ['string'],
        ];
    }
}
