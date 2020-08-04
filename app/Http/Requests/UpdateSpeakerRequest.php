<?php

namespace App\Http\Requests;

use App\Models\Speaker;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSpeakerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('speaker_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'event_id' => [
                'required',
                'integer',
            ],
            'title'    => [
                'string',
                'required',
            ],
            'name'     => [
                'string',
                'required',
            ],
            'email'    => [
                'required',
            ],
        ];
    }
}
