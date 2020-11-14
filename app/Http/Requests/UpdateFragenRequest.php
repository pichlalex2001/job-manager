<?php

namespace App\Http\Requests;

use App\Fragen;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFragenRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fragen_edit');
    }

    public function rules()
    {
        return [
            'question' => [
                'string',
                'required',
            ],
        ];
    }
}
