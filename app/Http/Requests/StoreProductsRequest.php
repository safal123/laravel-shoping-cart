<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductsRequest extends FormRequest
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
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required',
            'is_active' => 'required'
        ];
    }

  public function messages()
  {
      return [
          'name.required' => 'Product name is required.',
          'category_id.required'  => 'Please select product category.',
          'is_active.required' => 'Please select if the product is active.',
      ];
  }
}
