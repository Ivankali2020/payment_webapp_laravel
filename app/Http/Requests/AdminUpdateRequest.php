<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
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
        $id = $this->route('adminUser');
        return [
            'name' => 'required|min:4|max:20',
            'email' => 'required|email|unique:admin_users,email,'.$id,
            'phone' => 'required|min:11|unique:admin_users,phone,'.$id,

        ];
    }
}
