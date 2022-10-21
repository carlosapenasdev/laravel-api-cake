<?php

namespace App\Http\Requests;

use App\Models\Cake;
use Illuminate\Foundation\Http\FormRequest;

class CakeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'      => 'required|string|max:50',
            'weight'    => 'required|numeric',
            'price'     => 'required|numeric',
            'amount'    => 'required|integer',
        ];
    }
}
