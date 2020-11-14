<?php

namespace App\Http\Requests;

use App\Job;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateJobRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_edit');
    }

    public function rules()
    {
        return [
            'job_nr'      => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'jobtitle'    => [
                'string',
                'nullable',
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
            'milestone_1' => [
                'required',
            ],
        ];
    }
}
