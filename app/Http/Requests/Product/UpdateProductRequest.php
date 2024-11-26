<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        return [
            'name' => 'sometimes|required|string',
            'type' => 'sometimes|required|string',
            'barcode' => 'sometimes|required|int',
            'quantity' => 'sometimes|required|int',
            'price_without_vat' => 'sometimes|required|decimal:0,2',
            'price_with_vat' => 'sometimes|required|decimal:0,2',
        ];
    }
}
