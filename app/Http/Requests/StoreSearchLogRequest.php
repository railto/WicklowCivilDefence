<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSearchLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'team' => ['string', 'required'],
            'area' => ['string', 'required'],
            'start_time' => ['date', 'required'],
            'end_time' => ['date'],
            'notes' => ['string'],
        ];
    }
}
