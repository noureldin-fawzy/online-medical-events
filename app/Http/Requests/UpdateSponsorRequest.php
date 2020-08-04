<?php

namespace App\Http\Requests;

use App\Models\Sponsor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSponsorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sponsor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'events.*' => [
                'integer',
            ],
            'events'   => [
                'required',
                'array',
            ],
            'title'    => [
                'string',
                'required',
            ],
        ];
    }
}
