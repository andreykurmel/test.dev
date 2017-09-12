<?php

namespace App\Http\Requests;

use App\Repositories\ProductRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(ProductRepository $repo)
    {
        switch ($this->method()) {
            case 'POST':
                $result = Auth::check();
                break;

            case 'PATCH':
            case 'PUT':
                $pdc = $repo->getProductById($this->route('product'));
                $result = $this->user()->can('update', $pdc);
                break;

            case 'DELETE':
                $pdc = $repo->getProductById($this->route('product'));
                $result = $this->user()->can('delete', $pdc);
                break;
        }
        return $result;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                $rules = [
                    'name' => 'required',
                    'code' => 'required|unique:products,code',
                    'description' => 'required',
                    'inStock' => 'required|integer|min:0',
                    'price' => 'required|numeric|min:0',
                    'userId' => 'required|exists:users,id'
                ];
                break;

            case 'PATCH':
            case 'PUT':
                $rules = [
                    'name' => 'required',
                    'code' => 'required',
                    'description' => 'required',
                    'inStock' => 'required|integer|min:0',
                    'price' => 'required|numeric|min:0'
                ];
                break;

            case 'DELETE':
                $rules = [];
                break;
        }
        return $rules;
    }
}
