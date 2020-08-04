<?php

namespace App\Http\Requests;

use App\Models\Board;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBoardRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('board_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            'type'     => [
                'required',
            ],
            'title'    => [
                'string',
                'required',
            ],
            'name'     => [
                'string',
                'required',
            ],
            'image'    => [
                'required',
            ],
        ];
    }
}
