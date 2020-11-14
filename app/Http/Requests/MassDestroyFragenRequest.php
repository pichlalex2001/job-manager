<?php

namespace App\Http\Requests;

use App\Fragen;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFragenRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('fragen_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:fragens,id',
        ];
    }
}
