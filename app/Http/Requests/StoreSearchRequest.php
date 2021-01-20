<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSearchRequest extends FormRequest
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
            'location' => ['required', 'string'],
            'start' => ['required', 'date'],
            'type' => ['required', 'string'],
            'officer_in_charge' => ['required', 'string'],
            'search_manager' => ['required', 'string'],
            'safety_officer' => ['required', 'string'],
            'section_leader' => ['required', 'string'],
            'radio_operator' => ['required', 'string'],
            'scribe' => ['required', 'string'],
        ];
    }
}
