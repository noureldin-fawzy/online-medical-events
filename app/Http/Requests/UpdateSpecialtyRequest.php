<?php

namespace App\Http\Requests;

use App\Models\Specialty;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSpecialtyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('specialty_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'specialty' => [
                'string',
                'required',
            ],
        ];
    }
}
