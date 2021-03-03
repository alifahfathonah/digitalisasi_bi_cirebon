<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
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
          'nik' => 'required|numeric',
          'username' => 'required',
          'email' => 'required|email',
          'pass' => 'required',
          'no_telp' => 'required|numeric',
          'alamat' => 'required',
          'templat_lahir' => 'required',
          'tanggal_lahir' => 'required|date',
          'department_id' => 'required'
        ];
    }
}
