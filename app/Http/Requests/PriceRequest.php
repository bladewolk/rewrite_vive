<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class PriceRequest extends FormRequest
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
     * @return array
     * @internal param Request $request
     */
    public function rules()
    {
        return [
            'device_id' => 'sometimes|required',
            // Both variants are correct and working
//            'minTime' => 'required|unique:prices,minTime,' . Route::input('price'),
            'minTime' => [
                'required',
                Rule::unique('prices')
                    ->ignore(Route::input('price')),
            ],
            'value' => 'required|numeric|min:1'
        ];
    }
}
