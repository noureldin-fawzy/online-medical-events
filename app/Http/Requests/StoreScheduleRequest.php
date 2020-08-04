<?php

namespace App\Http\Requests;

use App\Models\Schedule;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreScheduleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('schedule_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'event_id'   => [
                'required',
                'integer',
            ],
            'speaker_id' => [
                'required',
                'integer',
            ],
            'day'        => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'start_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'end_time'   => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'title'      => [
                'string',
                'required',
            ],
            'subtitle'   => [
                'string',
                'nullable',
            ],
        ];
    }
}
