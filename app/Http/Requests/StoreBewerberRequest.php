<?php

namespace App\Http\Requests;

use App\Bewerber;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBewerberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bewerber_create');
    }

    public function rules()
    {
        return [
            'name'        => [
                'string',
                'required',
            ],
            'email'       => [
                'required',
                'unique:bewerbers',
            ],
            'tel'         => [
                'string',
                'required',
            ],
            'job_id'      => [
                'required',
                'integer',
            ],
            'status'      => [
                'required',
            ],
            'questions.*' => [
                'integer',
            ],
            'questions'   => [
                'array',
            ],
            'answers.*'   => [
                'integer',
            ],
            'answers'     => [
                'array',
            ],
        ];
    }
}
