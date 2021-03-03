<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KendaraanRequest extends FormRequest
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
            'merk'  => 'required',
            'type'  => 'required',
            'no_pol'  => 'required',
            'tahun'  => 'required|numeric',
            'jumlah_seat'  => 'required',
        ];
    }
}
