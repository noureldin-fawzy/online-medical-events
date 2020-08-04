<?php

namespace App\Http\Requests;

use App\Models\Contact;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContactRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('contact_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'organizer_id' => [
                'required',
                'integer',
            ],
            'branch'       => [
                'string',
                'required',
            ],
            'mobile'       => [
                'string',
                'nullable',
            ],
            'whatsapp'     => [
                'string',
                'nullable',
            ],
            'website'      => [
                'string',
                'nullable',
            ],
            'address'      => [
                'string',
                'nullable',
            ],
        ];
    }
}
