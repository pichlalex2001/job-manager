<?php

namespace App\Http\Requests;

use App\Antworten;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAntwortenRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('antworten_edit');
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
