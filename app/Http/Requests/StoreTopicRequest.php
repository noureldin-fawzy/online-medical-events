<?php

namespace App\Http\Requests;

use App\Models\Topic;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTopicRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('topic_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
        ];
    }
}
