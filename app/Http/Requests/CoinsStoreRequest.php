<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoinsStoreRequest extends FormRequest
{

    // public $redirect = '/coins/add';
    // public $redirectRoute = 'coins.add';

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
            'title' => 'bail|required|max:50',
            'symbol' => 'bail|required|max:20|unique:App\Models\Coins,symbol',
        ];
    }

}
