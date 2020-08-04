<?php

namespace App\Http\Requests;

use App\Models\Exhibition;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreExhibitionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('exhibition_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            'image'    => [
                'required',
            ],
        ];
    }
}
