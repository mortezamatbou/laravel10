<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntityTestCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
//    public function authorize(): bool
//    {
//        return false;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => 'required|max:20',
            'lastName' => 'required|max:20',
            'age' => 'required|digits_between:1,100',
            'field' => 'required|in:IT,SW,HW'
        ];
    }
}
