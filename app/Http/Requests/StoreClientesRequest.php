<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreClientesRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cedula'=>['string','required'],
            'nombre'=>['string','required'],
            'apellido1'=>['string','required'],
            'apellido2'=>['string','required'],
            'direccion'=>['string','required'],
            'telefono'=>['string','required'],
        ];
    }
}
