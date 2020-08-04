<?php

namespace App\Http\Requests;

use App\Models\Organizer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrganizerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('organizer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            'logo'     => [
                'required',
            ],
        ];
    }
}
