<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilePainRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // return [
        //     'selectedPain.*.name' => ['required', 'string', 'max:255'],
        //     'selectedPain.*.description' => ['required'],
        //     'selectedPain.*.when' => ['required', 'date']
        // ];
        return [
            'painName' => ['required', 'string', 'max:255'],
            'painDescription' => ['required'],
            'painWhen' => ['required', 'date']
        ];
    }
}
