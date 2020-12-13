<?php

namespace App\Http\Requests;

use App\Models\EventAttendee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventAttendeeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('event_attendee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'event_id' => [
                'required',
                'integer',
            ],
            'user_id'  => [
                'required',
                'integer',
            ],
        ];
    }
}