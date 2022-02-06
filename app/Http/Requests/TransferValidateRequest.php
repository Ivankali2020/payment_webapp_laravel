<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferValidateRequest extends FormRequest
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
            'to_phone' => 'required|min:9',
            'amount' => 'required|integer|min:1',
        ];
    }
}
