<?php

namespace App\Http\Requests;

use App\Fragen;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFragenRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fragen_create');
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
