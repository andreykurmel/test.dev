<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrderStoreRequest extends FormRequest
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
        return [
            'user_name' => 'required',
            'user_pass' => 'required',
            'user_email' => 'required|email',
            'product_name' => 'required',
            'product_code' => 'required',
            'product_description' => 'required',
            'product_inStock' => 'required|integer|min:0',
            'product_price' => 'required|numeric|min:0'
        ];
    }
}
