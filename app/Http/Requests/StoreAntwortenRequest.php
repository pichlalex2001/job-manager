<?php

namespace App\Http\Requests;

use App\Antworten;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAntwortenRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('antworten_create');
    }

    public function rules()
    {
        return [
            'question_id' => [
                'required',
                'integer',
            ],
            'answer'      => [
                'string',
                'required',
            ],
        ];
    }
}
