<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LineUpFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'no_defenders' => 'required|integer|max:6|min:2',
            'no_midfielders' => 'required|integer|max:5|min:1',
            'no_attackers' => 'required|integer|max:4|min:1',
        ];
    }
}
