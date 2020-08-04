<?php

namespace App\Http\Requests;

use App\Models\Specialty;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSpecialtyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('specialty_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
