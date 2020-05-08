<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulletUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'bullet' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
