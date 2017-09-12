<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'code' => 'required|unique:products,code',
            'description' => 'required',
            'inStock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0'
        ];

        if ($this->method() == 'POST') {
            $rules['userId'] = 'required|exists:users,id';
        }

        return $rules;
    }
}
